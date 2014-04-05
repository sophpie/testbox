<?php
namespace TestBox\Framework\DependencyInjector;

interface InjectorInterface
{
    /**
     * Return instance
     * 
     * @return mixed
     */
    public function getInstance();
}