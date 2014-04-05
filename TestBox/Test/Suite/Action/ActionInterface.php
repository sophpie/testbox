<?php
namespace TestBox\Test\Suite\Action;

use TestBox\Framework\EventManager\Event\EventInterface;

interface ActionInterface
{
    /**
     * Run suite action
     * 
     * @param EventInterface $event
     */
    public function run (EventInterface $event);
    
}