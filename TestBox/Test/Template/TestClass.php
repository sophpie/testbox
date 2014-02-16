<?php
/**
 * Test class dedicated for testing PHP class
 * 
 */
namespace TestBox\Test\Template;

use TestBox\Test\TestAbstract;
use TestBox\Box\ClassBox\ClassBox;

class TestClass extends TestAbstract
{
    /**
     * Constructor
     * 
     * @param string $className
     */
    public function __construct($className)
    {
        $this->box = new ClassBox($className);
    }
}