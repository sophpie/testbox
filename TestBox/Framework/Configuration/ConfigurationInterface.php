<?php
namespace TestBox\Framework\Configuration;

interface ConfigurationInterface
{
    const NS_SEPARATOR = '\\';
    
    /**
     * Get configuration data
     * 
     * @param string $name
     */
    public function get($name);
    
    /**
     * Merge configuration
     * 
     * @param ConfigurationInterface $config
     */
    public function merge(ConfigurationInterface $config);
}