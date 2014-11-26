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
 * MessageRepository
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
class MessageRepository extends BaseRepository implements RepositoryInterface
{
    /**
     *
     * @access public
     * @param  int                                       $messageId
     * @return \Okulbilisim\MessageBundle\Entity\Message
     */
    public function getAllEnvelopesForMessageById($messageId)
    {
        if (null == $messageId || ! is_numeric($messageId) || $messageId == 0) {
            throw new \Exception('Message id "' . $messageId . '" is invalid!');
        }

        $params = array(':messageId' => $messageId);

        $qb = $this->createSelectQuery(array('m', 'm_e', 'm_t', 'm_t_messages'));

        $qb
            ->leftJoin('m.envelopes', 'm_e')
            ->leftJoin('m.thread', 'm_t')
            ->leftJoin('m_t.messages', 'm_t_messages')
            ->where('m.id = :messageId')
            ->setParameters($params)
            ->addOrderBy('m.createdDate', 'DESC')
        ;

        return $this->gateway->findMessage($qb, $params);
    }
}
