<?php
namespace TestBox\Assertion\Boolean;

use TestBox\Assertion\AssertionAbstract;

class AssertTrue extends AssertionAbstract
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Assertion\AssertionAbstract::getArgsNumber()
     */
    protected function getArgsNumber()
    {
        return 1;
    }
    
    /**
     * Check if parameter is true
     * 
     * Argument has to be a boolean
     * @param mixed $test
     * @return boolean
     */
    public function validate($args)
    {
        if (gettype($args[0]) != 'boolean') return false;
        return $args[0];
    }
}