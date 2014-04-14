<?php
namespace TestBox\Workbench;

use TestBox\Framework\ServiceLocator\ServiceLocatorAbstract;
use TestBox\Framework\DependencyInjector\DependencyInjector;
use TestBox\Framework\Configuration\ConfigurationInterface;
use TestBox\Framework\Configuration\Configuration;
use TestBox\Framework\DependencyInjector\Container\ContainerInterface;

abstract class WorkbenchAbstract extends ServiceLocatorAbstract
{
    /**
     * Dependency injector container
     * 
     * @var ContainerInterface
     */
    protected $diContainer;
    
    /**
     * Boostrap workbench
     *
     * @param Configuration $initialConfig
     */
    public function boostrap(ConfigurationInterface $initialConfig)
    {
        $this->doConfiguration($initialConfig);
        $this->init();
    }
    
    /**
     * Get configuration
     * 
     * @return ConfigurationInterface $config
     */
    public function getConfig()
    {
        return $this->get('config');
    }
    
    /**
     * Merge configurations
     * 
     * And set it into a service
     * @param Configuration $initialConfig
     */
    abstract protected function doConfiguration(ConfigurationInterface $initialConfig);
    
    /**
     * Initiate workbench internal elements
     */
    protected function init()
    {
    }
    
	/**
	 * 
	 * @return ContainerInterface
	 */
    public function getDiContainer()
    {
        return $this->diContainer;
    }

	/**
	 * 
	 * @param ContainerInterface $diContainer
	 */
    public function setDiContainer(ContainerInterface $diContainer)
    {
        $this->diContainer = $diContainer;
    }
}