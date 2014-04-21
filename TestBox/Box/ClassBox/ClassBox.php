<?php
namespace TestBox\Box\ClassBox;

use TestBox\Box\BoxAbstract;
use TestBox\Box\ClassBox\ClassBoxParameters;

class ClassBox extends BoxAbstract
{
    /**
     * Instance of the tested class
     * 
     * @var mixed
     */
    protected $sample;
    
    /**
     * Reflection instance of tested class
     * 
     * @var \ReflectionClass
     */
    protected $reflection;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parameters = new ClassBoxParameters();
    }
    
    /**
     * Set class name
     * 
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->reflection = new \ReflectionClass($className);
        $this->instantiateSample();
    }
    
    /**
     * Instantiate sample instance
     */
    protected function instantiateSample()
    {
        $constructor = $this->reflection->getConstructor();
        if ( ! $constructor){
            $this->sample = $this->reflection->newInstance();
            return;
        }
        $args = array();
        foreach ($constructor->getParameters() as $param){
            $name = $param->getName();
            $args[] = $this->parameters->getConstructorParam($name);
        }
        $this->sample = $this->reflection->newInstanceArgs($args);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::getStatus()
     */
    public function getStatus()
    {
        $status = array();
        foreach ($this->reflection->getProperties() as $property){
            $status[$property->getName()] = $property->getValue($this->sample);
        }
        return $status;
    }
    
    /**$t
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::setStatus()
     */
    public function setStatus($array)
    {
        foreach ($array as $name => $value){
            try {
                $property = $this->reflection->getProperty($name);
            } catch (\ReflectionException $e){
                continue;
            }
            $property->setValue($this->sample, $value);
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxAbstract::execute()
     */
    public function execute($command, $args = array())
    {
        $method = $this->reflection->getMethod($command);
        $result = $method->invokeArgs($this->sample, $args);
        return $result;
    }
    
	/**
     * @return the $sample
     */
    public function getSample()
    {
        return $this->sample;
    }


}