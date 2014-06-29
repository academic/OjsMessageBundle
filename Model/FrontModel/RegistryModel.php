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
use OjstrMessage\MessageBundle\Entity\Registry;

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
class RegistryModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @return \OjstrMessage\MessageBundle\Entity\Registry
     */
    public function createRegistry()
    {
        return $this->getManager()->createRegistry();
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \OjstrMessage\MessageBundle\Entity\Registry
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
     * @return \OjstrMessage\MessageBundle\Entity\Registry
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
     * @return \OjstrMessage\MessageBundle\Entity\Registry
     */
    public function setupDefaults(UserInterface $user)
    {
        return $this->getManager()->setupDefaults($user);
    }
}
