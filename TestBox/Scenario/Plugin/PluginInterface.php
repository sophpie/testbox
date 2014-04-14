<?php
namespace TestBox\Scenario\Plugin;

interface PluginInterface
{
    /**
     * Apply plugin
     * 
     * @param array $arg
     */
    public function __invoke(array $arg);
    
    /**
     * @return the $scenario
     */
    public function getScenario();
    
    /**
     * @param \TestBox\Scenario\ScenarioAbstract $scenario
     */
    public function setScenario($scenario);
}