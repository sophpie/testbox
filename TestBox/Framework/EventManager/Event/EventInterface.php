<?php
namespace TestBox\Framework\EventManager\Event;

interface EventInterface
{
	/**
	 * Return event identifier
	 * 
	 * @return string
	 */
	public function getIdentifier();
	
	/**
	 * Add parameter
	 * 
	 * @param string $key
	 * @param mixed $value
	 */
	public function setParam($key,$value);
	
	/**
	 * Return the parameter value
	 * 
	 * @param string $key
	 * @return mixed
	 */
	public function getParam($key);
}