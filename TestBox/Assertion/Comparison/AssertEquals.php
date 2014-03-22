<?php
namespace TestBox\Assertion\Comparison;

use TestBox\Assertion\AssertionAbstract;

class AssertEquals extends AssertionAbstract
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Assertion\AssertionAbstract::getArgsNumber()
     */
    protected function getArgsNumber()
    {
        return 2;
    }
    
    /**
     * Check if given values are equal
     *
     * @param mixed $test
     * @return boolean
     */
    public function validate($args)
    {
        $a = $args[0];
        $b = $args[1];
        if (gettype($a) != gettype($b)) return false;
        if ($a !== $b) return false;
        return true;
    }
}