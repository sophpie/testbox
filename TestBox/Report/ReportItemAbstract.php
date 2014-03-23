<?php
namespace TestBox\Report;

use TestBox\Test\TestEvent;
use TestBox\Framework\Parameters\Parameters;

abstract class ReportItemAbstract implements ReportItemInterface
{
    /**
     * Item data
     * 
     * @var Parameters
     */
    protected $data;
    
    /**
     * Check if test correpsonding to item is valid
     * 
     * @var boolean
     */
    protected $isValid = false;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Report\ReportItemInterface::extractData()
     */
    abstract public function extractData(TestEvent $testEvent);
    
    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        $this->data = new Parameters();
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::setParam()
     */
    public function setParam($name,$value)
    {
        $this->data->setParam($name, $value);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::hasParam()
     */
    public function hasParam($name)
    {
        return $this->data->hasParam($name);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::getParam()
     */
    public function getParam($name)
    {
        return $this->data->getParam($name);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::setParams()
     */
    public function setParams($array)
    {
        $this->data->setParams($array);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Parameters\ParametersInterface::getNamespaceParams()
     */
    public function getNamespaceParams($namespace)
    {
        return $this->data->getNamespaceParams($namespace);
    }
}