<?php
namespace TestBox\Test;

use TestBox\Framework\ServiceLocator\ServiceLocatorAware;
use TestBox\Framework\EventManager\EventTriggerInterface;
use TestBox\Box\BoxInterface;

interface TestInterface extends EventTriggerInterface,ServiceLocatorAware
{
    /**
     * Set box
     * 
     * @param BoxInterface $box
     */
	public function setBox(BoxInterface $box);
	
	/**
	 * Set scenario callabe
	 * 
	 * @param Callable $scenario
	 */
	public function setScenario(Callable $scenario);
}