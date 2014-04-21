<?php
/**
 * Test template to operate PHPUnit-like test
 * 
 * @author sophie BEAUPUIS
 *
 */
namespace TestBox\Test\Template;

use TestBox\Test\Test;

abstract class UnitTestTemplate extends Test
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Test\TestAbstract::init()
     */
    protected function init()
    {
        $this->setScenario(array($this,'runUnitTest'));
    }

    /**
     * Run unit test
     */
    public function runUnitTest()
    {
        if ( ! $this->hasTests()) return;
        if (method_exists($this, 'setUpBeforeClass')) self::setUpBeforeClass();
        foreach (get_class_methods($this) as $methodName){
            if (preg_match('@^test@', $methodName) != 1) continue;
            if (method_exists($this, 'setUp')) $this->setUp();
            $this->$methodName();
            if (method_exists($this, 'tearDown')) $this->tearDown();
        }
        if (method_exists($this, 'tearDownAfterClass')) self::tearDownAfterClass();
    }
    
    /**
     * Cheik if test class has tests
     * 
     * @return boolean
     */
    protected function hasTests()
    {
        foreach (get_class_methods($this) as $methodName){
            if (preg_match('@^test@', $methodName) != 1) continue;
            return true;
        }
        return false;
    }
}