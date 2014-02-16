<?php
namespace TestBox\Framework\ServiceLocator\service;

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
    public function getInstance()
    {
        if ( ! $this->factoryInstance){
            $factoryName = $this->factoryName;
            $this->factoryInstance = new $factoryName();
        }
        if ($this->isShared) {
            if ( ! $this->sharedInstance) {
                $this->sharedInstance = $this->factoryInstance->createInstance();
            }
            return $this->sharedInstance;
        }
        return $this->factoryInstance->createInstance();
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceAbstract::configure()
     */
    public function configure($options)
    {
        parent::configure($options);
        if (isset($options['factory'])) $this->factoryName = $options['factory'];
    }
    
    
}