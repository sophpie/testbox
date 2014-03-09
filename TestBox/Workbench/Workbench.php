<?php
namespace TestBox\Workbench;

use TestBox\Framework\Configuration\ConfigurationManager;
use TestBox\Environment\EnvironmentManager;
use TestBox\Framework\Configuration\Configuration;
use TestBox\Framework\ServiceLocator\Service\Instance;
use TestBox\Framework\DependencyInjector\ReflectionInjector;
use TestBox\Assertion\AssertionManager;

class Workbench extends WorkbenchAbstract
{
    /**
     * Root directory
     *
     * @var string
     */
    protected $rootDirectory;
    
    /**
     * Path to TestBox
     *
     * @var string
     */
    protected $testBoxDirectory;
    
    /**
     * Constructor
     * @param array $options
     */
    public function __construct($rootDirectory)
    {
        $this->setRootDirectory($rootDirectory);
        $this->setTestBoxDirectory(realpath(__DIR__ .'/../../'));
        $this->setConfigManager(new ConfigurationManager());
        $this->setDependencyInjector(new ReflectionInjector());
        $this->environmentManager = new EnvironmentManager();
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Workbench\WorkbenchAbstract::doConfiguration()
     */
    protected function doConfiguration(Configuration $initialConfig)
    {
        $this->configManager->addFilePhp($this->testBoxDirectory . '/TestBox/Config/global.config.php');
        $this->configManager->add($initialConfig);
        $this->addService('config', new Instance($this->configManager->getConfig()));
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Workbench\WorkbenchAbstract::init()
     */
    protected function init()
    {
        $environmentConfig = $this->get('config')['environmentManager'];
        $environmentManager = new EnvironmentManager();
        $environmentManager->configure($environmentConfig);
        $this->addService('environments', new Instance($environmentManager));
    }
    
    /**
     * Initiate a test
     *
     * @param TestInterface $test
     */
    public function testFactory(Configuration $options)
    {
        $this->dependencyInjector->configure($options);
        $test = $this->dependencyInjector->getInstance();
        $test->setServiceLocator($this);
        $config = $this->get('config');
        $assertionManager = new AssertionManager(new Configuration($config['assertion_manager']));
        $test->setAssertionManager($assertionManager);
        return $test;
    }
    
    /**
     * Return an environment
     *
     * @param string $envName
     * @return EnvironmentAbstract
     */
    public function getEnvironment($envName = null)
    {
        return $this->get('environments')->getEnvironment($envName);
    }
    
    /**
     * Static factory 
     * 
     * @param string $rootDirectory
     * @param Configuration $initialConfig
     */
    static public function initiate($rootDirectory, Configuration $initialConfig)
    {
        $workbench = new self($rootDirectory);
        $workbench->boostrap($initialConfig);
        return $workbench;
    }
    
    /**
     * @return the $testBoxDirectory
     */
    public function getTestBoxDirectory()
    {
        return $this->testBoxDirectory;
    }
    
    /**
     * @param string $testBoxDirectory
     */
    public function setTestBoxDirectory($testBoxDirectory)
    {
        $this->testBoxDirectory = $testBoxDirectory;
    }
    
    /**
     * @return the $rootDirectory
     */
    public function getRootDirectory()
    {
        return $this->rootDirectory;
    }
    
    /**
     * @param string $rootDirectory
     */
    public function setRootDirectory($rootDirectory)
    {
        $this->rootDirectory = $rootDirectory;
    }
}