<?php
namespace TestBox\Framework\ServiceLocator\Service;

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