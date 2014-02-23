<?php
namespace TestBox\Assertion;

use TestBox\Framework\ServiceLocator\ServiceLocatorAbstract;

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
}