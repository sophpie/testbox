<?php
/**
 * Main container for TestBox testing
 * 
 * @author sophpie
 *
 */
namespace TestBox\Workbench;

use TestBox\Framework\Configuration\ConfigurationManager;
use TestBox\Framework\Configuration\Configuration;
use TestBox\Framework\ServiceLocator\Service\Instance;
use TestBox\Framework\DependencyInjector\ReflectionInjector;

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
    protected function doConfiguration(Configuration $initialConfig)
    {
        $this->configManager->addFilePhp($this->testBoxDirectory . '/TestBox/Config/global.config.php');
        $this->configManager->add($initialConfig);
        $this->addService('config', new Instance($this->configManager->getConfig()));
        $this->configure($this->get('config')['workbench']);
    }
    
    /**
     * Initiate a test
     *
     * @param TestInterface $test
     */
    public function testFactory(Array $options)
    {
        $this->dependencyInjector->configure($options);
        $test = $this->dependencyInjector->getInstance();
        $test->setServiceLocator($this);
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
     * Return test report
     * 
     * @return ReportInterface
     */
    public function getReport()
    {
        return $this->get('report');
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