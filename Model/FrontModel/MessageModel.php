<?php

/*
 * This file is part of the Okulbilisim MessageBundle
 *
 * (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Okulbilisim\MessageBundle\Model\FrontModel;

use Okulbilisim\MessageBundle\Model\FrontModel\BaseModel;
use Okulbilisim\MessageBundle\Model\FrontModel\ModelInterface;

use Okulbilisim\MessageBundle\Entity\Message;

/**
 *
 * @category Okulbilisim
 * @package  MessageBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * 
 *
 */
class MessageModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @return \Okulbilisim\MessageBundle\Entity\Message
     */
    public function createMessage()
    {
        return $this->getManager()->createMessage();
    }

    /**
     *
     * @access public
     * @param  int                                       $messageId
     * @return \Okulbilisim\MessageBundle\Entity\Message
     */
    public function getAllEnvelopesForMessageById($messageId)
    {
        return $this->getRepository()->getAllEnvelopesForMessageById($messageId);
    }

    /**
     *
     * @access public
     * @param  \Okulbilisim\MessageBundle\Entity\Message                         $message
     * @return \Okulbilisim\MessageBundle\Model\Component\Manager\MessageManager
     */
    public function saveMessage(Message $message)
    {
        return $this->getManager()->saveMessage($message);
    }
}
