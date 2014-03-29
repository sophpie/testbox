<?php
namespace TestBox\Framework\Parameters;

use TestBox\Framework\Parameters\ParametersInterface;

class Parameters implements ParametersInterface
{
    /**
     * Parameters values
     * 
     * @var array
     */
    protected $stack = array();
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::getParam()
     */
    public function getParam($name)
    {
        if (isset($this->stack[$name])) return $this->stack[$name];
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::setParam()
     */
    public function setParam($name, $value)
    {
        $this->stack[$name] = $value;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::getNamespaceParams()
     */
    public function getNamespaceParams($namespace)
    {
        $return = array();
        foreach ($this->stack as $name => $value){
            $tmp = preg_split('@::@', $name);
            if (count($tmp)<2) continue;
            if ($namespace != $tmp[0]) continue;
            $return[$tmp[1]] = $value;
        }    
        return $return;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::setParams()
     */
    public function setParams($array)
    {
        foreach ($array as $name => $value){
            $this->setParam($name, $value);
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::hasParam()
     */
    public function hasParam($name)
    {
        return array_key_exists($name, $this->stack);
    }
    
    /**
     * Shortcut to get param
     * 
     * @param string $name
     * @return multitype:
     */
    public function __get($name)
    {
        return $this->getParam($name);
    }
}