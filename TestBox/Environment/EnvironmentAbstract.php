<?php
namespace TestBox\Environment;

use TestBox\Framework\ServiceLocator\ServiceLocatorAware;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
use TestBox\Framework\Core\ConfigurableInterface;
use TestBox\Framework\ServiceLocator\ServiceLocatorAbstract;

abstract class EnvironmentAbstract extends ServiceLocatorAbstract implements ConfigurableInterface
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