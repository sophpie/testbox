<?php
namespace TestBox\Framework\EventManager\Trigger;

use TestBox\Framework\EventManager\EventManagerAbstract;
use TestBox\Framework\EventManager\EventManagerInterface;
use TestBox\Framework\EventManager\Event\EventInterface;
use TestBox\Framework\EventManager\Propagation\PropagationResultAbstract;

trait EventTriggerTrait
{
    /**
     * Event manager
     * 
     * @var EventManagerAbstract
     */
    protected $eventManager;
    
    /**
     * Set event Manager
     * 
     * @param EventManagerInterface $eventManager
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }
    
    /**
     * Trigger strategy by event
     * 
     * Trigger an event already instantiated
     * @param EventInterface $event
     * @return PropagationResultAbstract
     */
    public function triggerEvent(EventInterface $event,callable $callback = null)
    {
        return $this->eventManager->doPropagation($event, $callback);
    }
    
    /**
     * Trigger strategy by identifier
     * 
     * Create and trigger event
     * @param string $identifier
     * @param string $eventClass
     * @param callable $callback
     * @return PropagationResultAbstract
     */
    public function triggerDefaultEvent($identifier,$eventClass = null,callable $callback = null)
    {
        if ( ! $eventClass) $eventClass = 'TestBox\Framework\EventManager\Event\Event';
        if ( ! class_exists($eventClass)) return null;
        $event = new $eventClass($identifier);
        return $this->triggerEvent($event, $callback);
    }
    
    /**
     * Trigger an event
     * 
     * @return PropagationResultAbstract
     */
    public function trigger()
    {
        $args = func_get_args();
        if ($args[0] instanceof \TestBox\Framework\EventManager\Event\EventInterface){
            if ( ! isset($args[1])) $args[1] = null;
            return $this->triggerEvent($args[0],$args[1]);
        }
        if (is_string($args[0])){
            if ( ! isset($args[1])) $args[1] = null;
            if ( ! isset($args[2])) $args[2] = null;
            return $this->triggerDefaultEvent($args[0],$args[1],$args[2]);
        }
    }
    
    /**
     * Re-trigger last event with different identifier
     * 
     * @param unknown $newIdentifier
     */
    public function retrigger($newIdentifier)
    {
        $this->triggerEvent($this->eventManager->getPingPongEvent($newIdentifier));
    }
}