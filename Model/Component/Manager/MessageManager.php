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

namespace OjsMessage\MessageBundle\Model\Component\Manager;

use OjsMessage\MessageBundle\Model\Component\Manager\ManagerInterface;
use OjsMessage\MessageBundle\Model\Component\Manager\BaseManager;
use OjsMessage\MessageBundle\Entity\Message;

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
class MessageManager extends BaseManager implements ManagerInterface
{
    /**
     *
     * @access public
     * @return \OjsMessage\MessageBundle\Entity\Message
     */
    public function createMessage()
    {
        return $this->gateway->createMessage();
    }

    public function saveMessage(Message $message)
    {
        $this->persist($message);
        $this->flush();
        $this->refresh($message);

        return $message;
    }
}
