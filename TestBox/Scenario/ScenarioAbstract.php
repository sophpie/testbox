<?php
namespace TestBox\Scenario;

use TestBox\Box\BoxInterface;
use TestBox\Test\TestEvent;
use TestBox\Workbench\WorkbenchAbstract;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

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
     * Workbench
     * 
     * @var WorkbenchAbstract
     */
    protected $workbench;
    
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
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorAware::setServiceLocator()
     */
    public function setServiceLocator(ServiceLocatorInterface $workbench)
    {
        $this->workbench = $workbench;
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
        $assertion = $this->getAssertionManager()->getAssertion($assertionName);
        $assertionResult = $assertion->check($args);
        $this->event->addAssertionresult($assertionResult);
    }
    
    /**
     * get assertion manager
     */
    protected function getAssertionManager()
    {
        return $this->workbench->get('assertionManager');
    }
    
    /**
     * Get param from data injector
     * 
     * @param string $dataInjector
     * @param string $key
     */
    public function param($dataInjector, $key)
    {
        $dataInjector = $this->workbench->getDataInjector($dataInjector);
        $param = $dataInjector->getParam($key);
        return $param;
    }

}