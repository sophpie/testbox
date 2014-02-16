<?php
namespace TestBox\Test;

use TestBox\Environment\EnvironmentInterface;
use TestBox\Report\ReportInterface;
use TestBox\Box\BoxInterface;
use TestBox\Result\ResultInterface;
use TestBox\Framework\EventManager\EventManagerInterface;
use TestBox\Framework\EventManager\Event\EventInterface;
use TestBox\Framework\EventManager\EventManager;
use TestBox\Framework\EventManager\Propagation\PropagationResult;
use TestBox\Scenario\ScenarioInterface;

abstract class TestAbstract implements TestInterface
{
	/**
	 * Environment
	 * 
	 * @var EnvironmentInterface
	 */
	protected $environment;
	
	/**
	 * Box
	 * 
	 * @var BoxInterface
	 */
	protected $box;

	/**
	 * Scenario to run
	 * 
	 * @var ScenarioInterface
	 */
	protected $scenario;
	
	/**
	 * Test event
	 * 
	 * This event collects what is return by test
	 * @var TestEvent
	 */
	protected $event;
	
	/**
	 * Event Manager
	 * 
	 * @var EventManagerInterface
	 */
	protected $eventManager;
	
	/**
	 * Service locator
	 * 
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
	    $this->eventManager = new EventManager();
	    $this->event = new TestEvent(TestEvent::EVENT_TEST);
	    $this->eventManager->attach($this->event, array($this,'executeScenario'));
	}
	
	/**
     * @param string $scenario
     */
    public function setScenario(ScenarioInterface $scenario)
    {
        $this->scenario = $scenario;
        $this->scenario->setBox($this->box);
    }

	/**
     * @param \TestBox\Box\BoxInterface $box
     */
    public function setBox(BoxInterface $box)
    {
        $this->box = $box;
    }

	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\EventTriggerInterface::setEventManager()
	 */
	public function setEventManager(EventManagerInterface $eventManager)
	{
	    $this->eventManager = $eventManager;
	}
	
	/**
	 * Trigger events to drive test
	 */
	public function run()
	{
	    $this->trigger(new TestEvent(TestEvent::EVENT_PRE_TEST));
	    $this->trigger(new TestEvent(TestEvent::EVENT_TEST));
	    $this->trigger(new TestEvent(TestEvent::EVENT_POST_TEST));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\EventTriggerInterface::trigger()
	 */
	public function trigger(EventInterface $event)
	{
	    return $this->eventManager->doPropagation($event);
	}
	
	/**
	 * Execute given scenario
	 */
	public function executeScenario()
	{
	    $this->scenario->setBox($this->box);
	    $this->scenario->run();
	}
	
	/**
     * @param \TestBox\Environment\EnvironmentInterface $environment
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Test\TestInterface::setParameters()
     */
    public function setParameters($array = array())
    {
        foreach ($array as $name => $value){
            $this->setParameter($name, $value);
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Test\TestInterface::setParameter()
     */
    public function setParameter($name, $value)
    {
        $this->box->setParameter($name, $value);
    }

}