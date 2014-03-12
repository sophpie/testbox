<?php
/**
 * 
 *
 */
namespace TestBox\Framework\ServiceLocator;

use TestBox\Framework\ServiceLocator\service\ServiceInterface;
use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Framework\Configuration\ConfigurationAbstract;

abstract class ServiceLocatorAbstract implements ServiceLocatorInterface, ConfigurableInterface
{
    /**
     * Service stack
     * 
     * @var array
     */
    protected $serviceStack = array();
    
    /**
     * Record the service defintion
     * 
     * @var array
     */
    protected $serviceDefinitions = array();
    
    /**
     * Alias list
     * 
     * @var array
     */
    protected $alias = array();
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorInterface::addService()
     */
    public function addService($key, ServiceInterface $service)
    {
        $this->serviceStack[$key] = $service;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorInterface::defineService()
     */
    public function defineService($key, $options)
    {
        $this->serviceDefinitions[$key] = $options;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorInterface::get()
     */
    public function get($key)
    {
        if (isset($this->alias[$key])) $key = $this->alias[$key];
        if ( ! isset($this->serviceStack[$key])){
            $options = $this->serviceDefinitions[$key];
            $service = $this->ServiceFactory($options);
            $this->addService($key, $service);
        }
        else $service = $this->serviceStack[$key];
        return $service->getInstance();
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorInterface::hasService($serviceName)
     */
    public function hasService($serviceName)
    {
        if (array_key_exists($serviceName, $this->serviceDefinitions)) return true;
        if (array_key_exists($serviceName, $this->serviceStack)) return true;
        return false;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorInterface::isInstantiated()
     */
    public function isInstantiated($serviceName)
    {
        if ( ! $this->hasService($serviceName)) return false;
        if (array_key_exists($serviceName, $this->serviceStack)) return true;
        return false;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorInterface::addAlias()
     */
    public function addAlias($aliasKey, $targetKey)
    {
        $this->alias[$aliasKey] = $targetKey;
    }
    
    /**
     * Create a service from its definition
     * 
     * @param array $options
     * @return ServiceInterface
     */
    protected function ServiceFactory($options)
    {
        $serviceClass = $options['serviceClass'];
        if (class_exists(__NAMESPACE__ . '\Service\\' . $serviceClass, true))
            $serviceClass = __NAMESPACE__ . '\Service\\' . $serviceClass;
        $service = new $serviceClass();
        $service->configure($options['options']);
        return $service;
    }
    
    /**
     * Define all service by confuguration array
     * 
     * @param array $array
     */
    public function configure(Array $array)
    {
        foreach ($array as $key => $definition){
            $this->defineService($key, $definition);
        }
    }
}