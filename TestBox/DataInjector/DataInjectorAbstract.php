<?php
namespace TestBox\DataInjector;

abstract class DataInjectorAbstract extends \ArrayIterator implements DataInjectorInterface
{
    /**
     * (non-PHPdoc)
     * @see \TestBox\DataInjector\DataInjectorInterface::getParameters()
     */
    abstract  public function getParameters();
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\DataInjector\DataInjectorInterface::getParam()
     */
    abstract public function getParam($name);
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\DataInjector\DataInjectorInterface::__get()
     */
    public function __get($name)
    {
        return $this->getParam($name);
    }
}