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

namespace OjsMessage\MessageBundle\Form\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

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
class BaseFormHandler
{
    /**
     *
     * @access protected
     * @var \Symfony\Component\Form\FormFactory $factory
     */
    protected $factory;

    /**
     *
     * @access protected
     * @var \Symfony\Component\Form\Form $form
     */
    protected $form;

    /**
     *
     * @access protected
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface  $dispatcher
     */
    protected $dispatcher;

    /**
     *
     * @access protected
     * @var \Symfony\Component\HttpFoundation\Request $request
     */
    protected $request;

    /**
     *
     * @access protected
     * @var \Symfony\Component\Security\Core\User\UserInterface $user
     */
    protected $user;

    /**
     *
     * @access public
     * @param  \Symfony\Component\Security\Core\User\UserInterface     $user
     * @return \OjsMessage\MessageBundle\Form\Handler\BaseFormHandler
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     *
     * @access public
     * @param  \Symfony\Component\HttpFoundation\Request               $request
     * @return \OjsMessage\MessageBundle\Form\Handler\BaseFormHandler
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     *
     * @access public
     * @return bool
     */
    public function process()
    {
        $this->getForm();

        if ($this->request->getMethod() == 'POST') {
            $this->form->bind($this->request);

            // Validate
            if ($this->form->isValid()) {
                if ($this->getSubmitAction() == 'post') {
                    $formData = $this->form->getData();

                    return $this->onSuccess($formData);
                }
            }
        }

        return false;
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getSubmitAction()
    {
        if ($this->request->request->has('submit')) {
            $action = key($this->request->request->get('submit'));
        } else {
            $action = 'post';
        }

        return $action;
    }
}
