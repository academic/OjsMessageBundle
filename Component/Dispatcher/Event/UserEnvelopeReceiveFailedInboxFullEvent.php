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

namespace OjsMessage\MessageBundle\Component\Dispatcher\Event;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

use OjsMessage\MessageBundle\Entity\Envelope;

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
class UserEnvelopeReceiveFailedInboxFullEvent extends Event
{
    /**
     *
     * @access protected
     * @var \Symfony\Component\HttpFoundation\Request $request
     */
    protected $request;

    /**
     *
     * @access protected
     * @var \OjsMessage\MessageBundle\Entity\Envelope $envelope
     */
    protected $envelope;

    /**
     *
     * @access protected
     * @var \Symfony\Component\Security\Core\User\UserInterface $user
     */
    protected $user;

    /**
     *
     * @access public
     * @param \Symfony\Component\HttpFoundation\Request           $request
     * @param \OjsMessage\MessageBundle\Entity\Envelope          $envelope
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     */
    public function __construct(Request $request, Envelope $envelope, UserInterface $user)
    {
        $this->request = $request;
        $this->envelope = $envelope;
        $this->user = $user;
    }

    /**
     *
     * @access public
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     *
     * @access public
     * @return \OjsMessage\MessageBundle\Entity\Envelope
     */
    public function getEnvelope()
    {
        return $this->envelope;
    }

    /**
     *
     * @access public
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}
