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

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use OjsMessage\MessageBundle\Model\Component\Manager\ManagerInterface;
use OjsMessage\MessageBundle\Model\Component\Repository\RepositoryInterface;

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
interface ModelInterface
{
    /**
     *
     * @access public
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface               $dispatcher
     * @param \OjsMessage\MessageBundle\Model\Component\Repository\RepositoryInterface $repository
     * @param \OjsMessage\MessageBundle\Model\Component\Manager\ManagerInterface       $manager
     */
    public function __construct(EventDispatcherInterface $dispatcher, RepositoryInterface $repository, ManagerInterface $manager);

    /**
     *
     * @access public
     * @return \OjsMessage\MessageBundle\Model\Component\Repository\RepositoryInterface
     */
    public function getRepository();

    /**
     *
     * @access public
     * @return \OjsMessage\MessageBundle\Model\Component\Manager\ManagerInterface
     */
    public function getManager();
}
