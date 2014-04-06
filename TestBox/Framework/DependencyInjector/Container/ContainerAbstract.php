<?php
namespace TestBox\Framework\DependencyInjector\Container;

use TestBox\Framework\ServiceLocator\ServiceLocatorAbstract;
use TestBox\Framework\Configuration\ConfigurationInterface;
use TestBox\Framework\Configuration\ConfigurationArray;

abstract class ContainerAbstract extends ServiceLocatorAbstract implements ContainerInterface
{
    /**
     * Container configuration
     * 
     * @var ConfigurationInterface
     */
    protected $config;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorAbstract::configure()
     * 
     * Configure :
     * key: name of instance {
     *      diClass:    injector class to use
     *      options:    injector configuration (class, properties, etc.)
     * }
     */
    public function configure(ConfigurationInterface $config)
    {
        $this->setConfig($config);
    }
    
    /**
     * Get instance
     * 
     * @param string $key
     */
    public function getInstance($key)
    {
        if ( ! $this->hasService($key)) {
            $this->defineService($key, new ConfigurationArray(array(
            	'serviceClass' => 'DependencyInjection',
                'options' => $this->config->get($key),
            )));
        }
        return $this->get($key);
    }

	/**
     * @param \TestBox\Framework\Configuration\ConfigurationInterface $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

}