<?php
namespace TestBox\Framework\Core;

use TestBox\Framework\Configuration\ConfigurationInterface;

interface ConfigurableInterface
{
    /**
     * Configure object from an array
     * 
     * @param ConfigurationInterface $config
     */
    public function configure(ConfigurationInterface $config);
}