<?php
namespace TestBox\Framework\DependencyInjector;

use TestBox\Framework\Core\ConfigurableInterface;

class InjectorFactory
{
    /**
     * Create a dependency injector 
     * 
     * @param className $name
     * @param array $options
     * @throws \Exception
     * @return InjectorInterface
     */
    static public function create($name, $options = null)
    {
        if ( ! $name) $name = 'StandardInjector';
        $di = null;
        if (class_exists($name)) $di = new $name();
        if ( ! $di){
            $name = '\TestBox\Framework\DependencyInjector\\' . ucfirst($name);
            if (class_exists($name)) $di = new $name();
        }
        if ( ! $di) throw new \Exception('Cannot instantiate ' . $name);
        if ($name instanceof ConfigurableInterface) $di->setConfig($options);
        return $di;
    }
}