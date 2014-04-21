<?php
namespace TestBox\Report\Console;

use TestBox\Report\ReportItemAbstract;
use TestBox\Test\TestEvent;

class ConsoleReportItem extends ReportItemAbstract
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Report\ReportItemAbstract::extractData()
     */
    public function extractData(TestEvent $testEvent)
    {
        $test = $testEvent->getTest();
        $this->isValid = $test->getIsValid();
        $this->setParam('assertionResults', $testEvent->getAssertionresults());
    }
}