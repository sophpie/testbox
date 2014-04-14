<?php
namespace TestBox\Scenario\Plugin;

use TestBox\Scenario\ScenarioAbstract;

abstract class PluginAbstract implements PluginInterface
{
    /**
     * Scenario 
     * 
     * @var ScenarioAbstract
     */
    protected $scenario;
    
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Scenario\Plugin\PluginInterface::getScenario()
	 */
    public function getScenario()
    {
        return $this->scenario;
    }

	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Scenario\Plugin\PluginInterface::setScenario()
	 */
    public function setScenario($scenario)
    {
        $this->scenario = $scenario;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\Plugin\PluginInterface::apply()
     */
    abstract public function __invoke($args);
    
    
}