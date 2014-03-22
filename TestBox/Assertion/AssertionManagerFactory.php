<?php
namespace TestBox\Assertion;

use TestBox\Framework\ServiceLocator\Service\FactoryInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

class AssertionManagerFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\Service\FactoryInterface::createInstance()
     */
    public function createInstance(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $assertionManager = new AssertionManager($config['assertion_manager']);
        return $assertionManager;
    }
}