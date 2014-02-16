<?php
namespace TestBox\Test;

use TestBox\Framework\ServiceLocator\ServiceLocatorAware;
use TestBox\Framework\EventManager\EventTriggerInterface;
use TestBox\Box\BoxInterface;
use TestBox\Scenario\ScenarioInterface;

interface TestInterface extends EventTriggerInterface
{
    /**
     * Set box
     * 
     * @param BoxInterface $box
     */
	public function setBox(BoxInterface $box);
	
	/**
	 * Set scenario script
	 * 
	 * @param string $scenarioFile
	 */
	public function setScenario(ScenarioInterface $scenarioFile);
	
	/**
	 * Set Box parameters
	 * 
	 * @param array $array
	 */
	public function setParameters($array = array());
	
	/**
	 * Set a box parameter value
	 * 
	 * @param string $name
	 * @param mixed $value
	 */
	public function setParameter($name, $value);
	
}