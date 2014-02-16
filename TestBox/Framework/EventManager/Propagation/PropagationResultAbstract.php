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
	public function addListenerResult(EventInterface $event,$listener)
	{
		if (is_callable($listener)) $value =  call_user_func($listener,$event);
		else {
			//@todo : what to do ?
			return ;
		}
		$this->resultStack[] = $value;
		if (call_user_func($event->getPropagationCallback(),$value)) $this->isPropagationStopped =true;
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