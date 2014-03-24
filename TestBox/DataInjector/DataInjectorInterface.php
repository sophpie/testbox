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
    public function getParam();
}