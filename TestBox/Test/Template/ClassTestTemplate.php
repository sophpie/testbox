<?php
namespace TestBox\Test\Template;

use TestBox\Test\Test;
use TestBox\Box\ClassBox\ClassBox;
use TestBox\Box\BoxInterface;
use TestBox\Test\TestEvent;

abstract class ClassTestTemplate extends Test
{
    /**
     * Constructor 
     * @param string $className class to test
     */
    public function __construct($className)
    {
        parent::__construct();
        $this->box->setClassName($className);
    }
    /**
     * (non-PHPdoc)
     * @see \TestBox\Test\TestAbstract::init()
     */
    protected function init()
    {
        $this->setScenario(array($this,'playScenario'));
        $this->setBox(new ClassBox());
    }
    
    /**
     * Play scenario
     */
    abstract public function playScenario(TestEvent $event, BoxInterface $box);
}