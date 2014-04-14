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
     *      diClass:    injector class to use ('StandardInjector' as default)
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
     * If intance is not define, you can set it on the fly by giving its configuration
     * @param string $key
     * @param ConfigurationInterface $config diclass and options
     * @return mixed;
     */
    public function getInstance($key, ConfigurationInterface $config = null, $isShared = true)
    {
        if ( ! $this->hasService($key)) {
            if ( ! $config) {
                $config = $this->config->get($key);
            }
            $serviceConfig = new ConfigurationArray(array(
                'isShared' => $isShared,
                'serviceClass' => 'DependencyInjection',
                'options' => $config,
            ));
            $this->defineService($key, $serviceConfig);
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