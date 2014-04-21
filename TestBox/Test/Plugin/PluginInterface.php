<?php
namespace TestBox\Test\Plugin;

use TestBox\Test\TestInterface;

interface PluginInterface
{
    /**
     * Apply plugin
     * 
     * @param array $arg
     */
    public function __invoke($arg);
    
    /**
     * @return the $test
     */
    public function getTest();
    
    /**
     * @param TestInterface $test
     */
    public function setTest(TestInterface $test);
}