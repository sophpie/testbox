<?php
namespace TestBox\Framework\EventManager\Propagation;

use TestBox\Framework\EventManager\Event\EventInterface;

abstract class PropagationResultAbstract implements PropagationResultInterface
{
	/**
	 * Listener result collection
	 * 
	 * @var array
	 */
	protected $resultStack = array();
	
	/**
	 * Check if the propagation is stopped
	 * 
	 * @var bool
	 */
	protected $isPropagationStopped = false;
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\Propagation\PropagationResultInterface::addListenerResult()
	 */
	public function addListenerResult(EventInterface $event,$listener, callable $callback = null)
	{
		$value =  call_user_func($listener,$event);
		$this->resultStack[] = $value;
		if ($callback) {
		  if (call_user_func($callback,$value)) $this->isPropagationStopped =true;
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\Propagation\PropagationResultInterface::isPropagationStopped()
	 */
	public function isPropagationStopped()
	{
		return $this->isPropagationStopped;
	}
}