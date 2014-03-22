<?php
namespace TestBox\Test;

use TestBox\Framework\EventManager\Event\Event;
use TestBox\Assertion\AssertionResult;

class TestEvent extends Event
{
    const EVENT_TEST = 'testEvent::test';
    const EVENT_VALIDATION = 'testEvent::validation';
    const EVENT_REPORT = 'testEvent::report';
    
    /**
     * Assertion results stack
     * 
     * @var array
     */
    protected $assertionResults = array();
    
    /**
     * Test 
     * 
     * @var TestInterface
     */
    protected $test;
    
    /**
     * Add an assertion result to the stack
     * 
     * @param AssertionResult $assertionResult
     */
    public function addAssertionresult(AssertionResult $assertionResult)
    {
        array_push($this->assertionResults,$assertionResult);
    }
    
	/**
     * @return the $test
     */
    public function getTest()
    {
        return $this->test;
    }

	/**
     * @param \TestBox\Test\TestInterface $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }
    
	/**
     * @return the $assertionResults
     */
    public function getAssertionResults()
    {
        return $this->assertionResults;
    }


}