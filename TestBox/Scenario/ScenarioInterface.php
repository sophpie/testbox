<?php
namespace TestBox\Scenario;

use TestBox\Box\BoxInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorAware;

interface ScenarioInterface extends ServiceLocatorAware
{
    /**
     * Set box
     * 
     * @param mixed $subject
     */
    public function setBox(BoxInterface $box);
    
    /**
     * Run scenario
     * 
     * @retun mixed
     */
    public function run();
    
    
}