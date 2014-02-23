<?php
namespace TestBox\Scenario;

use TestBox\Box\BoxInterface;
use TestBox\Test\TestEvent;
use TestBox\Assertion\AssertionManager;

abstract class ScenarioAbstract implements ScenarioInterface
{
    /**
     * Box
     * 
     * @var BoxInterface
     */
    protected $box;
    
    /**
     * Test event
     * 
     * @var TestEvent
     */
    protected $event;
    
    /**
     * Assertion manager
     * 
     * @var AssertionManager
     */
    protected $assertionManager;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\ScenarioInterface::setBox()
     */
    public function setBox(BoxInterface $box)
    {
        $this->box = $box;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\ScenarioInterface::execute()
     */
    public function execute($command, $argNames = array())
    {
        return $this->box->execute($command, $argNames);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\ScenarioInterface::run()
     */
    abstract public function run();
    
	/**
     * @return the $event
     */
    public function getEvent()
    {
        return $this->event;
    }

	/**
     * @param \TestBox\Test\TestEvent $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }
    
	/**
     * @param \TestBox\Assertion\AssertionManager $assertionManager
     */
    public function setAssertionManager($assertionManager)
    {
        $this->assertionManager = $assertionManager;
    }

    /**
     * Method alias manager 
     * 
     * @param string $name
     * @param array $args
     */
    public function __call($name, $args)
    {
        if (substr($name,0,6) == 'assert')
            return $this->doAssertion($name, $args);
    }
    
    /**
     * Manage assertion
     */
    protected function doAssertion($assertionName, $args)
    {
        $assertion = $this->assertionManager->getAssertion($assertionName);
        return $assertion->check($args);
    }

}