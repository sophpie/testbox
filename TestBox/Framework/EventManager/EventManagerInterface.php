<?php
namespace TestBox\Framework\EventManager;

use TestBox\Framework\EventManager\Event\EventInterface;
use TestBox\Framework\EventManager\Propagation\PropagationResultInterface;

interface EventManagerInterface
{
	/**
	 * Attach an listener to an event
	 * 
	 * @param string $event
	 * @param callable | string $listener
	 * @param int $priority
	 */
	public function attach($eventIdentifier,  $listener, $priority = 0);
	
	/**
	 * Detach listener from an event
	 * 
	 * @param string $eventIdentifier
	 * @param callable | string 
	 */
	public function detach($eventIdentifier, $listener);
	
	/**
	 * Execute propagation of the given event
	 * 
	 * @param EventInterface $event
	 * 
	 * @return PropagationResultInterface;
	 */
	public function doPropagation(EventInterface $event);
	
}