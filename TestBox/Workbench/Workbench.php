<?php
/**
 * Main container for TestBox testing
 * 
 * Services:
 * config:              Whole configuration
 * environment:         Environment manager
 * report:              Report
 * dataInjectorManager: Data injector manager    
 */
namespace TestBox\Workbench;

use TestBox\Framework\Configuration\ConfigurationInterface;
use TestBox\Framework\Configuration\ConfigurationJson;
use TestBox\Framework\ServiceLocator\Service\Instance;
use TestBox\Test\Suite\TestSuite;
use TestBox\Framework\EventManager\EventManager;
use TestBox\Framework\Configuration\Configuration;
use TestBox\Framework\DependencyInjector\Container\Container;
use TestBox\Test\Test;

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
        $this->setDiContainer(new Container());
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Workbench\WorkbenchAbstract::doConfiguration()
     */
    protected function doConfiguration(ConfigurationInterface $initialConfig)
    {
        $config = new Configuration();
        $config->merge(ConfigurationJson::fromFile($this->testBoxDirectory . '/TestBox/Config/global.config.json'));
        $config->merge($initialConfig);
        $this->addService('config', new Instance($config));
        $this->configure($this->get('config')->workbench);
    }
    
    /**
     * Test factory
     * 
     * @return \TestBox\Test\Test
     */
    public function createTest()
    {
        $test = new Test();
        $test->setServiceLocator($this);
        return $test;
    }
    
    /**
     * Initiate a test suite
     *
     * @return TestSuite
     */
    public function createTestSuite()
    {
        $testSuite = new TestSuite();
        $testSuite->setServiceLocator($this);
        $testSuite->setEventManager(new EventManager());
        return $testSuite;
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
     * Return test report
     * 
     * @return ReportInterface
     */
    public function getReport()
    {
        return $this->get('report');
    }
    
    /**
     * Get a data injecor
     * 
     * @param string $dataInjectorKey
     */
    public function getDataInjector($dataInjectorKey)
    {
        return $this->get('dataInjectorManager')->get($dataInjectorKey);
    }
    
    /**
     * Static factory 
     * 
     * @param string $rootDirectory
     * @param Configuration $initialConfig
     */
    static public function initiate(ConfigurationInterface $initialConfig,$rootDirectory = null)
    {
        $workbench = new self(rtrim($rootDirectory,DIRECTORY_SEPARATOR));
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