<?php
namespace TestBox\Environment;

use TestBox\Framework\ServiceLocator\Service\FactoryInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

class EnvironmentManagerFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\Service\FactoryInterface::createInstance()
     */
    public function createInstance(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $environmentManager = new EnvironmentManager();
        $environmentManager->configure($config['environmentManager']);
        return $environmentManager;
    }
}