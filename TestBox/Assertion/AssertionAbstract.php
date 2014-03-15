<?php
namespace TestBox\Assertion;

use TestBox\Test\TestEvent;
use TestBox\Assertion\AssertionResult;

abstract class AssertionAbstract implements AssertionInterface
{
    /**
     * Assertion result
     * 
     * @var AssertionResult
     */
    protected $assertionResult;
    
    /**
     * Ckeck assertion
     * 
     * @param array $args
     * @param string $unvalidatedMessage message to be displayed if assertion is not valid
     * @param string $validatedMessage message to be displayed if assertion is valid
     */
    public function check($args, $unvalidatedMessage = null, $validatedMessage = null)
    {
        $this->assertionResult= new AssertionResult();
        $this->assertionResult->setAssertionType(get_class($this));
        $this->assertionResult->setIsValid($this->validate($args));
        $this->assertionResult->setTrace();
        $this->assertionResult->setArgs($args);
        if ( ! $this->assertionResult->getIsValid() && $unvalidatedMessage)
            $this->assertionResult->setMessage($unvalidatedMessage);
        elseif ($validatedMessage)
            $this->assertionResult->setMessage($validatedMessage);
        return $this->assertionResult;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Assertion\AssertionInterface::check()
     */
    abstract public function validate($args);

}