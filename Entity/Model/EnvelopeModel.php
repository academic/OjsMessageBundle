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

namespace OjsMessage\MessageBundle\Entity\Model;

use Symfony\Component\Security\Core\User\UserInterface;

use OjsMessage\MessageBundle\Entity\Message;
use OjsMessage\MessageBundle\Entity\Thread;
use OjsMessage\MessageBundle\Entity\Folder;

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
 * @abstract
 *
 */
abstract class EnvelopeModel
{
    /**
     *
     * @var \OjsMessage\MessageBundle\Entity\Folder $folder
     */
    protected $folder = null;

    /**
     *
     * @var \OjsMessage\MessageBundle\Entity\Message $message
     */
    protected $message = null;

    /**
     *
     * @var \Symfony\Component\Security\Core\User\UserInterface $owmedByUser
     */
    protected $ownedByUser = null;

    /**
     * @var \Symfony\Component\Security\Core\User\UserInterface $sentToUser
     */
    protected $sentToUser = null;

    /**
     *
     * @var \OjsMessage\MessageBundle\Entity\Thread $thread
     */
    protected $thread = null;

    /**
     *
     * @access public
     */
    public function __construct()
    {
        // your own logic
    }

    /**
     * Get folder
     *
     * @return \OjsMessage\MessageBundle\Entity\Folder
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  \OjsMessage\MessageBundle\Entity\Folder   $folder
     * @return \OjsMessage\MessageBundle\Entity\Envelope
     */
    public function setFolder(Folder $folder = null)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get message
     *
     * @return \OjsMessage\MessageBundle\Entity\Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param  \OjsMessage\MessageBundle\Entity\Message  $message
     * @return \OjsMessage\MessageBundle\Entity\Envelope
     */
    public function setMessage(Message $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get thread
     *
     * @return \OjsMessage\MessageBundle\Entity\Thread
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * Set thread
     *
     * @param  \OjsMessage\MessageBundle\Entity\Thread  $thread
     * @return \OjsMessage\MessageBundle\Entity\Message
     */
    public function setThread(Thread $thread)
    {
        $this->thread = $thread;

        return $this;
    }

    /**
     * Get ownedByUser
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getOwnedByUser()
    {
        return $this->ownedByUser;
    }

    /**
     * Set ownedByUser
     *
     * @param  \Symfony\Component\Security\Core\User\UserInterface $ownedByUser
     * @return \OjsMessage\MessageBundle\Entity\Envelope
     */
    public function setOwnedByUser(UserInterface $ownedByUser = null)
    {
        $this->ownedByUser = $ownedByUser;

        return $this;
    }

    /**
     * Get sentToUser
     *
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getSentToUser()
    {
        return $this->sentToUser;
    }

    /**
     * Set sentToUser
     *
     * @param  \Symfony\Component\Security\Core\User\UserInterface $sentToUser
     * @return \OjsMessage\MessageBundle\Entity\Envelope
     */
    public function setSentToUser(UserInterface $sentToUser = null)
    {
        $this->sentToUser = $sentToUser;

        return $this;
    }
}
