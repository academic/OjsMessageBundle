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

namespace OjsMessage\MessageBundle\Component\Dispatcher;

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
final class MessageEvents
{
    /**
     *
     * The USER_MESSAGE_CREATE_INITIALISE event occurs when the Message creation process is initalised.
     *
     * This event allows you to modify the default values of the Message entity object before binding the form.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent instance.
     */
    const USER_MESSAGE_CREATE_INITIALISE = 'ojs_message.user.message.create.initialise';

    /**
     *
     * The USER_MESSAGE_CREATE_SUCCESS event occurs when the Message creation process is successful before persisting.
     *
     * This event allows you to modify the values of the Message entity object after form submission before persisting.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent instance.
     */
    const USER_MESSAGE_CREATE_SUCCESS = 'ojs_message.user.message.create.success';

    /**
     *
     * The USER_MESSAGE_CREATE_COMPLETE event occurs when the Message creation process is completed successfully after persisting.
     *
     * This event allows you to modify the values of the Message entity after persisting.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent instance.
     */
    const USER_MESSAGE_CREATE_COMPLETE = 'ojs_message.user.message.create.complete';

    /**
     *
     * The USER_MESSAGE_CREATE_RESPONSE event occurs when the Message creation process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageResponseEvent instance.
     */
    const USER_MESSAGE_CREATE_RESPONSE = 'ojs_message.user.message.create.response';

    /**
     *
     * The USER_MESSAGE_CREATE_FLOODED event occurs when the message create process fails due to flooding being raised.
     *
     * This event allows you to modify the request object and set a flash message from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageFloodEvent instance.
     */
    const USER_MESSAGE_CREATE_FLOODED = 'ojs_message.user.message.create.flooded';

    /**
     *
     * The USER_MESSAGE_CREATE_REPLY_INITIALISE event occurs when the Message creation process is initalised.
     *
     * This event allows you to modify the default values of the Message entity object before binding the form.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent instance.
     */
    const USER_MESSAGE_CREATE_REPLY_INITIALISE = 'ojs_message.user.message.create_reply.initialise';

    /**
     *
     * The USER_MESSAGE_CREATE_REPLY_SUCCESS event occurs when the Message creation process is successful before persisting.
     *
     * This event allows you to modify the values of the Message entity object after form submission before persisting.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent instance.
     */
    const USER_MESSAGE_CREATE_REPLY_SUCCESS = 'ojs_message.user.message.create_reply.success';

    /**
     *
     * The USER_MESSAGE_CREATE_REPLY_COMPLETE event occurs when the Message creation process is completed successfully after persisting.
     *
     * This event allows you to modify the values of the Message entity after persisting.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent instance.
     */
    const USER_MESSAGE_CREATE_REPLY_COMPLETE = 'ojs_message.user.message.create_reply.complete';

    /**
     *
     * The USER_MESSAGE_CREATE_REPLY_RESPONSE event occurs when the Message creation process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageResponseEvent instance.
     */
    const USER_MESSAGE_CREATE_REPLY_RESPONSE = 'ojs_message.user.message.create_reply.response';

    /**
     *
     * The USER_MESSAGE_CREATE_FLOODED event occurs when the message create reply process fails due to flooding being raised.
     *
     * This event allows you to modify the request object and set a flash message from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageFloodEvent instance.
     */
    const USER_MESSAGE_CREATE_REPLY_FLOODED = 'ojs_message.user.message.create_reply.flooded';

    /**
     *
     * The USER_MESSAGE_CREATE_FORWARD_INITIALISE event occurs when the Message creation process is initalised.
     *
     * This event allows you to modify the default values of the Message entity object before binding the form.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent instance.
     */
    const USER_MESSAGE_CREATE_FORWARD_INITIALISE = 'ojs_message.user.message.create_forward.initialise';

