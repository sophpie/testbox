<?php
namespace TestBox\Framework\ServiceLocator;

class ServiceLocator extends ServiceLocatorAbstract
{
    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        if ($options) $this->configure($options);
    }
}