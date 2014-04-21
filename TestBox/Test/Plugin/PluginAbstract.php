<?php
namespace TestBox\Test\Plugin;

use TestBox\Test\TestInterface;

abstract class PluginAbstract implements PluginInterface
{
    /**
     * Test 
     * 
     * @var TestInterface
     */
    protected $test;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\Plugin\PluginInterface::apply()
     */
    abstract public function __invoke($args);
    
	/**
     * @return the $test
     */
    public function getTest()
    {
        return $this->test;
    }

	/**
     * @param \TestBox\Test\TestInterface $test
     */
    public function setTest(TestInterface $test)
    {
        $this->test = $test;
    }

    
    
}