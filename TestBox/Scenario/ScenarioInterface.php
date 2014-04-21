<?php
namespace TestBox\Scenario;

interface ScenarioInterface
{
    /**
     * Set sceanrio as a callable class
     * 
     * @param unknown $args
     */
    public function __invoke($args);
    
}