<?php
namespace TestBox\Framework\Configuration;

abstract class ConfigurationAbstract extends \ArrayObject
{
    /**
     * Merge a new configuration
     * 
     * @param ConfigurationAbstract $newConfiguration
     */
    public function merge(ConfigurationAbstract $newConfiguration)
    {
        $newArray = $newConfiguration->getArrayCopy();
        $oldArray = $this->getArrayCopy();
        $this->exchangeArray(array_merge_recursive($oldArray,$newArray));
    }    
}