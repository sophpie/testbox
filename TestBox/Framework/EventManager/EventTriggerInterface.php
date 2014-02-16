<?php
namespace TestBox\Framework\EventManager;

use TestBox\Framework\EventManager\Event\EventInterface;
use TestBox\Framework\EventManager\EventManagerInterface;
use TestBox\Framework\EventManager\PropagationResultInterface;

interface EventTriggerInterface
{
	/**
	 * Trigger an event
	 * 
	 * @return PropagationResultInterface
	 */
	public function trigger(EventInterface $event);
	
	/**
	 * Set an event Manager
	 * @param EventManagerInterface $eventManager
	 */
	public function setEventManager(EventManagerInterface $eventManager);
	
}