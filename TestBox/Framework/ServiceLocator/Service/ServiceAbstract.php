<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
use TestBox\Framework\Configuration\ConfigurationInterface;

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
     * Configuration
     * 
     * @var ConfigurationInterface
     */
    protected $config;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServeInterface::isShared()
     */
    public function isShared()
    {
        return $this->isShared;
    }
    
    /**
     * Set configuration
     * 
     * @param ConfigurationInterface $config
     */
    public function setConfig(ConfigurationInterface $config)
    {
        $this->config = $config
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceInterface::setOptions()
     * 
     * Configure:
     * isShared: Shared service or not
     */
    public function configure(ConfigurationInterface $options)
    {
        if (isset($option->isShared)) $this->isShared = $options->isShared;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServeInterface::getInstance()
     */
    abstract public function getInstance(ServiceLocatorInterface $serviceLocator);
}