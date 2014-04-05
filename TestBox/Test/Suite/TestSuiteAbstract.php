<?php
namespace TestBox\Test\Suite;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
use TestBox\Workbench\WorkbenchAbstract;
use TestBox\Framework\ServiceLocator\ServiceLocatorAware;
use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Framework\EventManager\EventTriggerInterface;
use TestBox\Framework\DependencyInjector\CallableInjector;

abstract class TestSuiteAbstract implements TestSuiteInterface, ServiceLocatorAware, ConfigurableInterface, EventTriggerInterface
{
    use \TestBox\Framework\EventManager\Trigger\EventTriggerTrait;
    
    /**
     * Workbench
     * 
     * @var WorkbenchAbstract
     */
    protected $workbench;
    
    /**
     * List of event identifier to trigger
     * 
     * @var array
     */
    protected $actionSlots = array();
    
    /**
     * Test suite event
     * 
     * @var TestSuiteEvent
     */
    protected $event;
    
    /**
     * Add action to suite
     * 
     * @param string $nameunknown
     * @param boolean $prepend
     */
    public function addActionSlot($name, $prepend = false)
    {
        if ( ! $prepend) array_push($this->actionSlots, $name);
        array_unshift($this->actionSlots, $name);
    }
    
    /**
     * Add action to suite
     * 
     * @param string $slotName
     * @param ActionInterface $action
     * @param number $priority
     */
    public function addAction($slotName,callable $callBack,$priority = 1)
    {
        $this->eventManager->attach($slotName, $callBack, $priority);
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
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     */
    public function configure(Array $options)
    {
        foreach ($options as $slotName => $actions)
        {
            $this->addActionSlot($slotName);
            foreach ($actions as $action)
            {
                $priority =1;
                if (isset($action['priority'])) $priority = $action['priority'];
                $this->addAction($slotName, $action['callable'],$priority);
            }
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Test\Suite\TestSuiteInterface::run()
     */
    public function run()
    {
        $this->event = new TestSuiteEvent();
        $this->event->setTestSuite($this);
        foreach ($this->actionSlots as $slotName){
            $this->event->setIdentifier($slotName);
            $result = $this->triggerEvent($this->event);
            $this->event = clone $result->getEvent();
        }
    }
}