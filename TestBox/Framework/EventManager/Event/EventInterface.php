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
	
	/**
	 * Return the callback funtion to be used within propagation process
	 * 
	 * This callback wil call with listener result as parameter. 
	 * If callbcak return true event propagation will be stopped.
	 * 
	 * @return callable
	 */
	public function getPropagationCallback();
	
	/**
	 * Set the porpagation callback
	 * 
	 * @param callable $callback
	 */
	public function setPropagationCallback(callable $callback);
}