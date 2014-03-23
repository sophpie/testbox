<?php
namespace TestBox\Test;

use TestBox\Environment\EnvironmentInterface;
use TestBox\Box\BoxInterface;
use TestBox\Scenario\ScenarioInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
use TestBox\Result\Result;

abstract class TestAbstract implements TestInterface
{
    use \TestBox\Framework\EventManager\Trigger\EventTriggerTrait;
    
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
	 * Set and configure scenario
	 * 
     * @param string $scenario
     */
    public function setScenario(ScenarioInterface $scenario)
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
     * (non-PHPdoc)
     * @see \TestBox\Test\TestAbstract::run()
     */
    public function run()
    {
        $this->scenario->setServiceLocator($this->workbench);
        $testEvent = new TestEvent(TestEvent::EVENT_TEST);
        $testEvent->setTest($this);
        $this->trigger($testEvent);
        $this->retrigger(TestEvent::EVENT_VALIDATION);
        $this->retrigger(TestEvent::EVENT_REPORT);
    }
    
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Test\TestInterface::setEnvironment()
	 */
    public function setEnvironment(EnvironmentInterface $environment)
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
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorAware::setServiceLocator()
     */
    public function setServiceLocator(ServiceLocatorInterface $workbench)
    {
        $this->workbench = $workbench;
    }
    
	/**
     * @return the $environment
     */
    public function getEnvironment()
    {
        return $this->environment;
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


}