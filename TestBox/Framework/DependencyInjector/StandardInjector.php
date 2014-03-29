<?php
namespace TestBox\Framework\DependencyInjector;

use TestBox\Framework\Core\ConfigurableInterface;

class StandardInjector implements InjectorInterface, ConfigurableInterface
{
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
        $setterMethod = 'set' . ucfirst($property);
        if ( ! method_exists($this->instance, $setterMethod)) return;
        $this->instance->$setterMethod($value);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     */
    public function configure(Array $options)
    {
        $className = $options['class'];
        $this->instance = new $className();
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