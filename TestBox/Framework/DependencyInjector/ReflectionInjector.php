<?php
namespace TestBox\Framework\DependencyInjector;

use TestBox\Framework\Core\ConfigurableInterface;

class ReflectionInjector implements InjectorInterface, ConfigurableInterface
{
    /**
     * Rfelcted class of instance
     * 
     * @var \ReflectionClass
     */
    protected $reflectedClass;
    
    /**
     * Instance
     * 
     * @var mixed
     */
    protected $instance;
    
    /**
     * Constructor 
     * 
     * @param array $options : Injection parameters
     */
    public function __construct($options = null)
    {
        if ($options) $this->configure($options);
    }    
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\DependencyInjector\InjectorInterface::getInstance()
     */
    public function getInstance()
    {
        return $this->instance;
    }
    
    /**
     * Set property value
     * 
     * @param string $property
     * @param mixed $value
     */
    public function setProperty($property,$value)
    {
        $reflectedProperty = $this->reflectedClass->getProperty($property);
        $reflectedProperty->setAccessible(true);
        $reflectedProperty->setValue($this->instance, $value);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     */
    public function configure($options)
    {
        $className = $options['class'];
        $constParams = array();
        if (isset($options['constructorParameters']))
            $constParams = $options['constructorParameters'];
        $this->reflectedClass = new \ReflectionClass($className);
        $this->instance = $this->reflectedClass->newInstanceArgs($constParams);
        if ( ! isset($options['properties'])) return ;
        foreach ($options['properties'] as $name => $value){
            if ( ! is_array($value) || ! isset($value['class']))
                $this->setProperty($name, $value);
            elseif (isset($value['class'])){
                $injector = new self($value);
                $this->setProperty($name, $injector->getInstance());
            }
        }
    }
}