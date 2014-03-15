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
	 * Constructor
	 * 
	 * @param string $identifier
	 */
	public function __construct($identifier)
	{
		$this->identifier = $identifier;
	}
	
	/**
	 * Check if parameter exists
	 * 
	 * @param string $name
	 * @return boolean
	 */
	public function hasParameter($name)
	{
	   return isset($this->params[$name]);
	}
}