<?php
namespace TestBox\Assertion\Plugin;

use TestBox\Framework\ServiceLocator\Service\FactoryInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
use TestBox\Scenario\PluginManager;

class PluginManagerFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\Service\FactoryInterface::createInstance()
     */
    public function createInstance(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $pluginManager = new PluginManager();
        $pluginManager->configure($config->plugins);
        return $pluginManager;
    }
}