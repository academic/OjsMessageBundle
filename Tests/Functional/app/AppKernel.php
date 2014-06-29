<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    /**
     * @return array
     */
    public function registerBundles() {
        return array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new OjstrMessage\MessageBundle\OjstrMessageMessageBundle(),
        );
    }

    /**
     * @return null
     */
    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    /**
     * @return string
     */
    public function getCacheDir() {
        return sys_get_temp_dir() . '/OjstrMessageMessageBundle/cache/' . $this->getEnvironment();
    }

    /**
     * @return string
     */
    public function getLogDir() {
        return sys_get_temp_dir() . '/OjstrMessageMessageBundle/logs';
    }

}
