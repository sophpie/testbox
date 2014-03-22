<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

interface ServiceInterface
{
    /**
     * Return an instance
     * 
     * @param $serviceLocator ServiceLocator
     */
    public function getInstance(ServiceLocatorInterface $serviceLocator);
    
    /**
     * Check if the instance is shared
     */
    public function isShared();
}