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

namespace Okulbilisim\MessageBundle\Component\Crumbs\Factory;

use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

use Okulbilisim\MessageBundle\Component\Crumbs\Factory\CrumbTrail;

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
class CrumbFactory
{
    /**
     *
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
     */
    private $translator;

    /**
     *
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router $router
     */
    private $router;

    /**
     *
     * @access public
     * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router         $router
     */
    public function __construct(Translator $translator, Router $router)
    {
        $this->translator = $translator;
        $this->router = $router;
    }

    public function createNewCrumbTrail()
    {
        return new CrumbTrail($this->translator, $this->router);
    }
}
