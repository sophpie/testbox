<?php
namespace TestBox\Scenario;

use TestBox\Box\BoxInterface;

interface ScenarioInterface
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