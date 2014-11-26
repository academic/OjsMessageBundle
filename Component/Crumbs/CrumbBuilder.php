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

namespace OjsMessage\MessageBundle\Component\Crumbs;

use OjsMessage\MessageBundle\Entity\Folder;
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
class CrumbBuilder extends BaseCrumbBuilder
{
    /**
     *
     * @access public
     * @param  \OjsMessage\MessageBundle\Entity\Message                      $folder
     * @return \OjsMessage\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserFolderShow(Folder $folder)
    {
        if ($folder->getSpecialType() < 1) {
            $pathParams = array(
                'route' => 'ojs_message_message_user_folder_show_by_id',
                'params' => array(
                    'FolderId' => $folder->getId()
                )
            );
        } else {
            $pathParams = array(
                'route' => 'ojs_message_message_user_index',
                'params' => array(
                    'FolderName' => $folder->getName()
                )
            );
        }

        return $this->createCrumbTrail()
            ->add(
                $folder->getName(),
                $pathParams
            )
        ;
    }

    /**
     *
     * @access public
     * @param  \OjsMessage\MessageBundle\Entity\Envelope                     $envelope
     * @return \OjsMessage\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserMessageShow(Envelope $envelope)
    {
        return $this->addUserFolderShow($envelope->getFolder())
            ->add(
                $envelope->getMessage()->getSubject(),
                array(
                    'route' => 'ojs_message_message_user_mail_show_by_id',
                    'params' => array(
                        'envelopeId' => $envelope->getId(),
                    )
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  \OjsMessage\MessageBundle\Entity\Folder                       $folder
     * @return \OjsMessage\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserMessageCreate(Folder $folder)
    {
        return $this->addUserFolderShow($folder)
            ->add(
                array(
                    'label' => 'crumbs.user.message.compose.new',
                ),
                array(
                    'route' => 'ojs_message_message_user_mail_compose',
                    'params' => array()
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  \OjsMessage\MessageBundle\Entity\Envelope                     $envelope
     * @return \OjsMessage\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserMessageReply(Envelope $envelope)
    {
        return $this->addUserMessageShow($envelope)
            ->add(
                array(
                    'label' => 'crumbs.user.message.compose.reply',
                ),
                array(
                    'route' => 'ojs_message_message_user_mail_compose_reply',
                    'params' => array(
                        'envelopeId' => $envelope->getId(),
                    )
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  \OjsMessage\MessageBundle\Entity\Envelope                     $envelope
     * @return \OjsMessage\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserMessageForward(Envelope $envelope)
    {
        return $this->addUserMessageShow($envelope)
            ->add(
                array(
                    'label' => 'crumbs.user.message.compose.forward',
                ),
                array(
                    'route' => 'ojs_message_message_user_mail_compose_forward',
                    'params' => array(
                        'envelopeId' => $envelope->getId(),
                    )
                )
            )
        ;
    }
}
