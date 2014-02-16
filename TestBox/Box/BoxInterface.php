<?php
namespace TestBox\Box;

interface BoxInterface
{
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
	 * Set parameters
	 * 
	 * @param array $array
	 */
	public function setParameters($array);
	
	/**
	 * Set box parameter
	 * 
	 * You can use namespace : ns::key = value
	 * @param string $name
	 * @param mixed $value
	 */
	public function setParameter($name,$value);
	
	/**
	 * Execute a command with the given argument
	 * 
	 * @param string $command
	 * @param array $args
	 * @return mixed
	 */
	public function execute($command, $args = array());
}