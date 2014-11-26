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

namespace OjsMessage\MessageBundle\Form\Type\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
class MessageFormType extends AbstractType {

    /**
     *
     * @access protected
     * @var string $messageClass
     */
    protected $messageClass;

    /**
     *
     * @access public
     * @var string $messageClass
     */
    public function __construct($messageClass) {
        $this->messageClass = $messageClass;
    }

    /**
     *
     * @access public
     * @param FormBuilder $builder, array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('send_to', 'text', array(
                    'data' => $options['send_to'],
                    'label' => 'form.label.to',
                    'translation_domain' => 'OjsMessageMessageBundle',
                    'attr' => array('class' => 'form-control')
                        )
                )
                ->add('subject', 'text', array(
                    'data' => $options['subject'],
                    'label' => 'form.label.subject',
                    'translation_domain' => 'OjsMessageMessageBundle',
                    'attr' => array('class' => 'form-control')
                        )
                )
                ->add('body', 'textarea', array(
                    'data' => $options['body'],
                    'label' => 'form.label.body',
                    'translation_domain' => 'OjsMessageMessageBundle',
                    'attr' => array('class' => 'form-control')
                        )
                )
                ->add('is_flagged', 'checkbox', array(
                    'required' => false,
                    'mapped' => false,
                    'label' => 'form.label.flagged',
                    'translation_domain' => 'OjsMessageMessageBundle',
                        )
                )
        ;
    }

    /**
     *
     * @access public
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => $this->messageClass,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention' => 'message_item',
            'validation_groups' => array('message_send'),
            'send_to' => '',
            'subject' => '',
            'body' => '',
        ));
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getName() {
        return 'Message';
    }

}
