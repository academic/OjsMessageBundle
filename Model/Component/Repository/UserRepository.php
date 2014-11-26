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

namespace OjsMessage\MessageBundle\Model\Component\Repository;

use OjsMessage\MessageBundle\Model\Component\Repository\BaseRepository;
use OjsMessage\MessageBundle\Model\Component\Repository\RepositoryInterface;

/**
 * ThreadRepository
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
class UserRepository extends BaseRepository implements RepositoryInterface
{
    /**
     *
     * @access public
     * @param  int                                                 $userId
     * @return \Symfony\Component\Security\Core\User\UserInterface
     */
    public function findOneUserById($userId)
    {
        if (null == $userId || ! is_numeric($userId) || $userId == 0) {
            throw new \Exception('User ID "' . $userId . '" is invalid!');
        }

        $params = array(':userId' => $userId);

        $qb = $this->createSelectQuery(array('u'));

        $qb
            ->where('u.id = :userId')
        ;

        return $this->gateway->findUser($qb, $params);
    }

    /**
     *
     * @access public
     * @param  Array()                                      $usernames
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findTheseUsersByUsername(array $usernames = array())
    {
        if (null == $usernames || count($usernames) < 1) {
            throw new \Exception('Usernames array must be provided!');
        }

        $params = array();

        $qb = $this->createSelectQuery(array('u'));

        $qb
            ->where($qb->expr()->in('u.username', $usernames))
        ;

        return $this->gateway->findUsers($qb, $params);
    }
}
