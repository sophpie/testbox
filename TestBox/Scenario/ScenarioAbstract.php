<?php
namespace TestBox\Scenario;

use TestBox\Box\BoxInterface;
use TestBox\Test\TestEvent;
use TestBox\Workbench\WorkbenchAbstract;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

abstract class ScenarioAbstract implements ScenarioInterface
{
    /**
     * Box
     * 
     * @var BoxInterface
     */
    protected $box;
    
    /**
     * Test event
     * 
     * @var TestEvent
     */
    protected $event;
    
    /**
     * Workbench
     * 
     * @var WorkbenchAbstract
     */
    protected $workbench;
    
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
     * @see \TestBox\Framework\ServiceLocator\ServiceLocatorAware::setServiceLocator()
     */
    public function setServiceLocator(ServiceLocatorInterface $workbench)
    {
        $this->workbench = $workbench;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\ScenarioInterface::execute()
     */
    public function execute($command, $argNames = array())
    {
        return $this->box->execute($command, $argNames);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Scenario\ScenarioInterface::run()
     */
    abstract public function run();
    
	/**
     * @return the $event
     */
    public function getEvent()
    {
        return $this->event;
    }

	/**
     * @param \TestBox\Test\TestEvent $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * Manage called method
     * 
     * Call plugins.
     * 
     * @param string $name
     * @param array $args
     */
    public function __call($name, $args)
    {
        if ($this->getPluginManager()->hasService($name)){
            $plugin = $this->getPluginManager()->get($name);
            $plugin->setScenario($this);
            $plugin($args);
            return $plugin;
        }
    }
    
    /**
     * Shortcut to get injected parameter value
     * 
     * @param srting $name
     */
    public function __get($name)
    {
        $dataInjector = $this->workbench->getDataInjector($name);
        if ( ! $dataInjector) return;
        return $dataInjector;
    }
    /**
     * get plugin manager
     */
    protected function getPluginManager()
    {
        return $this->workbench->get('pluginManager');
    }
    
    /**
     * Get param from data injector
     * 
     * @param string $dataInjector key
     * @param string $key
     */
    public function param($dataInjector, $key)
    {
        $dataInjector = $this->workbench->getDataInjector($dataInjector);
        $param = $dataInjector->getParameters()->getParam($key);
        return $param;
    }

}