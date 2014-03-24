<?php
namespace TestBox\DataInjector;

use TestBox\Framework\ServiceLocator\Service\FactoryInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

class DataInjectorManagerFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\Service\FactoryInterface::createInstance()
     */
    public function createInstance(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $dataInjectorManager = new DataInjectorManager();
        $dataInjectorManager->configure($config['data_injectors']);
        return $dataInjectorManager;
    }
}