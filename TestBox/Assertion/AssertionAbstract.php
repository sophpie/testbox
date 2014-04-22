<?php
namespace TestBox\Assertion;

use TestBox\Assertion\AssertionResult;
use TestBox\Box\Plugin\PluginAbstract;

abstract class AssertionAbstract extends PluginAbstract implements AssertionInterface
{
    /**
     * Return the number of arguments nededed by validate();
     * @return number
     */
    abstract protected function getArgsNumber();
    
    /**
     * Ckeck assertion
     * 
     * Check if assertion is valid or not
     * Add valid/ubnvalid messages to TestEvent
     * @param array $args
     * @param string $unvalidatedMessage message to be displayed if assertion is not valid
     * @param string $validatedMessage message to be displayed if assertion is valid
     */
    public function __invoke($args)
    {
        $unvalidatedMessage = null;
        $validatedMessage = null;
        $assertionResult= new AssertionResult();
        $assertionResult->setAssertionType(get_class($this));
        $assertionResult->setIsValid($this->validate($args));
        $validationArgs = array_splice($args, 0, $this->getArgsNumber());
        $assertionResult->setArgs($validationArgs);
        if (count($args) > 0) $unvalidatedMessage = $args[0];
        if (count($args) > 1) $validatedMessage = $args[1];
        if ( ! $assertionResult->getIsValid() && $unvalidatedMessage)
            $assertionResult->setMessage($unvalidatedMessage);
        elseif ($validatedMessage)
            $assertionResult->setMessage($validatedMessage);
        $event = $this->test->getEvent();
        $event->addAssertionresult($assertionResult);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Assertion\AssertionInterface::check()
     */
    abstract public function validate($args);

}