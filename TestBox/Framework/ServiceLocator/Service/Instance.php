<?php
namespace TestBox\Framework\ServiceLocator\service;

use TestBox\Framework\ServiceLocator\Service\ServiceAbstract;

class Instance extends ServiceAbstract
{
    /**
     * True is the insatcen has been set
     * @var unknown
     */
    
    protected $isDefined = false;
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceAbstract::getInstance()
     */
    public function getInstance()
    {
        return $this->sharedInstance;
    }
    
    /**
     * Set instance
     * 
     * @param mixed $instance
     */
    public function setInstance($instance)
    {
        if ($this->isDefined) return;
        $this->sharedInstance = $instance;
        $this->isDefined = true;
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceAbstract::configure()
     */
    public function configure($options)
    {
        parent::configure($options);
        if (isset($options['instance'])) $this->setInstance($options['instance']);
    }
}