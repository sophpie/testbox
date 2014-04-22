<?php
namespace TestBox\Box;

use TestBox\Box\Plugin\PluginManager;

abstract class BoxAbstract implements  BoxInterface
{
    /**
     * Plugin manager
     * 
     * @var PluginManager
     */
    protected $pluginManager;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::setStatus()
     */
    abstract public function setStatus($array);
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::execute()
     */
    abstract public function execute($command, $args = array());
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setPluginManager(new PluginManager());
        if (method_exists($this, 'init')) $this->init();
    }
    
    /**
     * Initiate box
     */
    public function init()
    {
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::getPluginManager()
     */
    public function getPluginManager()
    {
        return $this->pluginManager;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::setPluginManager()
     */
    public function setPluginManager(PluginManager $pluginManager)
    {
        $this->pluginManager = $pluginManager;
    }
}