<?php
namespace TestBox\Framework\Core;

use TestBox\Framework\Configuration\ConfigurationAbstract;
interface ConfigurableInterface
{
    /**
     * Configure object from an array
     * 
     * @param array $options
     */
    public function configure(Array $options);
}