<?php
namespace TestBox\Workbench;

use TestBox\Framework\ServiceLocator\ServiceLocatorAbstract;
use TestBox\Framework\Configuration\ConfigurationManager;
use TestBox\Framework\DependencyInjector\DependencyInjector;
use TestBox\Framework\Configuration\ConfigurationAbstract;

abstract class WorkbenchAbstract extends ServiceLocatorAbstract
{
    /**
     * Configuration manager
     * 
     * @var ConfigurationManager
     */
    protected $configManager;
    
    /**
     * Dependency injector
     * 
     * @var DependencyInjector
     */
    protected $dependencyInjector;
    
	/**
     * @param \TestBox\Framework\Configuration\ConfigurationManager $configManager
     */
    public function setConfigManager($configManager)
    {
        $this->configManager = $configManager;
    }
    
    /**
     * Boostrap workbench
     *
     * @param Configuration $initialConfig
     */
    public function boostrap(ConfigurationAbstract $initialConfig)
    {
        $this->doConfiguration($initialConfig);
        $this->init();
    }
    
    /**
     * Merge configurations
     * 
     * And set it into a service
     * @param Configuration $initialConfig
     */
    abstract protected function doConfiguration(ConfigurationAbstract $initialConfig);
    
    /**
     * Initiate workbench internal elements
     */
    protected function init()
    {
        
    }
    
	/**
     * @return the $DependencyInjector
     */
    public function getDependencyInjector()
    {
        return $this->DependencyInjector;
    }

	/**
     * @param \TestBox\Framework\DependencyInjector\DependencyInjector $DependencyInjector
     */
    public function setDependencyInjector($dependencyInjector)
    {
        $this->dependencyInjector = $dependencyInjector;
    }
}