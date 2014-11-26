<?php

/*
 * This file is part of the OjsMessage MessageBundle
 *
 * (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OjsMessage\MessageBundle\Component\Server;

use Symfony\Component\EventDispatcher\EventDispatcherInterface ;
use Symfony\Component\Security\Core\User\UserInterface;

use OjsMessage\MessageBundle\Component\Dispatcher\MessageEvents;
use OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent;
use OjsMessage\MessageBundle\Component\Dispatcher\Event\UserEnvelopeReceiveEvent;
use OjsMessage\MessageBundle\Component\Dispatcher\Event\UserEnvelopeReceiveFailedInboxFullEvent;
use OjsMessage\MessageBundle\Component\Dispatcher\Event\UserEnvelopeReceiveFailedOutboxFullEvent;

use OjsMessage\MessageBundle\Component\Helper\QuotaHelper;
use OjsMessage\MessageBundle\Component\Helper\FolderHelper;

use OjsMessage\MessageBundle\Model\FrontModel\FolderModel;
use OjsMessage\MessageBundle\Model\FrontModel\MessageModel;
use OjsMessage\MessageBundle\Model\FrontModel\EnvelopeModel;
use OjsMessage\MessageBundle\Model\FrontModel\UserModel;

use OjsMessage\MessageBundle\Entity\Folder;
use OjsMessage\MessageBundle\Entity\Message;
use OjsMessage\MessageBundle\Entity\Envelope;
use OjsMessage\MessageBundle\Entity\Thread;

/**
 *
 * @category OjsMessage
 * @package  MessageBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * 
 *
 */
class MessageServer
{
    /**
     *
     * @access protected
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface  $dispatcher
     */
    protected $dispatcher;

    /**
     *
     * @access protected
     * @var \OjsMessage\MessageBundle\Model\FrontModel\FolderModel $folderModel
     */
    protected $folderModel;

    /**
     *
     * @access protected
     * @var \OjsMessage\MessageBundle\Model\FrontModel\MessageModel $messageModel
     */
    protected $messageModel;

    /**
     *
     * @access protected
     * @var \OjsMessage\MessageBundle\Model\FrontModel\EnvelopeModel $envelopeModel
     */
    protected $envelopeModel;

    /**
     *
     * @access protected
     * @var \OjsMessage\MessageBundle\Model\FrontModel\UserModel $userModel
     */
    protected $userModel;

    /**
     *
     * @access protected
     * @var \OjsMessage\MessageBundle\Component\Helper\QuotaHelper $quotaHelper
     */
    protected $quotaHelper;

    /**
     *
     * @access protected
     * @var \OjsMessage\MessageBundle\Component\Helper\FolderHelper $folderHelper
     */
    protected $folderHelper;

    const MESSAGE_SEND = 0;
    const MESSAGE_SAVE_CARBON_COPY = 1;
    const MESSAGE_SAVE_DRAFT = 2;

    private $sendMode = array(
        self::MESSAGE_SEND,
        self::MESSAGE_SAVE_CARBON_COPY,
        self::MESSAGE_SAVE_DRAFT,
    );

    /**
     *
     * @access public
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $dispatcher
     * @param \OjsMessage\MessageBundle\Model\FrontModel\FolderModel     $folderModel
     * @param \OjsMessage\MessageBundle\Model\FrontModel\MessageModel    $messageModel
     * @param \OjsMessage\MessageBundle\Model\FrontModel\EnvelopeModel   $envelopeModel
     * @param \OjsMessage\MessageBundle\Model\FrontModel\UserModel       $userModel
     * @param \OjsMessage\MessageBundle\Component\Helper\QuotaHelper     $quotaHelper
     * @param \OjsMessage\MessageBundle\Component\Helper\FolderHelper    $folderHelper
     */
    public function __construct(EventDispatcherInterface  $dispatcher, FolderModel $folderModel,
     MessageModel $messageModel, EnvelopeModel $envelopeModel, UserModel $userModel, QuotaHelper $quotaHelper, FolderHelper $folderHelper)
    {
        $this->dispatcher    = $dispatcher;
        $this->envelopeModel = $envelopeModel;
        $this->messageModel  = $messageModel;
        $this->folderModel   = $folderModel;
        $this->userModel     = $userModel;
        $this->quotaHelper   = $quotaHelper;
        $this->folderHelper  = $folderHelper;
    }

    /**
     *
     * @access public
     * @param \OjsMessage\MessageBundle\Entity\Message $message
     * @param bool                                      $isFlagged
     */
    public function sendMessage($request, Message $message, $isFlagged)
    {
        // Create a new Thread.
        if (null == $message->getThread()) {
            $thread = new Thread();
            $message->setThread($thread);
        }

        $this->dispatcher->dispatch(MessageEvents::USER_MESSAGE_CREATE_SUCCESS, new UserMessageEvent($request, $message));

        $this->messageModel->saveMessage($message);

        $this->dispatcher->dispatch(MessageEvents::USER_MESSAGE_CREATE_COMPLETE, new UserMessageEvent($request, $message));

        // Add Carbon Copy first.
        if ($this->receiveMessage($request, $message, $message->getSentFromUser(), self::MESSAGE_SAVE_CARBON_COPY, $isFlagged)) {
            $recipients = $this->getRecipients($message);

            foreach ($recipients as $recipient) {
                $this->receiveMessage($request, $message, $recipient, self::MESSAGE_SEND, $isFlagged);
            }

            return true;
        }

        return false;
    }

