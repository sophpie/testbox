<?php
namespace TestBox\Test;

use TestBox\Framework\EventManager\EventManager;
use TestBox\Test\TestEvent;

class Test extends TestAbstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventManager = new EventManager();
        $this->eventManager->attach(TestEvent::EVENT_TEST, array($this,'executeScenario'));
        $this->eventManager->attach(TestEvent::EVENT_VALIDATION, array($this,'doValidation'));
        $this->eventManager->attach(TestEvent::EVENT_REPORT, array($this,'doReport'));
    }
    
    /**
     * Execute given scenario
     */
    public function executeScenario(TestEvent $event)
    {
        $this->scenario->setBox($this->box);
        $this->scenario->setEvent($event);
        $this->scenario->run();
    }
    
    /**
     * Check test validation
     * 
     * look into assertion results
     * @param TestEvent $event
     */
    public function doValidation(TestEvent $event)
    {
        foreach ($event->getAssertionResults() as $assertionResult){
            if ( ! $assertionResult->getIsVAlid()) {
                $this->isValid = false;
                return;
            }
        }
        $this->isValid = true;
    }
    
    /**
     * Executing reporting
     * @param TestEvent $event
     */
    public function doReport(TestEvent $event)
    {
        $report = $this->workbench->getReport();
        $report->addEvent($event);
    }
}