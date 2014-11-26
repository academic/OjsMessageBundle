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

use Okulbilisim\MessageBundle\Entity\Registry;

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
class RegistryGateway extends BaseGateway implements GatewayInterface
{
    /**
     *
     * @access private
     * @var string $queryAlias
     */
    protected $queryAlias = 'r';

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder                   $qb
     * @param  Array                                        $parameters
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findRegistry(QueryBuilder $qb = null, $parameters = null)
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
    public function findRegistries(QueryBuilder $qb = null, $parameters = null)
    {
        if (null == $qb) {
            $qb = $this->createSelectQuery();
        }

        $qb->addOrderBy('r.cachedUnreadMessageCount', 'ASC');

        return $this->all($qb, $parameters);
    }

    /**
     *
     * @access public
     * @param  \Doctrine\ORM\QueryBuilder $qb
     * @param  Array                      $parameters
     * @return int
     */
    public function countRegistries(QueryBuilder $qb = null, $parameters = null)
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
     * @param  \Okulbilisim\MessageBundle\Entity\Registry                          $registry
     * @return \Okulbilisim\MessageBundle\Model\Component\Gateway\GatewayInterface
     */
    public function saveRegistry(Registry $registry)
    {
        $this->persist($registry)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  \Okulbilisim\MessageBundle\Entity\Registry                          $registry
     * @return \Okulbilisim\MessageBundle\Model\Component\Gateway\GatewayInterface
     */
    public function updateRegistry(Registry $registry)
    {
        $this->persist($registry)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @param  \Okulbilisim\MessageBundle\Entity\Registry                          $registry
     * @return \Okulbilisim\MessageBundle\Model\Component\Gateway\GatewayInterface
     */
    public function deleteRegistry(Registry $registry)
    {
        $this->remove($registry)->flush();

        return $this;
    }

    /**
     *
     * @access public
     * @return \Okulbilisim\MessageBundle\Entity\Registry
     */
    public function createRegistry()
    {
        return new $this->entityClass();
    }
}
