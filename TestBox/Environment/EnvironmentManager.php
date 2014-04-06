<?php
namespace TestBox\Environment;

use TestBox\Framework\ServiceLocator\ServiceLocatorAbstract;
use TestBox\Environment\Environment;
use TestBox\Framework\Configuration\ConfigurationAbstract;
use TestBox\Framework\Configuration\ConfigurationInterface;

class EnvironmentManager extends ServiceLocatorAbstract
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
    public function configure(ConfigurationInterface $options)
    {
        foreach ($options as $envName => $environment)
        {
            if (isset($environment->isDefault)){
                if ($environment->isDefault && empty($this->defaultEnvironmentName))
                    $this->defaultEnvironmentName = $envName;
            }
            $this->environmentsList[$envName] = new Environment($environment->services);
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