<?php
namespace TestBox\Framework\DependencyInjector;

use TestBox\Framework\Configuration\ConfigurationInterface;
use TextBox\Framework\DependencyInjector\InjectorAbstract;

class ReflectionInjector extends InjectorAbstract
{
    /**
     * Rfelcted class of instance
     * 
     * @var \ReflectionClass
     */
    protected $reflectedClass;
    
    /**
     * Constructor 
     * 
     * @param array $options : Injection parameters
     */
    public function __construct(ConfigurationInterface $options = null)
    {
        if ($options) $this->setConfig($options);
    }    
    
    /**
     * Set property value
     * 
     * @param string $property
     * @param mixed $value
     */
    protected function setProperty($property,$value)
    {
        $reflectedProperty = $this->reflectedClass->getProperty($property);
        $reflectedProperty->setAccessible(true);
        $reflectedProperty->setValue($this->instance, $value);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     * 
     * Configuration :
     * class:                   name of the class to instanciate
     * properties:              key / value pair to set properties
     * constructorParameters:   array of constructor parameters
     */
    public function configure(ConfigurationInterface $options)
    {
        $className = $options->class;
        $constParams = array();
        if (isset($options->constructorParameters))
            $constParams = $options->constructorParameters;
        $this->reflectedClass = new \ReflectionClass($className);
        $this->instance = $this->reflectedClass->newInstanceArgs($constParams);
        if ( ! isset($options->properties)) return ;
        foreach ($options->properties as $name => $value){
            if ($value instanceof ConfigurationInterface) {
                $injector = new self($value);
                $this->setProperty($name, $injector->getInstance());
            }
            else{
                $this->setProperty($name, $value);
            }
        }
    }
}