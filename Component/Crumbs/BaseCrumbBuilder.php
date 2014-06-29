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

namespace OjstrMessage\MessageBundle\Component\Crumbs;

use OjstrMessage\MessageBundle\Component\Crumbs\Factory\CrumbFactory;

/**
 *
 * @category OjstrMessage
 * @package  MessageBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT 
 *
 */
class BaseCrumbBuilder {

    /**
     *
     * @access protected
     * @var \OjstrMessage\MessageBundle\Component\Crumbs\Factory\CrumbFactory $crumbFactory
     */
    protected $crumbFactory;

    /**
     *
     * @access public
     * @param \OjstrMessage\MessageBundle\Component\Crumbs\Factory\CrumbFactory $crumbs
     */
    public function __construct(CrumbFactory $crumbFactory) {
        $this->crumbFactory = $crumbFactory;
    }

    public function createCrumbTrail() {
        return $this->crumbFactory->createNewCrumbTrail();
    }

}
