<?php
namespace TestBox\Framework\DependencyInjector;

use TestBox\Framework\Configuration\ConfigurationInterface;
use TextBox\Framework\DependencyInjector\InjectorAbstract;

class StandardInjector extends InjectorAbstract
{
    /**
     * Constructor 
     * 
     * @param array $options : Injection parameters
     */
    public function __construct(ConfigurationInterface $options = null)
    {
        $this->setConfig($options);
    }    
    
    /**
     * Set property value
     * 
     * @param string $property
     * @param mixed $value
     */
    protected function setProperty($property,$value)
    {
        $setterMethod = 'set' . ucfirst($property);
        if ( ! method_exists($this->instance, $setterMethod)) return;
        $this->instance->$setterMethod($value);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     * 
     * Configuration :
     * class:       name of the class to instanciate
     * properties:  key / value pair to set properties
     */
    public function configure(ConfigurationInterface $options)
    {
        $className = $options->class;
        $this->instance = new $className();
        if ( ! isset($options->properties)) return ;
        foreach ($options->properties as $name => $value){
            if ($value instanceof ConfigurationInterface){
                $injector = new self($value);
                $this->setProperty($name, $injector->getInstance());
            }
            else {
                $this->setProperty($name, $value);
            }
        }
    }
}