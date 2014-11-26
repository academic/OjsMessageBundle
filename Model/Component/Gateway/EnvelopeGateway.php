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

namespace Okulbilisim\MessageBundle\Model\Component\Gateway;

use Doctrine\ORM\QueryBuilder;

use Okulbilisim\MessageBundle\Model\Component\Gateway\GatewayInterface;
use Okulbilisim\MessageBundle\Model\Component\Gateway\BaseGateway;

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
class EnvelopeGateway extends BaseGateway implements GatewayInterface
{
    /**
     *
     * @access private
     * @var string $queryAlias
     */
    protected $queryAlias = 'e';

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @param  Array                                        $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findEnvelope(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createSelectQuery();
        }

        return $this->one($qb, $parameters);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @param  Array                                        $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findEnvelopes(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createSelectQuery();
        }

        $qb
            ->addOrderBy('e.sentDate', 'DESC')
        ;

        return $this->all($qb, $parameters);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @param  Array                      $parameters
     * @return int
     */
    public function countEnvelopes(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createCountQuery();
        }

        if (null == $parameters) {
            $parameters = array();
        }

        $qb->setParameters($parameters);

        try {
            return $qb->getQuery()->getSingleScalarResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return 0;
        }
    }

    /**
     *
     * @access public
     * @param  \Okulbilisim\MessageBundle\Entity\Envelope                          $envelope
     * @return \Okulbilisim\MessageBundle\Model\Component\Gateway\GatewayInterface
     */
    public function saveEnvelope(Envelope $envelope)
    {
        $this->persist($envelope)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  \Okulbilisim\MessageBundle\Entity\Envelope                          $envelope
     * @return \Okulbilisim\MessageBundle\Model\Component\Gateway\GatewayInterface
     */
    public function updateEnvelope(Envelope $envelope)
    {
        $this->persist($envelope)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  \Okulbilisim\MessageBundle\Entity\Envelope                          $envelope
     * @return \Okulbilisim\MessageBundle\Model\Component\Gateway\GatewayInterface
     */
    public function deleteEnvelope(Envelope $envelope)
    {
        $this->remove($envelope)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @return \Okulbilisim\MessageBundle\Entity\Envelope
     */
    public function createEnvelope()
    {
        return new $this->entityClass();
    }
}
