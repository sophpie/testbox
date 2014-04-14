<?php
namespace TestBox\Test;

use TestBox\Framework\EventManager\EventManager;
use TestBox\Test\TestEvent;
use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Framework\Configuration\ConfigurationInterface;

class Test extends TestAbstract implements ConfigurableInterface
{
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     * 
     * Configure:
     * box:         box class
     *                  diClass :  Dependency injector class
     *                  options :   DI options
     * scenario :   scenario class
     */
    public function configure(ConfigurationInterface $config)
    {
        $box = $this->workbench->getDiContainer()
            ->getInstance('box',$config->box,false);
        $this->setBox($box);
        $this->setScenario(new $config->scenario);
    }
    
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