    /**
     *
     * The USER_MESSAGE_CREATE_FORWARD_SUCCESS event occurs when the Message creation process is successful before persisting.
     *
     * This event allows you to modify the values of the Message entity object after form submission before persisting.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent instance.
     */
    const USER_MESSAGE_CREATE_FORWARD_SUCCESS = 'ojs_message.user.message.create_forward.success';

    /**
     *
     * The USER_MESSAGE_CREATE_FORWARD_COMPLETE event occurs when the Message creation process is completed successfully after persisting.
     *
     * This event allows you to modify the values of the Message entity after persisting.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageEvent instance.
     */
    const USER_MESSAGE_CREATE_FORWARD_COMPLETE = 'ojs_message.user.message.create_forward.complete';

    /**
     *
     * The USER_MESSAGE_CREATE_FORWARD_RESPONSE event occurs when the Message creation process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageResponseEvent instance.
     */
    const USER_MESSAGE_CREATE_FORWARD_RESPONSE = 'ojs_message.user.message.create_forward.response';

    /**
     *
     * The USER_MESSAGE_CREATE_FLOODED event occurs when the message create forward process fails due to flooding being raised.
     *
     * This event allows you to modify the request object and set a flash message from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageFloodEvent instance.
     */
    const USER_MESSAGE_CREATE_FORWARD_FLOODED = 'ojs_message.user.message.create_forward.flooded';

    /**
     *
     * The USER_ENVELOPE_RECEIVE_COMPLETE event occurs when the envelope receiving process is completed after persisting.
     *
     * This event allows you to modify the request object and set a flash message.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserEnvelopeReceiveEvent instance.
     */
    const USER_ENVELOPE_RECEIVE_COMPLETE = 'ojs_message.user.envelope.receive.complete';

    /**
     *
     * The USER_ENVELOPE_RECEIVE_FAILED_INBOX_FULL event occurs when the envelope receiving process fails due to users inbox being full.
     *
     * This event allows you to modify the request object and set a flash message.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserEnvelopeReceiveFailedInboxFullEvent instance.
     */
    const USER_ENVELOPE_RECEIVE_FAILED_INBOX_FULL = 'ojs_message.user.envelope.receive.failed.inbox_full';
    /**
     *
     * The USER_ENVELOPE_RECEIVE_FAILED_OUTBOX_FULL event occurs when the envelope receiving process fails due to users outbox being full.
     *
     * This event allows you to modify the request object and set a flash message.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserEnvelopeReceiveFailedOutboxFullEvent instance.
     */
    const USER_ENVELOPE_RECEIVE_FAILED_OUTBOX_FULL = 'ojs_message.user.envelope.receive.failed.outbox_full';

    /**
     *
     * The USER_MESSAGE_DRAFT_SEND_RESPONSE event occurs when the Message draft sending process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageResponseEvent instance.
     */
    const USER_MESSAGE_DRAFT_SEND_RESPONSE = 'ojs_message.user.message.draft_send.response';

    /**
     *
     * The USER_MESSAGE_MARK_AS_READ_RESPONSE event occurs when the Message mark as read process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageResponseEvent instance.
     */
    const USER_MESSAGE_MARK_AS_READ_RESPONSE = 'ojs_message.user.message.mark_as_unread.response';

    /**
     *
     * The USER_MESSAGE_MARK_AS_UNREAD_RESPONSE event occurs when the Message mark as unread process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageResponseEvent instance.
     */
    const USER_MESSAGE_MARK_AS_UNREAD_RESPONSE = 'ojs_message.user.message.mark_as_unread.response';

    /**
     *
     * The USER_MESSAGE_DELETE_RESPONSE event occurs when the Message delete process finishes and returns a HTTP response.
     *
     * This event allows you to modify the default values of the response object returned from the controller action.
     * The event listener method receives a OjsMessage\MessageBundle\Component\Dispatcher\Event\UserMessageResponseEvent instance.
     */
    const USER_MESSAGE_DELETE_RESPONSE = 'ojs_message.user.message.delete.response';
}
