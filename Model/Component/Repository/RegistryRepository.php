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

namespace Okulbilisim\MessageBundle\Model\Component\Repository;

use Okulbilisim\MessageBundle\Model\Component\Repository\BaseRepository;
use Okulbilisim\MessageBundle\Model\Component\Repository\RepositoryInterface;

/**
 * RegistryRepository
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
class RegistryRepository extends BaseRepository implements RepositoryInterface
{
    /**
     *
     * @access public
     * @param  int                                        $userId
     * @return \Okulbilisim\MessageBundle\Entity\Registry
     */
    public function findOneRegistryForUserById($userId)
    {
        if (null == $userId || ! is_numeric($userId) || $userId == 0) {
            throw new \Exception('User id "' . $userId . '" is invalid!');
        }

        $params = array(':userId' => $userId);

        $qb = $this->createSelectQuery(array('r', 'r_owned_by'));

        $qb
            ->leftJoin('r.ownedByUser', 'r_owned_by')
            ->where('r.ownedByUser = :userId')
            ->setParameters($params)
            ->setMaxResults(1);

        return $this->gateway->findRegistry($qb, $params);
    }
}
