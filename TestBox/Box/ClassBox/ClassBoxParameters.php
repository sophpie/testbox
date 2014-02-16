<?php
namespace TestBox\Box\ClassBox;

use TestBox\Framework\Parameters\Parameters;

class ClassBoxParameters extends Parameters
{
    /**
     * Set parameters used to instanciate class
     * 
     * @param string $name
     * @param mixed $value
     */
    public function setConstructorParam($name,$value)
    {
        $this->setParam('constructor::' . $name, $value);
    }
    
    public function getConstructorParam($name)
    {
        $name = 'constructor::' . $name;
        return $this->getParam($name);
    }
}