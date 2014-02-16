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
	 * Propagation callback
	 * 
	 * @var callbable
	 */
	protected $propagationCallback;
	
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
	public function __construct($identifier, $propagationCallback = null)
	{
		$this->identifier = $identifier;
		if ($propagationCallback) $this->setPropagationCallback($propagationCallback);
	}
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\Event\EventInterface::setPropagationCallback()
	 */
	public function setPropagationCallback(callable $callback)
	{
		$this->propagationCallback = $callback;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \TestBox\Framework\EventManager\Event\EventInterface::getPropagationCallback()
	 */
	public function getPropagationCallback()
	{
		return $this->propagationCallback;
	}
}