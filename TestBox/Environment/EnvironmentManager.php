<?php
namespace TestBox\Environment;

use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorAbstract;
use TestBox\Environment\Environment;

class EnvironmentManager extends ServiceLocatorAbstract implements ConfigurableInterface
{
    /**
     * Default environment
     * 
     * @var string
     */
    protected $defaultEnvironmentName;
    
    /**
     * Environments list
     * 
     * @var array
     */
    protected $environmentsList = array();
    
	/**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     */
    public function configure($options)
    {
        foreach ($options as $envName => $environment)
        {
            if (isset($environment['isDefault'])){
                if ($environment['isDefault'] && empty($this->defaultEnvironmentName))
                    $this->defaultEnvironmentName = $envName;
            }
            $this->environmentsList[$envName] = new Environment($environment['elements']);
        }
    }
    
    /**
     * Return the requested environment
     * 
     * @param name $name
     * @return EnvironmentAbstract
     */
    public function getEnvironment($name = null)
    {
        if ( ! $name) $name = $this->getDefaultEnvironmentName();
        return $this->environmentsList[$name];
    }
        
	/**
     * @return the $defaultEnvironment
     */
    public function getDefaultEnvironmentName()
    {
        return $this->defaultEnvironmentName;
    }

	/**
     * @param string $defaultEnvironment
     */
    public function setDefaultEnvironmentName($name)
    {
        $this->defaultEnvironmentName = $name;
    }

}