<?php
namespace TestBox\Framework\ServiceLocator;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

interface ServiceLocatorAware
{
    /**
     * Set service locator
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator);
}