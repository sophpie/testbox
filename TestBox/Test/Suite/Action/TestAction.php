<?php
namespace TestBox\Test\Suite\Action;

use TestBox\Test\Suite\TestSuiteEvent;

class TestAction implements ActionInterface
{
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Test\Suite\Action\ActionInterface::run()
     */
    public function run(TestSuiteEvent $event)
    {
        $testSuite = $event->getTestSuite();
        
    }
}