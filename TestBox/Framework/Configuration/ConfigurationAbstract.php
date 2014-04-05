<?php
namespace TestBox\Framework\Configuration;

abstract class ConfigurationAbstract implements ConfigurationInterface
{
    /**
     * Internal config
     * 
     * @var array
     */
    protected $internalConfig = array();
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Configuration\ConfigurationInterface::set()
     */
    protected function set($key,$value)
    {
        $key = trim($key,ConfigurationInterface::NS_SEPARATOR);
        $key = $this->normalizeKey($key);
        $this->internalConfig[$key] = $value;
        ksort($this->internalConfig);
    }

    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Configuration\ConfigurationInterface::get()
     */
    public function get($name)
    {
        $name = trim($name,ConfigurationInterface::NS_SEPARATOR);
        $name = $this->normalizeKey($name);
        if (isset($this->internalConfig[$name])) return $this->internalConfig[$name];
        $configClass = get_called_class();
        $config = new $configClass();
        $isConfig = false;
        $name = str_replace('\\', '\\\\', $name);
        foreach ($this->internalConfig as $namespace => $value)
        {
            if (preg_match('@^'.$name.'@', $namespace) != 1) {
                if ( ! $isConfig) continue;
                else break;
            }
            $key = preg_replace('@^'.$name.'@', '', $namespace);
            $config->set($key,$value);
            $isConfig = true;
        }
        if ($isConfig) return $config;
    }

    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Configuration\ConfigurationInterface::merge()
     */
    public function merge(ConfigurationInterface $newConfiguration)
    {
        foreach ($newConfiguration->getInternalConfig() as $key => $value) {
            $this->internalConfig[$key] = $value;
        }
    }
        
	/**
     * @return the $internalConfig
     */
    public function getInternalConfig()
    {
        return $this->internalConfig;
    }
    
    /**
     * Normalize service locator keys
     *
     * @param string $key
     * @return string
     */
    protected function normalizeKey($key)
    {
        $key = strtolower($key);
        $key = preg_replace('@[^a-z0-9\\\\]@', '', $key);
        return $key;
    }
}