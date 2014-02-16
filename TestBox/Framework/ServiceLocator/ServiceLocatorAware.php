<?php
namespace TestBox\Framework\ServiceLocator;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

interface ServiceLocatorAware
{
    /**
     * Return service locator
     * 
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator();
    
    /**
     * Set service locator
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator);
}