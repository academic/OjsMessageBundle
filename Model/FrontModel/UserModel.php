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

use OjstrMessage\MessageBundle\Model\FrontModel\BaseModel;
use OjstrMessage\MessageBundle\Model\FrontModel\ModelInterface;

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
class UserModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @param  int                                                 $userId
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function findOneUserById($userId)
    {
        return $this->getRepository()->findOneUserById($userId);
    }

    /**
     *
     * @access public
     * @param  array                                        $usernames
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findTheseUsersByUsername(array $usernames = array())
    {
        return $this->getRepository()->findTheseUsersByUsername($usernames);
    }
}
