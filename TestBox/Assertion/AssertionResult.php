<?php
namespace TestBox\Assertion;

class AssertionResult
{
    /**
     * Type of assertion (assertion class)
     * 
     * @var string
     */
    protected $assertionType = '';
    
    /**
     * Assertion message
     * 
     * @var string
     */
    protected $message = '';
    
    /**
     * Has assertion been validate
     * 
     * @var boolean
     */
    protected $isValid = false;
    
    /**
     * Backtracte
     * 
     * @var string
     */
    protected $trace = '';
    
    /**
     * Assertion arguments
     * @var array
     */
    protected $args = array();
    
	/**
     * @return the $assertionType
     */
    public function getAssertionType()
    {
        return $this->assertionType;
    }

	/**
     * @return the $message
     */
    public function getMessage()
    {
        return $this->message;
    }

	/**
     * @return the $isValid
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

	/**
     * @return the $trace
     */
    public function getTrace()
    {
        return $this->trace;
    }
    
	/**
     * @param string $assertionType
     */
    public function setAssertionType($assertionType)
    {
        $this->assertionType = $assertionType;
    }

	/**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

	/**
     * @param boolean $isValid
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
    }

	/**
     * Set code trace
     */
    public function setTrace()
    {
        $backtrace = debug_backtrace();
        $trace = $backtrace[3];
        $traceMessage = $trace['file'] . ' - on line ' . $trace['line'] ;
        $this->trace = $traceMessage;
    }
	/**
     * @return the $args
     */
    public function getArgs()
    {
        return $this->args;
    }

	/**
     * @param multitype: $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }

}