<?php
namespace TestBox\Box;

use TestBox\Framework\Parameters\ParametersInterface;

abstract class BoxAbstract implements  BoxInterface
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::setStatus()
     */
    abstract public function setStatus($array);
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Box\BoxInterface::execute()
     */
    abstract public function execute($command, $args = array());
}