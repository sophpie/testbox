<?php
namespace TestBox\Test;

use TestBox\Framework\EventManager\Event\EventAbstract;

class TestEvent extends EventAbstract
{
    const EVENT_PRE_TEST = 'testEvent::pre_test';
    const EVENT_SET_ENV = 'testEvent::set_environment';
    const EVENT_TEST = 'testEvent::test';
    const EVENT_RESET_ENV = 'testEvent::reset_environment';
    const EVENT_POST_TEST = 'testEvent::post_test';
    
    /**
     * Result
     * @var ResultInterface
     */
    protected $result;
    
}