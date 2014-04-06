<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
use TestBox\Framework\Configuration\ConfigurationInterface;

class Factory extends ServiceAbstract
{
    /**
     * Class to instanciate
     * 
     * This class have to be implements Factory Interface
     * 
     * @var string
     */
    protected $factoryName;
    
    /**
     * Factor instance
     * 
     * @var FactoryInterface
     */
    protected $factoryInstance;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceAbstract::getInstance()
     */
    public function getInstance(ServiceLocatorInterface $serviceLocator)
    {
        if ( ! $this->factoryInstance){
            $factoryName = $this->factoryName;
            $this->factoryInstance = new $factoryName();
        }
        if ($this->isShared) {
            if ( ! $this->sharedInstance) {
                $this->sharedInstance = $this->factoryInstance->createInstance($serviceLocator);
            }
            return $this->sharedInstance;
        }
        return $this->factoryInstance->createInstance($serviceLocator);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceAbstract::configure()
     * 
     * Configure:
     * factory: Name of the factory class
     */
    public function configure(ConfigurationInterface $options)
    {
        parent::configure($options);
        if (isset($options->factory)) $this->factoryName = $options->factory;
    }
    
    
}