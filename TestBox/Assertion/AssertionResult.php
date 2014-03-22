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