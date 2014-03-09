<?php
namespace TestBox\Test;

use TestBox\Framework\EventManager\EventManager;
use TestBox\Test\TestEvent;

class Test extends TestAbstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->eventManager = new EventManager();
        $this->event = new TestEvent(TestEvent::EVENT_TEST);
        $this->eventManager->attach(TestEvent::EVENT_TEST, array($this,'executeScenario'));
    }
}