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

namespace OjsMessage\MessageBundle\Model\FrontModel;

use Symfony\Component\Security\Core\User\UserInterface;

use OjsMessage\MessageBundle\Model\FrontModel\BaseModel;
use OjsMessage\MessageBundle\Model\FrontModel\ModelInterface;

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
 */
class FolderModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @return \OjsMessage\MessageBundle\Entity\Folder
     */
    public function createFolder()
    {
        return $this->getManager()->createFolder();
    }

    /**
     *
     * @access public
     * @param  int                                          $userId
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAllFoldersForUserById($userId)
    {
        return $this->getRepository()->findAllFoldersForUserById($userId);
    }

    /**
     *
     * @access public
     * @param  \OjsMessage\MessageBundle\Entity\Folder                         $folder
     * @return \OjsMessage\MessageBundle\Model\Component\Manager\FolderManager
     */
    public function saveFolder(Folder $folder)
    {
        return $this->getManager()->saveFolder($folder);
    }

    /**
     *
     * @access public
     * @param  \OjsMessage\MessageBundle\Entity\Folder                         $folder
     * @return \OjsMessage\MessageBundle\Model\Component\Manager\FolderManager
     */
    public function updateFolder(Folder $folder)
    {
        return $this->getManager()->updateFolder($folder);
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\Security\Core\User\UserInterface              $user
     * @return \OjsMessage\MessageBundle\Model\Component\Manager\FolderManager
     */
    public function setupDefaults(UserInterface $user)
    {
        return $this->getManager()->setupDefaults($user);
    }
}
