<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Framework\Configuration\ConfigurationAbstract;

abstract class ServiceAbstract implements ServiceInterface, ConfigurableInterface
{
    /**
     * Check if the instance is hunique
     * @var unknown
     */
    protected $isShared = true;
    
    /**
     * Shared instance
     * 
     * @var mixed
     */
    protected $sharedInstance;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServeInterface::isShared()
     */
    public function isShared()
    {
        return $this->isShared;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceInterface::setOptions()
     */
    public function configure(Array $options)
    {
        if (isset($option['isShared'])) $this->isShared = $options['isShared'];
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServeInterface::getInstance()
     */
    abstract public function getInstance();
}