<?php
namespace TestBox\Box;

use TestBox\Box\Plugin\PluginManager;

interface BoxInterface
{   
    /**
     * Constructor
     */
    public function __construct();
    
    /**
     * Return Box status
     * 
     * Status means internal values
     * @return array;
     */
	public function getStatus();
	
	/**
	 * Set internal properties of Box
	 * 
	 * @param array $array
	 */
	public function setStatus($array);
	
	/**
	 * Execute a command with the given argument
	 * 
	 * @param string $command
	 * @param array $args
	 * @return mixed
	 */
	public function execute($command, $args = array());
	
	/**
	 * Get plugin manager
	 * 
	 * @return PluginManager
	 */
	public function getPluginManager();
	
	/**
	 * Set plugin manager
	 * 
	 * @param PluginManager $pluginManager
	 */
	public function setPluginManager(PluginManager $pluginManager);
}