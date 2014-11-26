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

namespace Okulbilisim\MessageBundle\Component\Crumbs;

use Okulbilisim\MessageBundle\Entity\Folder;
use Okulbilisim\MessageBundle\Entity\Envelope;

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
class CrumbBuilder extends BaseCrumbBuilder
{
    /**
     *
     * @access public
     * @param  \Okulbilisim\MessageBundle\Entity\Message                      $folder
     * @return \Okulbilisim\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserFolderShow(Folder $folder)
    {
        if ($folder->getSpecialType() < 1) {
            $pathParams = array(
                'route' => 'okulbilisim_message_user_folder_show_by_id',
                'params' => array(
                    'FolderId' => $folder->getId()
                )
            );
        } else {
            $pathParams = array(
                'route' => 'okulbilisim_message_user_index',
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
     * @param  \Okulbilisim\MessageBundle\Entity\Envelope                     $envelope
     * @return \Okulbilisim\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserMessageShow(Envelope $envelope)
    {
        return $this->addUserFolderShow($envelope->getFolder())
            ->add(
                $envelope->getMessage()->getSubject(),
                array(
                    'route' => 'okulbilisim_message_user_mail_show_by_id',
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
     * @param  \Okulbilisim\MessageBundle\Entity\Folder                       $folder
     * @return \Okulbilisim\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserMessageCreate(Folder $folder)
    {
        return $this->addUserFolderShow($folder)
            ->add(
                array(
                    'label' => 'crumbs.user.message.compose.new',
                ),
                array(
                    'route' => 'okulbilisim_message_user_mail_compose',
                    'params' => array()
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param  \Okulbilisim\MessageBundle\Entity\Envelope                     $envelope
     * @return \Okulbilisim\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserMessageReply(Envelope $envelope)
    {
        return $this->addUserMessageShow($envelope)
            ->add(
                array(
                    'label' => 'crumbs.user.message.compose.reply',
                ),
                array(
                    'route' => 'okulbilisim_message_user_mail_compose_reply',
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
     * @param  \Okulbilisim\MessageBundle\Entity\Envelope                     $envelope
     * @return \Okulbilisim\MessageBundle\Component\Crumbs\Factory\CrumbTrail
     */
    public function addUserMessageForward(Envelope $envelope)
    {
        return $this->addUserMessageShow($envelope)
            ->add(
                array(
                    'label' => 'crumbs.user.message.compose.forward',
                ),
                array(
                    'route' => 'okulbilisim_message_user_mail_compose_forward',
                    'params' => array(
                        'envelopeId' => $envelope->getId(),
                    )
                )
            )
        ;
    }
}
