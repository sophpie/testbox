<?php
namespace TestBox\Framework\Configuration;

class ConfigurationArray extends ConfigurationFileAbstract
{
    /**
     * Constructor
     * 
     * @param array $array
     */
    public function __construct(array $array = null)
    {
        if ($array) $this->setData($array);
    }
    
    /**
     * Set array value in configuration
     * 
     * @param array $array
     * @param string $namespace
     */
    public function setData($array, $namespace = null)
    {
        foreach ($array as $key => $value) {
            if ($namespace) $key = $namespace . self::NS_SEPARATOR . $key;
            if ( ! is_array($value)){
                $this->set($key,$value);
            }
            else {
                $this->setData($value, $key);
            }
        }
    }
}