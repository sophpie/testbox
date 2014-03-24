<?php
namespace TestBox\Test\Container;

use TestBox\Framework\ServiceLocator\ServiceLocatorAware;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

abstract class ContainerAbstract implements ContainerInterface, ServiceLocatorAware
{
    /**
     * Service locator
     * 
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;
    
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorAware::setServiceLocator()
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}