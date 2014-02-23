<?php
namespace TestBox\Framework\ServiceLocator\Service;

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
    public function getInstance()
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
    public function configure($options)
    {
        parent::configure($options);
        if (isset($options['class'])) $this->className = $options['class'];
    }
}