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
     * Report item prototype
     * 
     * @var ReportItemInterface
     */
    protected $reportItemPrototype;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Report\ReportInterface::addEvent()
     */
    public function addEvent(TestEvent $testEvent)
    {
        $item = clone $this->reportItemPrototype;
        $item->extractData($testEvent);
        array_push($this->eventStack, $item);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Report\ReportInterface::render()
     */
    abstract public function render();
    
	/**
     * @param \TestBox\Report\ReportItemInterface $reportItemPrototype
     */
    public function setReportItemPrototype($reportItemPrototype)
    {
        $this->reportItemPrototype = $reportItemPrototype;
    }

    
}