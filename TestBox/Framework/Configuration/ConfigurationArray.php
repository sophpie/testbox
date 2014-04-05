<?php
namespace TestBox\Framework\Configuration;

class ConfigurationArray extends ConfigurationAbstract
{
    /**
     * Constructor
     * 
     * @param array $array
     */
    public function __construct(array $array = null)
    {
        if ($array) $this->setArrayData($array);
    }
    
    /**
     * Set array value in configuration
     * 
     * @param array $array
     * @param string $namespace
     */
    protected function setArrayData(array $array, $namespace = null)
    {
        foreach ($array as $key => $value) {
            if ($namespace) $key = $namespace . self::NS_SEPARATOR . $key;
            if ( ! is_array($value)){
                $this->set($key,$value);
            }
            elseif (is_array($value) and $this->isMonoDim($value)) {
                $this->set($key,$value);
            }
            else {
                $this->setArrayData($value, $key);
            }
        }
    }
    
    /**
     * Check if an array is monodimensional or not
     * 
     * @param array $array
     * @return boolean
     */
    protected function isMonoDim(array $array)
    {
        if (count($array) != count($array,1)) return false;
        return true;
    }
}