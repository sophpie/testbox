<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
use TestBox\Framework\DependencyInjector\ReflectionInjector;
use TestBox\Framework\Configuration\ConfigurationInterface;
use TestBox\Framework\DependencyInjector\InjectorFactory;

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
     * 
     * Configure:
     * diClass: Dependency injector to intantiate
     * options: Injector options
     */
    public function configure(ConfigurationInterface $options)
    {
        $this->configure($this->config);
        parent::configure($options);
        $diClass = null;
        if (isset($options->diclass)){
            $diClass = $options->diclass;
        }
        $this->dependencyInjector = InjectorFactory::create($diClass,$options->options);
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