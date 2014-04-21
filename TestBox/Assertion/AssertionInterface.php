<?php
namespace TestBox\Assertion;

interface AssertionInterface
{
    /**
     * Check assertion
     * 
     * Will return true if assertion is true.
     * Should populate a TestEvent
     * @param array $args
     * @return boolean
     */
    public function validate($args);
}