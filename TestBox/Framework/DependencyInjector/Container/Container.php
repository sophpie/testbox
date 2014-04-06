<?php
namespace TestBox\Framework\DependencyInjector\Container;

use TestBox\Framework\DependencyInjector\Container\ContainerAbstract;
use TestBox\Framework\Configuration\ConfigurationInterface;

class Container extends ContainerAbstract
{
    /**
     * Constrcutor
     * 
     * @param ConfigurationInterface $config
     */
    public function __construct(ConfigurationInterface $config = null)
    {
        if ($config) $this->setConfig($config);
    }
    
}

