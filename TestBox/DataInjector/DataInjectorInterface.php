<?php
namespace TestBox\DataInjector;

use TestBox\Framework\Parameters\Parameters;

interface DataInjectorInterface extends \Iterator
{
    /**
     * Return parameter and set pointer to next position
     * 
     * @return Parameters
     */
    public function getParameters();
    
    /**
     * Get parameter value
     * 
     * @param string $name
     */
    public function getParam($name);
    
    /**
     * Magical shortcut for getParam
     * 
     * @param string $name
     */
    public function __get($name);
}