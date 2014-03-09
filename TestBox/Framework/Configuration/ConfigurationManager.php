<?php
namespace TestBox\Framework\Configuration;

class ConfigurationManager
{
    /**
     * Merged configuration
     * 
     * @var ConfigurationAbstract
     */
    protected $mergedConfiguration;
    
    /**
     * Constructor
     * 
     * @param array $configurationArray
     */
    public function __construct($configurationArray = array())
    {
        $this->mergedConfiguration = new Configuration($configurationArray);
    }
    
    /**
     * Add a new configuration
     * 
     * @param ConfigurationAbstract $newConfiguration
     */
    public function add(ConfigurationAbstract $newConfiguration)
    {
        $this->mergedConfiguration->merge($newConfiguration);
    }
    
    /**
     * Add configuration from a php file
     * 
     * @param string $phpFile
     */
    public function addFilePhp($phpFile)
    {
        $array = include_once $phpFile;
        $newConfiguration = new Configuration($array);
        $this->add($newConfiguration);
    }
    
    /**
     * Return merged configuration
     * 
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->mergedConfiguration;
    }
}