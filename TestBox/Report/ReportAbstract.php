<?php
namespace TestBox\Report;

use TestBox\Test\TestEvent;

abstract class ReportAbstract implements ReportInterface
{
    /**
     * Collection of Test Event
     * 
     * @var array
     */
    protected $eventStack = array();
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Report\ReportInterface::addEvent()
     */
    public function addEvent(TestEvent $testEvent)
    {
        array_push($this->eventStack, $testEvent);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Report\ReportInterface::render()
     */
    abstract public function render();
    
}