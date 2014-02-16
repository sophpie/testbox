<?php
namespace TestBox\Framework\Parameters;

interface ParametersInterface
{
    /**
     * List namesapce parameters
     * 
     * @param string $namespace
     * @return array
     */
    public function getNamespaceParams($namespace);
    
    /**
     * Return parameter value
     * 
     * You can use namespace ns::key
     * @param string $name
     */
    public function getParam($name);
    
    /**
     * Set parameter value
     * 
     * You can use namspace : ns:key => value
     * @param string $name
     * @param mixed $value
     */
    public function setParam($name, $value);
    
    /**
     * Set parameters values
     * 
     * You can use namspace : ns:key => value
     * @param array $array
     */
    public function setParams($array);
    
}