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

namespace Okulbilisim\MessageBundle\Entity\Model;

use Okulbilisim\MessageBundle\Entity\Envelope;
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
 * @abstract
 *
 */
abstract class ThreadModel
{
    /**
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $messages
     */
    protected $messages = null;

    /**
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $envelopes
     */
    protected $envelopes = null;

    /**
     *
     * @access public
     */
    public function __construct()
    {
        // your own logic
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set messages
     *
     * @param  \Doctrine\Common\Collections\ArrayCollection|Array $messages
     * @return \Okulbilisim\MessageBundle\Entity\Thread
     */
    public function setMessages($messages = null)
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * Add message
     *
     * @param  \Okulbilisim\MessageBundle\Entity\Message $message
     * @return \Okulbilisim\MessageBundle\Entity\Thread
     */
    public function addMessage(Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Get envelopes
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getEnvelopes()
    {
        return $this->envelopes;
    }

    /**
     * Set envelopes
     *
     * @param  \Doctrine\Common\Collections\ArrayCollection|Array $envelopes
     * @return \Okulbilisim\MessageBundle\Entity\Thread
     */
    public function setEnvelopes($envelopes = null)
    {
        $this->envelopes = $envelopes;

        return $this;
    }

    /**
     * Add envelope
     *
     * @param  \Okulbilisim\MessageBundle\Entity\Envelope $envelope
     * @return \Okulbilisim\MessageBundle\Entity\Thread
     */
    public function addEnvelope(Envelope $envelope)
    {
        $this->envelopes[] = $envelope;

        return $this;
    }
}
