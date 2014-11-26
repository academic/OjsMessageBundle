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

namespace Okulbilisim\MessageBundle\Model\FrontModel;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Okulbilisim\MessageBundle\Model\Component\Manager\ManagerInterface;
use Okulbilisim\MessageBundle\Model\Component\Repository\RepositoryInterface;

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
interface ModelInterface
{
    /**
     *
     * @access public
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface               $dispatcher
     * @param \Okulbilisim\MessageBundle\Model\Component\Repository\RepositoryInterface $repository
     * @param \Okulbilisim\MessageBundle\Model\Component\Manager\ManagerInterface       $manager
     */
    public function __construct(EventDispatcherInterface $dispatcher, RepositoryInterface $repository, ManagerInterface $manager);

    /**
     *
     * @access public
     * @return \Okulbilisim\MessageBundle\Model\Component\Repository\RepositoryInterface
     */
    public function getRepository();

    /**
     *
     * @access public
     * @return \Okulbilisim\MessageBundle\Model\Component\Manager\ManagerInterface
     */
    public function getManager();
}
