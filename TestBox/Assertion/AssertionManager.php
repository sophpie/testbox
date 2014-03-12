<?php
namespace TestBox\Assertion;

use TestBox\Framework\ServiceLocator\ServiceLocatorAbstract;
use TestBox\Framework\Configuration\Configuration;

class AssertionManager extends ServiceLocatorAbstract
{
    /**
     * Return the asked assertion class
     * 
     * @param string $name
     */
    public function getAssertion($name)
    {
        return $this->get($name);
    }
    
    /**
     * Constructor
     * 
     * @param Configuration $options
     */
    public function __construct(Array $options = null)
    {
        if ($options) $this->configure($options);
    }
}