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

namespace Okulbilisim\MessageBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
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
class OkulbilisimMessageExtension extends Extension
{
    /**
     *
     * @access public
     * @return string
     */
    public function getAlias()
    {
        return 'okulbilisim_message';
    }

    /**
     *
     * @access public
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Class file namespaces.
        $this->getEntitySection($config, $container);
        $this->getRepositorySection($config, $container);
        $this->getGatewaySection($config, $container);
        $this->getManagerSection($config, $container);
        $this->getModelSection($config, $container);
        $this->getFormSection($config, $container);
        $this->getComponentSection($config, $container);

        // Configuration stuff.
        $container->setParameter('okulbilisim_message.template.engine', $config['template']['engine']);
        $container->setParameter('okulbilisim_message.template.pager_theme', $config['template']['pager_theme']);

        $this->getQuotasSection($config, $container);
        $this->getSEOSection($config, $container);
        $this->getFolderSection($config, $container);
        $this->getMessageSection($config, $container);

        // Load Service definitions.
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('services/model.yml');
        $loader->load('services/model-gateway.yml');
        $loader->load('services/model-manager.yml');
        $loader->load('services/model-repository.yml');
        $loader->load('services/forms-message.yml');
        $loader->load('services/components.yml');
        $loader->load('services/twig-extensions.yml');
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getEntitySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.entity.folder.class', $config['entity']['folder']['class']);
        $container->setParameter('okulbilisim_message.entity.message.class', $config['entity']['message']['class']);
        $container->setParameter('okulbilisim_message.entity.envelope.class', $config['entity']['envelope']['class']);
        $container->setParameter('okulbilisim_message.entity.registry.class', $config['entity']['registry']['class']);
        $container->setParameter('okulbilisim_message.entity.thread.class', $config['entity']['thread']['class']);

        if (! array_key_exists('class', $config['entity']['user'])) {
            throw new \Exception('You must set the class of the User entity in "app/config/config.yml" or some imported configuration file.');
        }

        $container->setParameter('okulbilisim_message.entity.user.class', $config['entity']['user']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getRepositorySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.repository.folder.class', $config['repository']['folder']['class']);
        $container->setParameter('okulbilisim_message.repository.envelope.class', $config['repository']['envelope']['class']);
        $container->setParameter('okulbilisim_message.repository.message.class', $config['repository']['message']['class']);
        $container->setParameter('okulbilisim_message.repository.thread.class', $config['repository']['thread']['class']);
        $container->setParameter('okulbilisim_message.repository.registry.class', $config['repository']['registry']['class']);
        $container->setParameter('okulbilisim_message.repository.user.class', $config['repository']['user']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getGatewaySection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.gateway.folder.class', $config['gateway']['folder']['class']);
        $container->setParameter('okulbilisim_message.gateway.envelope.class', $config['gateway']['envelope']['class']);
        $container->setParameter('okulbilisim_message.gateway.message.class', $config['gateway']['message']['class']);
        $container->setParameter('okulbilisim_message.gateway.thread.class', $config['gateway']['thread']['class']);
        $container->setParameter('okulbilisim_message.gateway.registry.class', $config['gateway']['registry']['class']);
        $container->setParameter('okulbilisim_message.gateway.user.class', $config['gateway']['user']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getManagerSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.manager.folder.class', $config['manager']['folder']['class']);
        $container->setParameter('okulbilisim_message.manager.envelope.class', $config['manager']['envelope']['class']);
        $container->setParameter('okulbilisim_message.manager.message.class', $config['manager']['message']['class']);
        $container->setParameter('okulbilisim_message.manager.thread.class', $config['manager']['thread']['class']);
        $container->setParameter('okulbilisim_message.manager.registry.class', $config['manager']['registry']['class']);
        $container->setParameter('okulbilisim_message.manager.user.class', $config['manager']['user']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getModelSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.model.folder.class', $config['model']['folder']['class']);
        $container->setParameter('okulbilisim_message.model.envelope.class', $config['model']['envelope']['class']);
        $container->setParameter('okulbilisim_message.model.message.class', $config['model']['message']['class']);
        $container->setParameter('okulbilisim_message.model.thread.class', $config['model']['thread']['class']);
        $container->setParameter('okulbilisim_message.model.registry.class', $config['model']['registry']['class']);
        $container->setParameter('okulbilisim_message.model.user.class', $config['model']['user']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getFormSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.form.type.message.class', $config['form']['type']['message']['class']);
        $container->setParameter('okulbilisim_message.form.handler.message.class', $config['form']['handler']['message']['class']);
        $container->setParameter('okulbilisim_message.form.handler.message_reply.class', $config['form']['handler']['message_reply']['class']);
        $container->setParameter('okulbilisim_message.form.handler.message_forward.class', $config['form']['handler']['message_forward']['class']);
        $container->setParameter('okulbilisim_message.form.validator.send_to.class', $config['form']['validator']['send_to']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getComponentSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.component.dashboard.integrator.class', $config['component']['dashboard']['integrator']['class']);

        $container->setParameter('okulbilisim_message.component.twig_extension.registry.class', $config['component']['twig_extension']['registry']['class']);
        $container->setParameter('okulbilisim_message.component.twig_extension.folder_list.class', $config['component']['twig_extension']['folder_list']['class']);

        $container->setParameter('okulbilisim_message.component.flood_control.class', $config['component']['flood_control']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getSEOSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.seo.title_length', $config['seo']['title_length']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getFolderSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.folder.show.layout_template', $config['folder']['show']['layout_template']);
        $container->setParameter('okulbilisim_message.folder.show.messages_per_page', $config['folder']['show']['messages_per_page']);
        $container->setParameter('okulbilisim_message.folder.show.subject_truncate', $config['folder']['show']['subject_truncate']);
        $container->setParameter('okulbilisim_message.folder.show.sent_datetime_format', $config['folder']['show']['sent_datetime_format']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getMessageSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.message.flood_control.send_limit', $config['message']['flood_control']['send_limit']);
        $container->setParameter('okulbilisim_message.message.flood_control.block_for_minutes', $config['message']['flood_control']['block_for_minutes']);

        $container->setParameter('okulbilisim_message.message.show.layout_template', $config['message']['show']['layout_template']);
        $container->setParameter('okulbilisim_message.message.show.sent_datetime_format', $config['message']['show']['sent_datetime_format']);

        $container->setParameter('okulbilisim_message.message.compose.layout_template', $config['message']['compose']['layout_template']);
        $container->setParameter('okulbilisim_message.message.compose.form_theme', $config['message']['compose']['form_theme']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                      $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                    $container
     * @return \Okulbilisim\MessageBundle\DependencyInjection\OkulbilisimMessageExtension
     */
    private function getQuotasSection(array $config, ContainerBuilder $container)
    {
        $container->setParameter('okulbilisim_message.quotas.max_messages', $config['quotas']['max_messages']);

        return $this;
    }
}
