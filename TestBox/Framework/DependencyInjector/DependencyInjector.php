<?php
namespace TestBox\Framework\DependencyInjector;

class DependencyInjector
{
    /**
     * Instance to be injected
     * 
     * @var mixed
     */
    protected $instance;
    
    /**
     * Return instance
     * 
     * @return \TestBox\Framework\DependencyInjector\mixed
     */
    public function getInstance()
    {
        return $this->instance;
    }
    
    /**
     * Configure instance
     * 
     * @param InstanceDefinition $definition
     */
    public function configure(InstanceDefinition $definition)
    {
        $className = $definition->getClassName();   
        $this->instance = new $className();
        foreach ($definition->getPropertyValues() as $property => $value) {
            $setter = 'set' . ucfirst($property);
            if (is_a($value, 'TestBox\Framework\DependencyInjector\InstanceDefinition')) {
                $di = new self();
                $di->configure($value);
                $value = $di->getInstance();
            }
            $this->instance->$setter($value);
        }
        return $this;
    }
}