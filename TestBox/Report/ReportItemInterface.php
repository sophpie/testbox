<?php
namespace TestBox\Report;

use TestBox\Test\TestEvent;
use TestBox\Framework\Parameters\ParametersInterface;

interface ReportItemInterface extends ParametersInterface
{
    /**
     * Extract data from Test Event
     * 
     * @param TestEvent $testEvent
     */
    public function extractData(TestEvent $testEvent);
}