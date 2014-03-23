<?php
namespace TestBox\Report\Console;

use TestBox\Report\ReportAbstract;

class ConsoleReport extends ReportAbstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setReportItemPrototype(new ConsoleReportItem());
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Report\ReportAbstract::render()
     */
    public function render()
    {
        var_export($this->eventStack);
    }
}