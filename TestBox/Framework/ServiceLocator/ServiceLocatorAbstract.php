<?php
/**
 * 
 *
 */
namespace TestBox\Framework\ServiceLocator;

use TestBox\Framework\ServiceLocator\service\ServiceInterface;
use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Framework\Configuration\ConfigurationInterface;

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
        $key = $this->normalizeKey($key);
        $this->serviceStack[$key] = $service;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorInterface::defineService()
     */
    public function defineService($key, $options)
    {
        $key = $this->normalizeKey($key);
        $this->serviceDefinitions[$key] = $options;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorInterface::get()
     */
    public function get($key)
    {
        $key = $this->normalizeKey($key);
        if (isset($this->alias[$key])) $key = $this->alias[$key];
        if ( ! isset($this->serviceStack[$key])){
            $options = $this->serviceDefinitions[$key];
            $service = $this->serviceFactory($options);
            $this->addService($key, $service);
        }
        else $service = $this->serviceStack[$key];
        return $service->getInstance($this);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorInterface::hasService($serviceName)
     */
    public function hasService($serviceName)
    {
        $serviceName = $this->normalizeKey($serviceName);
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
        $serviceName = $this->normalizeKey($serviceName);
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
        $aliasKey = $this->normalizeKey($aliasKey);
        $targetKey = $this->normalizeKey($targetKey);
        $this->alias[$aliasKey] = $targetKey;
    }
    
    /**
     * Create a service from its definition
     * 
     * @param array $options
     * @return ServiceInterface
     */
    protected function serviceFactory($options)
    {
        $serviceClass = ucfirst($options->serviceClass);
        if (class_exists(__NAMESPACE__ . '\Service\\' . $serviceClass, true))
            $serviceClass = __NAMESPACE__ . '\Service\\' . $serviceClass;
        $service = new $serviceClass();
        $service->setConfig($options->options);
        return $service;
    }
    
    /**
     * Define all service by confuguration array
     * 
     * @param ConfigurationInterface $array
     * 
     * Configure:
     * key: service key {
     *      serviceClass:   Service class to instanciate
     *      isShared:       Shared service or not
     *      options:        Service configuration
     * }
     */
    public function configure(ConfigurationInterface $array)
    {
        foreach ($array as $key => $definition){
            $this->defineService($key, $definition);
        }
    }
    
    /**
     * Normalize service locator keys
     * 
     * @param string $key
     * @return string
     */
    protected function normalizeKey($key)
    {
        $key = strtolower($key);
        $key = preg_replace('@[^a-z0-9]@', '', $key);
        return $key;
    }
}