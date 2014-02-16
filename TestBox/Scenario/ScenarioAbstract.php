<?php
namespace TestBox\Scenario;

use TestBox\Box\BoxInterface;
use TestBox\Framework\EventManager\Event\EventInterface;

abstract class ScenarioAbstract implements ScenarioInterface
{
    /**
     * Box
     * 
     * @var BoxInterface
     */
    protected $box;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\ScenarioInterface::setBox()
     */
    public function setBox(BoxInterface $box)
    {
        $this->box = $box;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\ScenarioInterface::execute()
     */
    protected function execute($command, $argNames = array())
    {
        return $this->box->execute($command, $argNames);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\ScenarioInterface::run()
     */
    abstract public function run();

}