<?php
namespace TestBox\Framework\EventManager;

use TestBox\Framework\EventManager\Event\EventInterface;
use TestBox\Framework\EventManager\Propagation\PropagationResultInterface;

abstract class EventManagerAbstract implements EventManagerInterface
{
	/**
	 * Listeners queue
	 * 
	 * @var array
	 */
	protected $queue = array();
	
	/**
	 * Current event
	 * 
	 * @var EventInterface
	 */
	protected $currentEvent;
	
	/**
	 * PropagationResult
	 * 
	 * @var PropagationResultInterface
	 */
	protected $propagationResultPrototype;
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\EventManagerInterface::attach()
	 */
	public function attach($eventIdentifier, $listener, $priority = 0)
	{
		if ( ! array_key_exists($eventIdentifier, $this->queue)) $this->queue[$eventIdentifier] = array();
		if ( ! array_key_exists($priority, $this->queue[$eventIdentifier])) $this->queue[$eventIdentifier][$priority] = array();
		$this->queue[$eventIdentifier][$priority][] =  $listener;
		krsort($this->queue[$eventIdentifier]);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\EventManagerInterface::detach()
	 */
	public function detach($eventIdentifier, $listener = null)
	{
		if ( ! $listener) return $this->detachAll($eventIdentifier);
		foreach ($this->queue[$eventIdentifier] as $priority => $listenersList){
			foreach ($listenersList as $callBack) {
				if ($callBack == $listener) unset ($callBack);
			}
		}	
	}
	
	/**
	 * Detach all listeners from an event
	 * 
	 * @param string $eventIdentifier
	 */
	public function detachAll($eventIdentifier)
	{
		unset($this->queue[$eventIdentifier]);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\EventManagerInterface::doPropagation()
	 */
	public function doPropagation(EventInterface $event, callable $callback = null)
	{
		$result = clone $this->propagationResultPrototype;
		$eventIdentifier = $event->getIdentifier();
		if ( ! array_key_exists($eventIdentifier, $this->queue)) return $result;
		foreach ($this->queue[$eventIdentifier] as $listenersList){
			foreach ($listenersList as $listener){
				$result->addListenerResult($event,$listener,$callback);
				if ($result->isPropagationStopped()) break;
			}
		}
		$this->currentEvent = $event;
		return $result;
	}
	/**
     * @param \TestBox\Framework\EventManager\Propagation\PropagationResultInterface $propagationResultPrototype
     */
    public function setPropagationResultPrototype($propagationResultPrototype)
    {
        $this->propagationResultPrototype = $propagationResultPrototype;
    }
    
    /**
     * Get a Event to be retrigged
     * 
     * @param string $newIdentifier
     * @return unknown
     */
    public function getPingPongEvent($newIdentifier = null)
    {
        $newEvent = clone $this->currentEvent;
        if ( ! $newIdentifier) $newIdentifier = $this->currentEvent->getIdentifier();
        $newEvent->setIdentifier($newIdentifier);
        return $newEvent;
    }
}