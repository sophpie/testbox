<?php
namespace TestBox\Test\Container;

use TestBox\Test\TestManager;

class Container extends ContainerAbstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setServiceLocator(new TestManager());
    }
}