    /**
     *
     * @access public
     * @param \OjsMessage\MessageBundle\Entity\Message $message
     * @param bool                                      $isFlagged
     */
    public function saveDraft($request, Message $message, $isFlagged)
    {
        $this->dispatcher->dispatch(MessageEvents::USER_MESSAGE_CREATE_SUCCESS, new UserMessageEvent($request, $message));

        $this->messageModel->saveMessage($message)->refresh($message);

        $this->dispatcher->dispatch(MessageEvents::USER_MESSAGE_CREATE_COMPLETE, new UserMessageEvent($request, $message));

        $this->receiveMessage($request, $message, $message->getSentFromUser(), self::MESSAGE_SAVE_DRAFT, $isFlagged);
    }

    /**
     *
     * @access public
     * @param \OjsMessage\MessageBundle\Entity\Message           $message
     * @param \Symfony\Component\Security\Core\User\UserInterface $recipient
     * @param int                                                 $mode
     * @param bool                                                $isFlagged
     */
    public function receiveMessage($request, Message $message, UserInterface $recipient, $mode, $isFlagged = false)
    {
        if (! in_array($mode, $this->sendMode)) {
            throw new \Exception('Message send mode not valid!');
        }

        $envelope = new Envelope();
        $envelope->setMessage($message);
        $envelope->setThread($message->getThread());
        $envelope->setOwnedByUser($recipient);
        $envelope->setFlagged($isFlagged);
        $envelope->setSentDate(new \Datetime('now'));

        $folders = $this->folderHelper->findAllFoldersForUserById($recipient);

        if ($this->quotaHelper->isQuotaAllowanceFilled($folders)) {
            if ($mode == self::MESSAGE_SAVE_CARBON_COPY) {
                $this->dispatcher->dispatch(MessageEvents::USER_ENVELOPE_RECEIVE_FAILED_OUTBOX_FULL, new UserEnvelopeReceiveFailedOutboxFullEvent($request, $envelope, $recipient));
            } else {
                $this->dispatcher->dispatch(MessageEvents::USER_ENVELOPE_RECEIVE_FAILED_INBOX_FULL, new UserEnvelopeReceiveFailedInboxFullEvent($request, $envelope, $recipient));
            }

            return false;
        }

        // 1 find inbox for recipient
        switch ($mode) {
            case self::MESSAGE_SEND:
                $envelope->setFolder($this->folderHelper->filterFolderBySpecialType($folders, Folder::SPECIAL_TYPE_INBOX));
                $envelope->setSentToUser($recipient);
                break;
            case self::MESSAGE_SAVE_CARBON_COPY:
                $envelope->setFolder($this->folderHelper->filterFolderBySpecialType($folders, Folder::SPECIAL_TYPE_SENT));
                $envelope->setRead(true);
                break;
            case self::MESSAGE_SAVE_DRAFT:
                $envelope->setFolder($this->folderHelper->filterFolderBySpecialType($folders, Folder::SPECIAL_TYPE_DRAFTS));
                $envelope->setRead(true);
                $envelope->setDraft(true);
                break;
        }

        $this->envelopeModel->saveEnvelope($envelope);

        // Update recipients folders read/unread cache counts.
        $this->dispatcher->dispatch(MessageEvents::USER_ENVELOPE_RECEIVE_COMPLETE, new UserEnvelopeReceiveEvent($request, $envelope, $recipient, $folders));

        return true;
    }

    /**
     *
     * @access public
     * @param  \OjsMessage\MessageBundle\Entity\Message                         $message
     * @return \OjsMessage\MessageBundle\Model\Component\Manager\MessageManager
     */
    public function getRecipients(Message $message)
    {
        $recipients = $message->getSendTo();

        // build a list of recipients from the sendTo field.
        if ($recipients = preg_split('/((,)|(\s))/', $recipients, PREG_OFFSET_CAPTURE)) {
            foreach ($recipients as $key => $recipient) {
                $recipients[$key] = preg_replace("/[^a-zA-Z0-9_]/", "", $recipients[$key]);

                if (! $recipient) {
                    unset($recipients[$key]);
                }
            }

            $users = $this->userModel->findTheseUsersByUsername($recipients);
        } else {
            // If preg split fails, then presumably theres no comma delimiter, so only one user.
            $users = $this->userModel->findTheseUsersByUsername(array($recipients));
        }

        return $users;
    }
}
