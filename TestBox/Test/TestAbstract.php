<?php
namespace TestBox\Test;

use TestBox\Environment\EnvironmentInterface;
use TestBox\Box\BoxInterface;
use TestBox\Framework\EventManager\EventManagerInterface;
use TestBox\Framework\EventManager\Event\EventInterface;
use TestBox\Framework\EventManager\EventManager;
use TestBox\Scenario\ScenarioInterface;
use TestBox\Assertion\AssertionManager;

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
	 * Assertion manager
	 * 
	 * @var AssertionManager
	 */
	protected $assertionManager;
	
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
	 * Set and configure scenario
	 * 
     * @param string $scenario
     */
    public function setScenario(ScenarioInterface $scenario)
    {
        $this->scenario = $scenario;
        $this->scenario->setBox($this->box);
        $this->scenario->setEvent($this->event);
        $this->scenario->setAssertionManager($this->assertionManager);
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
    
	/**
     * @param \TestBox\Assertion\AssertionManager $assertionManager
     */
    public function setAssertionManager(AssertionManager $assertionManager)
    {
        $this->assertionManager = $assertionManager;
    }


}