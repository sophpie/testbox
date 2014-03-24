<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

class ConfigurableConstructor extends Constructor
{
    /**
     * Constructor parameter
     * 
     * @var array
     */
    protected $constructorParameter = array();
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\Service\Constructor::getInstance()
     */
    public function getInstance(ServiceLocatorInterface $serviceLocator)
    {
        if ($this->isShared) {
            if ( ! $this->sharedInstance) {
                $className = $this->className;
                $this->sharedInstance = new $className($this->constructorParameter);
            }
            return $this->sharedInstance;
        }
        return new $className($this->constructorParameter);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\Service\Constructor::configure()
     */
    public function configure(Array $options)
    {
        parent::configure($options);
        if (isset($options['parameter'])) $this->constructorParameter = $options['parameter'];
    }
}