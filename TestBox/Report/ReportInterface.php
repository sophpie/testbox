<?php
namespace TestBox\Report;

use TestBox\Test\TestEvent;

interface ReportInterface
{
    /**
     * Add Test event to report stack
     * 
     * @param TestEvent $event
     */
	public function addEvent(TestEvent $event);
	
	/**
	 * Render report
	 * 
	 * @return string
	 */
	public function render();
	
}