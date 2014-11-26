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
 * ThreadRepository
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
class ThreadRepository extends BaseRepository implements RepositoryInterface
{
    /**
     *
     * @access public
     * @param  int                                        $envelopeId
     * @param  int                                        $userId
     * @return \Okulbilisim\MessageBundle\Entity\Envelope
     */
    public function findThreadWithAllEnvelopesByThreadIdAndUserId($threadId, $userId)
    {
        if (null == $threadId || ! is_numeric($threadId) || $threadId == 0) {
            throw new \Exception('Thread id "' . $threadId . '" is invalid!');
        }

        if (null == $userId || ! is_numeric($userId) || $userId == 0) {
            throw new \Exception('User id "' . $userId . '" is invalid!');
        }

        $params = array(':threadId' => $threadId, ':userId' => $userId);

        $qb = $this->createSelectQuery(array('t', 'e', 'm', 'e_folder', 'e_owned_by', 'e_recipient', 'm_sender'));

        $qb
            ->leftJoin('t.envelopes', 'e')
            ->leftJoin('e.message', 'm')
            ->leftJoin('e.folder', 'e_folder')
            ->leftJoin('e.ownedByUser', 'e_owned_by')
            ->leftJoin('e.sentToUser', 'e_recipient')
            ->leftJoin('m.sentFromUser', 'm_sender')
            ->where('t.id = :threadId')
            ->andWhere('e.ownedByUser = :userId')
            ->setParameters($params)
            ->addOrderBy('e.sentDate', 'DESC')
            ->addOrderBy('m.createdDate', 'DESC')
        ;

        return $this->gateway->findThread($qb, $params);
    }
}
