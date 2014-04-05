<?php
namespace TestBox\Framework\EventManager;

use TestBox\Framework\EventManager\EventManagerInterface;
use TestBox\Framework\EventManager\PropagationResultInterface;

interface EventTriggerInterface
{
	/**
	 * Trigger an event
	 * 
	 * Depends on arguments
	 * @return PropagationResultInterface
	 */
	public function trigger();
	
	/**
	 * Retrigger last event with a differents identifier
	 * 
	 * @param string $newIdentifier
	 */
	public function retrigger($newIdentifier);
	
	/**
	 * Set an event Manager
	 * @param EventManagerInterface $eventManager
	 */
	public function setEventManager(EventManagerInterface $eventManager);
	
}