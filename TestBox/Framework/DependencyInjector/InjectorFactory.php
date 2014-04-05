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
    static public function create($name = 'StandardInjector', $options = null)
    {
        if (class_exists($name)) $di = new $name();
        $name = '\TestBox\Framework\DependencyInjector\\' . ucfirst($name);
        if (class_exists($name)) $di = new $name();
        $name.=$name .'Injector';
        if (class_exists($name)) $di = new $name();
        throw new \Exception('Cannot instantiate ' . $name);
        if ($name instanceof ConfigurableInterface) $di->configure($options);
        return $di;
    }
}