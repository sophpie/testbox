<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\ServiceLocator\Service\ServiceAbstract;
use TestBox\Framework\Configuration\ConfigurationAbstract;
use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;

class Instance extends ServiceAbstract
{
    /**
     * True is the instance has been set
     * @var unknown
     */
    protected $isDefined = false;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceAbstract::getInstance()
     */
    public function getInstance(ServiceLocatorInterface $serviceLocator)
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
    public function configure(Array $options)
    {
        parent::configure($options);
        if (isset($options['instance'])) $this->setInstance($options['instance']);
    }
    
    /**
     * Constructor
     * 
     * @param mixed $instance
     * @param boolean $isShared
     */
    public function __construct($instance = null)
    {
        if ($instance) $this->setInstance($instance);
    }
}