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
use OjsMessage\MessageBundle\Entity\Registry;

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
class RegistryModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @return \OjsMessage\MessageBundle\Entity\Registry
     */
    public function createRegistry()
    {
        return $this->getManager()->createRegistry();
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \OjsMessage\MessageBundle\Entity\Registry
     */
    public function findOrCreateOneRegistryForUser(UserInterface $user)
    {
        $registry = $this->findOneRegistryForUserById($user->getId());

        if (! $registry) {
            $registry = $this->setupDefaults($user);
        }

        return $registry;
    }

    /**
     *
     * @access public
     * @param  int                                        $userId
     * @return \OjsMessage\MessageBundle\Entity\Registry
     */
    public function findOneRegistryForUserById($userId)
    {
        return $this->getRepository()->findOneRegistryForUserById($userId);
    }

    public function updateRegistry(Registry $registry)
    {
        $this->getManager()->updateRegistry($registry);

        return $registry;
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \OjsMessage\MessageBundle\Entity\Registry
     */
    public function setupDefaults(UserInterface $user)
    {
        return $this->getManager()->setupDefaults($user);
    }
}
