<?php
/**
 * Main container for TestBox testing
 * 
 * @author sophpie
 *
 */
namespace TestBox\Workbench;

use TestBox\Framework\Configuration\ConfigurationManager;
use TestBox\Framework\Configuration\ConfigurationAbstract;
use TestBox\Framework\ServiceLocator\Service\Instance;
use TestBox\Framework\DependencyInjector\ReflectionInjector;
use TestBox\Test\Suite\TestSuite;
use TestBox\Framework\EventManager\EventManager;

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
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Workbench\WorkbenchAbstract::doConfiguration()
     */
    protected function doConfiguration(ConfigurationAbstract $initialConfig)
    {
        $this->configManager->addFilePhp($this->testBoxDirectory . '/TestBox/Config/global.config.php');
        $this->configManager->add($initialConfig);
        $this->addService('config', new Instance($this->configManager->getConfig()));
        $this->configure($this->get('config')['workbench']);
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
    static public function initiate($rootDirectory, ConfigurationAbstract $initialConfig)
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