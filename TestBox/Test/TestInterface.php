<?php
namespace TestBox\Test;

use TestBox\Framework\ServiceLocator\ServiceLocatorAware;
use TestBox\Framework\EventManager\EventTriggerInterface;
use TestBox\Box\BoxInterface;
use TestBox\Scenario\ScenarioInterface;
use TestBox\Environment\EnvironmentInterface;

interface TestInterface extends EventTriggerInterface,ServiceLocatorAware
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
	 * Set environement
	 * 
	 * @param EnvironmentInterface $environment
	 */
	public function setEnvironment(EnvironmentInterface $environment);
}