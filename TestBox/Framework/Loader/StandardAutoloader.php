<?php
namespace TestBox\Framework\Loader;

use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Framework\Configuration\ConfigurationInterface;

require_once __DIR__ . '/../Core/ConfigurableInterface.php';
require_once __DIR__ . '/../Configuration/ConfigurationInterface.php';

class StandardAutoloader implements ConfigurableInterface
{
    /**
     * Namespace root path
     * 
     * @var array
     */
    protected $namespaces = array();
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     */
    public function configure(ConfigurationInterface $config)
    {
        
    }
    
    /**
     * Register autoloader in Spl autoloader stack
     */
    public function splRegister()
    {
        spl_autoload_register(array($this,'autoload'));
    }
    
    /**
     * Autoload given function
     * 
     * @param string $className
     */
    public function autoload($className)
    {
        $fetchStrategies = array('fetchFileByNamespace');
        $i = 0;
        while (isset($fetchStrategies[$i])){
            $method = $fetchStrategies[$i];
            $file = $this->$method($className);
            if ( ! empty($file)) {
                require_once $file;
                return true;
            }
        }
        return false;
    }
    
    /**
     * Add a namespace
     * 
     * @param string $namespace
     * @param string $path
     */
    public function addNamespace($namespace,$path)
    {
        $this->namespaces[$namespace] = $path;
    }
    
    /**
     * Fetch a file using namespace path
     * 
     * @param string $className
     */
    protected function fetchFileByNamespace($className)
    {
        $nsPath = preg_replace('@\\\\[a-zA-Z0-9_]*$@', '', $className);
        $class = trim(str_replace($nsPath, '', $className),'\\');
        $rootPath = '';
        $rootNs = '';
        foreach ($this->namespaces as $namespace => $path)
        {
            if ($namespace == $nsPath) {
                $rootPath = $path;
                $rootNs = $namespace;
                break;
            }
            if (preg_match('@^' . $namespace . '@', $nsPath) != 1) continue;
            if (strlen($namespace) > strlen($rootPath)) {
                $rootPath = $path;
                $rootNs = $namespace;
            }
        }
        if (empty($rootPath)) return;
        $rootPath = rtrim($rootPath,DIRECTORY_SEPARATOR);
        $path = rtrim(preg_replace('@[\\\\_]@', DIRECTORY_SEPARATOR, str_replace($rootNs, '', $className)),DIRECTORY_SEPARATOR);
        return $rootPath . DIRECTORY_SEPARATOR . $path . '.php';
    }
}