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
     * Iterator position
     * 
     * @var integer
     */
    protected $iteratorPosition = 0;
    
    /**
     * Iterator keys
     * 
     * @var array
     */
    protected $keys = array();
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Configuration\ConfigurationInterface::set()
     */
    protected function set($key,$value)
    {
        $key = trim($key,ConfigurationInterface::NS_SEPARATOR);
        $key = $this->normalizeKey($key);
        $this->internalConfig[$key] = $value;
        $this->initializeConfig();
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
     * Chek if a configuration part exists
     * 
     * @param string $name
     * @return boolean
     */
    public function __isset($name)
    {
        $name = $this->normalizeKey($name);
        if (array_key_exists($name, $this->internalConfig)) return true;
        foreach ($this->internalConfig as $key => $value){
            if (preg_match('@^'.$name.'@', $key) == 1) return true;
        }
        return false;
    }
    
    /**
     * Magical get method
     * 
     * @param string $name
     */
    public function __get($name)
    {
        return $this->get($name);
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
        $this->initializeConfig();
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
    
    /**
     * Initialize keys array
     * 
     * This array will be used for iteration purposes
     */
    protected function initializeConfig()
    {
        ksort($this->internalConfig);
        foreach ($this->internalConfig as $key => $value)
        {
            $keyName = current(preg_split('@\\\\@', $key));
            if ( ! in_array($keyName, $this->keys)) array_push($this->keys, $keyName);
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see Iterator::current()
     */
    public function current()
    {
        return $this->get($this->key());
    }
    
    /**
     * (non-PHPdoc)
     * @see Iterator::key()
     */
    public function key()
    {
        return $this->keys[$this->iteratorPosition];
    }
    
    /**
     * (non-PHPdoc)
     * @see Iterator::next()
     */
    public function next(){
        $this->iteratorPosition++;
    }
    
    /**
     * (non-PHPdoc)
     * @see Iterator::rewind()
     */
    public function rewind(){
        $this->iteratorPosition = 0;
    }
    
    /**
     * (non-PHPdoc)
     * @see Iterator::valid()
     */
    public function valid()
    {
        if ($this->iteratorPosition >= count($this->keys)) return false;
        if ($this->iteratorPosition < 0) return false;
        return true;
    }
    
    /**
     * (non-PHPdoc)
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }
    
    /**
     * (non-PHPdoc)
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }
    
    /**
     * (non-PHPdoc)
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value)
    {
    }
    
    /**
     * (non-PHPdoc)
     * @see ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset)
    {
    }
}