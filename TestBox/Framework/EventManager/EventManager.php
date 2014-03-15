<?php
namespace TestBox\Framework\EventManager;

use TestBox\Framework\EventManager\Propagation\PropagationResult;

class EventManager extends EventManagerAbstract
{
    /**
     * Contructor
     *
     * @param PropagationResultInterface $propagationResultPrototype
     */
    public function __construct()
    {
        $this->propagationResultPrototype = new PropagationResult();
    }
}