<?php
namespace TestBox\Framework\ServiceLocator\service;

interface ServiceInterface
{
    /**
     * Return an instance
     */
    public function getInstance();
    
    /**
     * Check if the instance is shared
     */
    public function isShared();
}