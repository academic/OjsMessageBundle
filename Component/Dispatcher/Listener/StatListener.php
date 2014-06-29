<?php

/*
 * This file is part of the OjstrMessage MessageBundle
 *
 * (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OjstrMessage\MessageBundle\Component\Dispatcher\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use OjstrMessage\MessageBundle\Component\Dispatcher\MessageEvents;
use OjstrMessage\MessageBundle\Component\Dispatcher\Event\UserEnvelopeReceiveEvent;
use OjstrMessage\MessageBundle\Model\FrontModel\FolderModel;
use OjstrMessage\MessageBundle\Model\FrontModel\EnvelopeModel;
use OjstrMessage\MessageBundle\Model\FrontModel\RegistryModel;

/**
 *
 * @category OjstrMessage
 * @package  MessageBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * 
 *
 */
class StatListener implements EventSubscriberInterface
{
    /**
     *
     * @access private
     * @var \OjstrMessage\MessageBundle\Model\FrontModel\FolderModel $folderModel
     */
    protected $folderModel;

    /**
     *
     * @access private
     * @var \OjstrMessage\MessageBundle\Model\FrontModel\EnvelopeModel $envelopeModel
     */
    protected $envelopeModel;

    /**
     *
     * @access private
     * @var \OjstrMessage\MessageBundle\Model\FrontModel\RegistryModel $registryModel
     */
    protected $registryModel;

    /**
     *
     * @access public
     * @param \OjstrMessage\MessageBundle\Model\FrontModel\EnvelopeModel $envelopeModel
     * @param \OjstrMessage\MessageBundle\Model\FrontModel\RegistryModel $registryModel
     * @param \OjstrMessage\MessageBundle\Model\FrontModel\FolderModel   $folderModel
     */
    public function __construct(FolderModel $folderModel, EnvelopeModel $envelopeModel, RegistryModel $registryModel)
    {
        $this->folderModel = $folderModel;
        $this->envelopeModel = $envelopeModel;
        $this->registryModel = $registryModel;
    }

    /**
     *
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            MessageEvents::USER_ENVELOPE_RECEIVE_COMPLETE => 'onEnvelopeReceiveComplete',
        );
    }

    public function onEnvelopeReceiveComplete(UserEnvelopeReceiveEvent $event)
    {
        $folders = $event->getFolders();
        $recipient = $event->getRecipient();
        $totalUnread = 0;
        foreach ($folders as $folder) {
            $countRead   = $this->envelopeModel->getReadCounterForFolderById($folder->getId(), $recipient->getId());
            $countUnread = $this->envelopeModel->getUnreadCounterForFolderById($folder->getId(), $recipient->getId());
            $folder->setCachedReadCount($countRead['read']);
            $folder->setCachedUnreadCount($countUnread['unread']);
            $folder->setCachedTotalMessageCount((int) ((int) $countRead['read'] + (int) $countUnread['unread']));
            $totalUnread += (int) $countUnread['unread'];
            $this->folderModel->updateFolder($folder);
        }

        $registry = $this->registryModel->findOrCreateOneRegistryForUser($recipient);
        $registry->setCachedUnreadMessageCount($totalUnread);

        $this->registryModel->updateRegistry($registry);
    }
}
