<?php
namespace TestBox\Framework\ServiceLocator\Service;

use TestBox\Framework\ServiceLocator\ServiceLocatorInterface;
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
        if ($this->isShared) {
            if ( ! $this->sharedInstance) {
                $className = $this->className;
                $this->sharedInstance = new $className();
            }
            return $this->sharedInstance;
        }
        return new $className();
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\ServiceLocator\service\ServiceAbstract::configure()
     */
    public function configure(Array $options)
    {
        parent::configure($options);
        if (isset($options['class'])) $this->className = $options['class'];
    }
}