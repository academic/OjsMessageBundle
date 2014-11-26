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

namespace OjsMessage\MessageBundle\Component\Helper;

use Symfony\Component\Security\Core\User\UserInterface;
use OjsMessage\MessageBundle\Model\FrontModel\RegistryModel;

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
class RegistryHelper
{
    /**
     *
     * @access protected
     * @var \OjsMessage\MessageBundle\Model\FrontModel\RegistryModel $registryModel
     */
    protected $registryModel;

    /**
     *
     * @access public
     * @param \OjsMessage\MessageBundle\Model\FrontModel\RegistryModel $registryModel
     */
    public function __construct(RegistryModel $registryModel)
    {
        $this->registryModel = $registryModel;
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\Security\Core\User\UserInterface $user
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findOneRegistryForUserById(UserInterface $user)
    {
        $registry = $this->registryModel->findOneRegistryForUserById($user->getId());

        if (null == $registry) {
            $this->registryModel->setupDefaults($user);

            $registry = $this->registryModel->findOneRegistryForUserById($user->getId());
        }

        return $registry;
    }
}
