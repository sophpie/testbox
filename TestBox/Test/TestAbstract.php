<?php
namespace TestBox\Test;

use TestBox\Box\BoxInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

abstract class TestAbstract implements TestInterface
{
    use \TestBox\Framework\EventManager\Trigger\EventTriggerTrait;
	
	/**
	 * Box
	 * 
	 * @var BoxInterface
	 */
	protected $box;

	/**
	 * Scenario to run
	 * 
	 * @var Callable
	 */
	protected $scenario;
	
	/**
	 * Service locator (workbench)
	 * 
	 * @var ServiceLocatorInterface
	 */
	protected $workbench;
	
	/**
	 * Is test valid ?
	 * 
	 * @var boolean
	 */
	protected $isValid = false;
	
	/**
	 * Test event
	 * 
	 * Will collect test info and manage testing operations
	 * @var TestEvent
	 */
	protected $event;
	
	/**
	 * Set and configure scenario
	 * 
     * @param string $scenario
     */
    public function setScenario(Callable $scenario)
    {
        $this->scenario = $scenario;
    }

	/**
     * @param \TestBox\Box\BoxInterface $box
     */
    public function setBox(BoxInterface $box)
    {
        $this->box = $box;
    }
    
    /**
     * Initiate test instance
     */
    protected function init()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Test\TestAbstract::run()
     */
    public function run()
    {
        $this->event = new TestEvent(TestEvent::EVENT_TEST);
        $this->event->setTest($this);
        $this->trigger($this->event);
        $this->retrigger(TestEvent::EVENT_VALIDATION);
        $this->retrigger(TestEvent::EVENT_REPORT);
    }
    
    /**
     * Manage called method
     *
     * Call box plugins from scenarii callable
     *
     * @param string $name
     * @param array $args
     */
    public function __call($name, $args)
    {
        if ($this->box->getPluginManager()->hasService($name)){
            $plugin = $this->box->getPluginManager()->get($name);
            $plugin->setTest($this);
            $plugin($args);
            return $plugin;
        }
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
     * @return the $box
     */
    public function getBox()
    {
        return $this->box;
    }

	/**
     * @return the $scenario
     */
    public function getScenario()
    {
        return $this->scenario;
    }
    
	/**
     * @return the $isValid
     */
    public function getIsValid()
    {
        return $this->isValid;
    }
    
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

}