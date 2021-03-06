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

namespace Okulbilisim\MessageBundle\Component\Dashboard;

use CCDNComponent\DashboardBundle\Component\Integrator\Model\BuilderInterface;

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
class DashboardIntegrator
{
    /**
     *
     * @access public
     * @param CCDNComponent\DashboardBundle\Component\Integrator\Model\BuilderInterface $builder
     */
    public function build(BuilderInterface $builder)
    {
        $builder
            ->addCategory('account')
                ->setLabel('dashboard.categories.account', array(), 'OkulbilisimMessageBundle')
                ->addPages()
                    ->addPage('account')
                        ->setLabel('dashboard.pages.account', array(), 'OkulbilisimMessageBundle')
                    ->end()
                ->end()
                ->addLinks()
                    ->addLink('messages')
                        ->setAuthRole('ROLE_USER')
                        ->setRoute('okulbilisim_message_user_index')
                        ->setIcon('/bundles/ccdncomponentcommon/images/icons/Black/32x32/32x32_email.png')
                        ->setLabel('title.folder.index', array(), 'OkulbilisimMessageBundle')
                    ->end()
                ->end()
            ->end()
        ;
    }
}
