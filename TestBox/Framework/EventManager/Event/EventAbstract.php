<?php
namespace TestBox\Framework\EventManager\Event;


abstract class EventAbstract implements EventInterface
{
	/**
	 * Identifier
	 * 
	 * @var string
	 */
	protected $identifier;
	
	/**
	 * Parameters
	 * 
	 * @var array
	 */
	protected $params = array();
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\Event\EventInterface::getIdentifier()
	 */
	public function getIdentifier()
	{
		return $this->identifier;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\Event\EventInterface::setParam()
	 */
	public function setParam($key,$value)
	{
		$this->params[$key] = $value;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\Event\EventInterface::getParam()
	 */
	public function getParam($key)
	{
		if ( ! array_key_exists($key, $this->params)) return null;
		return $this->params[$key];
	}
	
	/**
	 * Check if parameter exists
	 * 
	 * @param string $name
	 * @return boolean
	 */
	public function hasParam($name)
	{
	   return isset($this->params[$name]);
	}
	
	/**
	 * Clone event
	 */
	public function __clone()
	{
	    $this->identifier = null;
	}
	
	/**
	 * Set identifier
	 * 
	 * Only used in case of cloning event
	 * @param unknown $identifier
	 */
	public function setIdentifier($identifier)
	{
	    if ( ! $this->identifier) $this->identifier = $identifier;
	    else throw new \Exception('Trying to change uncloned event identifier');
	}
	
}