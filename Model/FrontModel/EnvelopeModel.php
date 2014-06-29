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

namespace OjstrMessage\MessageBundle\Model\FrontModel;

use Symfony\Component\Security\Core\User\UserInterface;

use OjstrMessage\MessageBundle\Model\FrontModel\BaseModel;
use OjstrMessage\MessageBundle\Model\FrontModel\ModelInterface;

use OjstrMessage\MessageBundle\Entity\Folder;
use OjstrMessage\MessageBundle\Entity\Envelope;

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
class EnvelopeModel extends BaseModel implements ModelInterface
{
    const MESSAGE_SEND = 0;
    const MESSAGE_SAVE_CARBON_COPY = 1;
    const MESSAGE_SAVE_DRAFT = 2;

    /**
     *
     * @access public
     * @return \OjstrMessage\MessageBundle\Entity\Envelope
     */
    public function createEnvelope()
    {
        return $this->getManager()->createEnvelope();
    }

    /**
     *
     * @access public
     * @param  int                                        $envelopeId
     * @param  int                                        $userId
     * @return \OjstrMessage\MessageBundle\Entity\Envelope
     */
    public function findEnvelopeByIdForUser($envelopeId, $userId)
    {
        return $this->getRepository()->findEnvelopeByIdForUser($envelopeId, $userId);
    }

    /**
     *
     * @access public
     * @param  int                                                      $folderId
     * @param  int                                                      $userId
     * @param  int                                                      $page
     * @return \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination
     */
    public function findAllEnvelopesForFolderByIdPaginated($folderId, $userId, $page, $itemsPerPage = 25)
    {
        return $this->getRepository()->findAllEnvelopesForFolderByIdPaginated($folderId, $userId, $page, $itemsPerPage);
    }

    /**
     *
     * @access public
     * @param  int                                          $envelopeId
     * @param  int                                          $userId
     * @return \Doctrine\Common\Collections\ArrayCollection
     *
     */
    public function findTheseEnvelopesByIdAndByUserId($envelopeIds, $userId)
    {
        return $this->getRepository()->findTheseEnvelopesByIdAndByUserId($envelopeIds, $userId);
    }

    /**
     *
     * @access public
     * @param  int   $folderId
     * @param  int   $userId
     * @return array
     */
    public function getReadCounterForFolderById($folderId, $userId)
    {
        return $this->getRepository()->getReadCounterForFolderById($folderId, $userId);
    }

    /**
     *
     * @access public
     * @param  int   $folderId
     * @param  int   $userId
     * @return array
     */
    public function getUnreadCounterForFolderById($folderId, $userId)
    {
        return $this->getRepository()->getUnreadCounterForFolderById($folderId, $userId);
    }

    /**
     *
     * @access public
     * @param  \OjstrMessage\MessageBundle\Entity\Envelope
     */
    public function saveEnvelope(Envelope $envelope)
    {
        return $this->getManager()->saveEnvelope($envelope);
    }

    /**
     *
     * @access public
     * @param  \OjstrMessage\MessageBundle\Entity\Envelope                         $envelope
     * @return \OjstrMessage\MessageBundle\Model\Component\Manager\EnvelopeManager
     */
    public function markAsRead(Envelope $envelope)
    {
        return $this->getManager()->markAsRead($envelope);
    }

    /**
     *
     * @access public
     * @param  array                                                              $envelopes
     * @return \OjstrMessage\MessageBundle\Model\Component\Manager\EnvelopeManager
     */
    public function bulkMarkAsRead($envelopes)
    {
        return $this->getManager()->bulkMarkAsRead($envelopes);
    }

    /**
     *
     * @access public
     * @param  Envelope                                                           $envelope
     * @return \OjstrMessage\MessageBundle\Model\Component\Manager\EnvelopeManager
     */
    public function markAsUnread(Envelope $envelope)
    {
        return $this->getManager()->markAsUnread($envelope);
    }

    /**
     *
     * @access public
     * @param  array                                                              $envelopes
     * @return \OjstrMessage\MessageBundle\Model\Component\Manager\EnvelopeManager
     */
    public function bulkMarkAsUnread($envelopes)
    {
        return $this->getManager()->bulkMarkAsUnread($envelopes);
    }

    /**
     *
     * @access public
     * @param  \OjstrMessage\MessageBundle\Entity\Envelope                         $envelope
     * @param  array                                                              $folders
     * @return \OjstrMessage\MessageBundle\Model\Component\Manager\EnvelopeManager
     */
    public function delete(Envelope $envelope, $folders)
    {
        return $this->getManager()->delete($envelope, $folders);
    }

    /**
     *
     * @access public
     * @param  array                                                              $envelopes
     * @param  array                                                              $folders
     * @param  \Symfony\Component\Security\Core\User\UserInterfaces               $user
     * @return \OjstrMessage\MessageBundle\Model\Component\Manager\EnvelopeManager
     */
    public function bulkDelete($envelopes, $folders, UserInterface $user)
    {
        return $this->getManager()->bulkDelete($envelopes, $folders, $user);
    }

    /**
     *
     * @access public
     * @param  array                                                              $envelopes
     * @param  \OjstrMessage\MessageBundle\Entity\Folder                           $moveTo
     * @return \OjstrMessage\MessageBundle\Model\Component\Manager\EnvelopeManager
     */
    public function bulkMoveToFolder($envelopes, Folder $moveTo)
    {
        return $this->getManager()->bulkMoveToFolder($envelopes, $moveTo);
    }
}
