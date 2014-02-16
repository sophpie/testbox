<?php
namespace TestBox\Framework\Core;

interface ConfigurableInterface
{
    /**
     * Configure object from an array
     * 
     * @param array $options
     */
    public function configure($options);
}