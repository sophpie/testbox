<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
use TestBox\Framework\DependencyInjector\ReflectionInjector;

class DependencyInjection extends ServiceAbstract
{
    /**
     * DependencyInjector
     * 
     * @var ReflectionInjector
     */
    protected $dependencyInjector;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\Service\ServiceAbstract::configure()
     */
    public function configure(Array $options)
    {
        parent::configure($options);
        if (isset($options['diclass'])){
            $diclass = $options['diclass'];
            $this->dependencyInjector = new $diclass();
            $this->dependencyInjector->configure($options['options']);
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\Service\ServiceAbstract::getInstance()
     */
    public function getInstance(ServiceLocatorInterface $serviceLocator)
    {
        if ($this->isShared) {
            if ( ! $this->sharedInstance) {
                $this->sharedInstance = $this->dependencyInjector->getInstance();
            }
            return $this->sharedInstance;
        }
        return $this->dependencyInjector->getInstance();
    }
}