<?php
namespace TestBox\Box\Plugin;

use TestBox\Framework\ServiceLocator\ServiceLocatorAbstract;
use TestBox\Framework\Configuration\ConfigurationArray;

class PluginManager extends ServiceLocatorAbstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addPlugin('assertTrue','TestBox\Assertion\Boolean\AssertTrue');
        $this->addPlugin('assertFalse','TestBox\Assertion\Boolean\AssertFalse');
        $this->addPlugin('assertEquals','TestBox\Assertion\Comparison\AssertEquals');
    }
    
    /**
     * Add plugin
     * 
     * @param string $name
     * @param string $className
     */
    public function addPlugin($name,$className)
    {
        $this->defineService($name, new ConfigurationArray(array(
                'serviceClass'=> 'Constructor',
                'options'=> array('class' => $className),
            )
        ));
    }
}
