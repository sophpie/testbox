<?php
namespace TestBox\Report\Format;

use TestBox\Report\ReportAbstract;

class ConsoleReport extends ReportAbstract
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Report\ReportAbstract::render()
     */
    public function render()
    {
        foreach ($this->eventStack as $event){
            if ( ! $event->getTest()->getIsValid()) echo 'X   ';
            else echo 'V   ';
            var_export($event->getAssertionResults());
        }
    }
}