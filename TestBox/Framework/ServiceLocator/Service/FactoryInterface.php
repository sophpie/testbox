<?php
namespace TestBox\Framework\ServiceLocator\Service;

interface FactoryInterface
{
    /**
     * Create an retrun an instance
     */
    public function createInstance();
}