<?php
namespace TestBox\Framework\DependencyInjector;

use TestBox\Framework\DependencyInjector\InjectorFactory;

class CallableInjector 
{
    /**
     * Dependency injector class to use
     * 
     * @var string
     */
    protected $injectorClassName;
    
    /**
     * Class to instanciate
     * 
     * @var string
     */
    protected $className;
    
    /**
     * Method name
     * 
     * @var string
     */
    protected $methodName;
    
    /**
     * Injector arguments
     * 
     * @var array
     */
    protected $args;
    
    /**
     * Constructor
     * 
     * @param string $className
     * @param string $injectorClassName
     * @param array $args
     */
    public function __construct($className,$methodName,$args = null,$injectorClassName = 'StandardInjector')
    {
        $this->injectorClassName = $injectorClassName;
        $this->methodName = $methodName;
        $this->className = $className;
        $this->args = $args;
    }
    
    /**
     * Invocagle method
     * 
     * @param unknown $data
     */
    public function __invoke($data)
    {
        $di = InjectorFactory::create($this->injectorClassName);
        $config = array();
        $config['className'] = $this->className;
        if (is_array($this->args)){
            $config['options'] = $this->args;
        }
        $di->configure($config);
        $object = $di->getInstance();
        return $object->$method($data);
    }
}