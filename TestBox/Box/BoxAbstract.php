<?php
namespace TestBox\Box;

use TestBox\Framework\Parameters\ParametersInterface;

abstract class BoxAbstract implements  BoxInterface
{
    /**
     * Parameters
     *
     * @var ParametersInterface
     */
    protected $parameters;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::setStatus()
     */
    abstract public function setStatus($array);
    
    /**
     * 
     */
    abstract public function execute($command, $args = array());
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::setParameter()
     */
    public function setParameter($name, $value)
    {
        $this->parameters->setParam($name, $value);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::setParameters()
     */
    public function setParameters($array)
    {
        $this->parameters->setParams($array);
    }
    
    /**
     * Retunr the parameters to used as command arguments
     * 
     * @param array $argNames
     * @return multitype:\TestBox\Framework\Parameters\ParametersInterface
     */
    protected function getArgumentsValues($argNames = array())
    {
        $argValues = array();
        foreach ($argNames as $name){
            $argValues[] = $this->parameters->getParam($name);
        }
        return $argValues;
    }
}