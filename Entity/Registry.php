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

namespace OjsMessage\MessageBundle\Entity;

use OjsMessage\MessageBundle\Entity\Model\RegistryModel;

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
class Registry extends RegistryModel
{
    /**
     *
     * @var integer $id
     */
    protected $id;

    /**
     *
     * @var integer $cachedUnreadMessageCount
     */
    protected $cachedUnreadMessageCount = 0;

    /**
     *
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get cachedUnreadMessageCount
     *
     * @return integer
     */
    public function getCachedUnreadMessageCount()
    {
        return $this->cachedUnreadMessageCount;
    }

    /**
     * Set cachedUnreadMessageCount
     *
     * @param  integer  $cachedUnreadMessageCount
     * @return Registry
     */
    public function setCachedUnreadMessageCount($cachedUnreadMessageCount)
    {
        $this->cachedUnreadMessageCount = $cachedUnreadMessageCount;

        return $this;
    }
}
