<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
use TestBox\Framework\Configuration\ConfigurationInterface;

class Constructor extends ServiceAbstract
{
    /**
     * Class to instanciate
     * 
     * @var string
     */
    protected $className;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceAbstract::getInstance()
     */
    public function getInstance(ServiceLocatorInterface $serviceLocator)
    {
        $this->configure($this->config);
        $className = $this->className;
        if ($this->isShared) {
            if ( ! $this->sharedInstance) {
                $this->sharedInstance = new $className();
            }
            return $this->sharedInstance;
        }
        return new $className();
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceAbstract::configure()
     * 
     * Configure:
     * className:   Class to instantiate
     */
    public function configure(ConfigurationInterface $options)
    {
        parent::configure($options);
        if (isset($options->class)) $this->className = $options->class;
    }
}