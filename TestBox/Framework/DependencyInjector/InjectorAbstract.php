<?php
namespace TextBox\Framework\DependencyInjector;

use TestBox\Framework\DependencyInjector\InjectorInterface;
use TestBox\Framework\Configuration\ConfigurationInterface;

abstract class InjectorAbstract implements InjectorInterface
{
    /**
     * Configuration
     * 
     * @var ConfigurationInterface
     */
    protected $config;
    
    /**
     * Injected instance
     * 
     * @var mixed
     */
    protected $instance;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\DependencyInjector\InjectorInterface::getInstance()
     */
    public function getInstance()
    {
        if ( ! $this->instance) $this->configure($this->config);
        return $this->instance;
    }
    
	/**
     * @param \TextBox\Framework\DependencyInjector\ConfigurationInterface $config
     */
    public function setConfig(ConfigurationInterface $config)
    {
        $this->config = $config;
    }

}