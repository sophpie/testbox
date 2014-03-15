<?php
namespace TestBox\Framework\EventManager\Propagation;

use TestBox\Framework\EventManager\Event\EventInterface;

interface PropagationResultInterface
{
	/**
	 * Add a result to the result stack
	 * 
	 * @param EventInterface $event
	 * @param mixed $listener
	 * @param callable $callback
	 */
	public function addListenerResult(EventInterface $event,$listener,callable $callback);
	
	/**
	 * Check if the propagtion is stopped.
	 * 
	 * @return bool
	 */
	public function isPropagationStopped();
}