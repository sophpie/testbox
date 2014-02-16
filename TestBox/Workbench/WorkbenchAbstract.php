<?php
namespace TestBox\Workbench;

use TestBox\Environment\EnvironmentManager;
use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Environment\EnvironmentAbstract;
use TestBox\Test\Test;

abstract class WorkbenchAbstract implements ConfigurableInterface
{
    /**
     * Environment manager
     *
     * @var EnvironmentManager
     */
    protected $environmentManager;
    
    /**
     * Constructor
     * @param array $options
     */
    public function __construct($options = null)
    {
        $this->environmentManager = new EnvironmentManager();
        if ($options) $this->configure($options);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     */
    public function configure($options)
    {
        $this->environmentManager->configure($options['environmentManager']);
    }

    /**
     * Return an environment
     *
     * @param string $envName
     * @return EnvironmentAbstract
     */
    public function getEnvironment($envName = null)
    {
        return $this->environmentManager->getEnvironment($envName);
    }
    
    /**
     * @param EnvironmentManager $environmentManager
     */
    public function setEnvironmentManager(EnvironmentManager $environmentManager)
    {
        $this->environmentManager = $environmentManager;
    }
    
    /**
     * 
     * @param Test $test
     */
    public function runTest(Test $test)
    {
        
    }
}