<?php
namespace TestBox\Framework\ServiceLocator\service;

interface FactoryInterface
{
    /**
     * Create an retrun an instance
     */
    public function createInstance();
}