<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
interface FactoryInterface
{
    /**
     * Create an retrun an instance
     */
    public function createInstance(ServiceLocatorInterface $serviceLocator);
}