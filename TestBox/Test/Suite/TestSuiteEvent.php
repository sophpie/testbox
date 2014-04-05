<?php
namespace TestBox\Test\Suite;

use TestBox\Framework\EventManager\Event\EventAbstract;

class TestSuiteEvent extends EventAbstract
{
    /**
     * Test suite that fathered event
     * 
     * @var TestSuiteAbstract
     */
    protected $testSuite;
    
	/**
     * @return the $testSuite
     */
    public function getTestSuite()
    {
        return $this->testSuite;
    }

	/**
     * @param \TestBox\Test\Suite\TestSuiteAbstract $testSuite
     */
    public function setTestSuite($testSuite)
    {
        $this->testSuite = $testSuite;
    }

    
    
    
}