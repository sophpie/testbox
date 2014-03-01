<?php
namespace TestBox\Framework\DependencyInjector;

class InstanceDefinition
{
    /**
     * Class name
     * 
     * @var string
     */
    protected $className;
    
    /**
     * Values of class properties
     * 
     * @var array
     */
    protected $propertyValues = array();
    
    /**
     * Constructor parameter
     * @var unknown
     */
    protected $constructorParams = array();
    
    /**
     * Constructor
     * 
     * @param string $className
     * @param array $propertyValues
     */
    public function __construct($className, $propertyValues = array())
    {
        $this->className = $className;
        $this->propertyValues = $propertyValues;
    }
    
	/**
     * @return the $className
     */
    public function getClassName()
    {
        return $this->className;
    }

	/**
     * return aray
     */
    public function getPropertyValues()
    {
        return $this->propertyValues;
    }

}