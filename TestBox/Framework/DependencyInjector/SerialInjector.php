<?php
namespace TestBox\Framework\DependencyInjector;

use TestBox\Framework\Core\ConfigurableInterface;

class SerialInjector implements InjectorInterface, ConfigurableInterface
{
    /**
     * Serialized instance string
     * 
     * @var string
     */
    protected $serializedString = '';
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\DependencyInjector\InjectorInterface::getInstance()
     */
    public function getInstance()
    {
        echo $this->serializedString;
        return unserialize($this->serializedString);
    }
    
    /**
     * Constructor
     * 
     * @param unknown $className
     * @param array $configuration
     */
    public function __construct($className, $options = array())
    {
        $this->serializedString = 'O:' . strlen($className) . ':';
        $this->serializedString .= '"' . $className . '":';
        $this->serializedString .= count($options) . ':{';
        $this->configure($options);
        $this->serializedString .= '}';
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\Framework\Core\ConfigurableInterface::configure()
     */
    public function configure($options)
    {
        $this->serializedString .= $this->getSerialString($options);
    }
    
    /**
     * 
     * @param unknown $options
     * @return string
     */
    protected function getSerialString($options)
    {
        $str = '';
        foreach ($options as $propertyName => $propertyDefinition){
            $str .= $this->configureString($propertyName).';';
            
            if (is_string($propertyDefinition))
                $str .= $this->configureString($propertyDefinition);
            if (is_int($propertyDefinition))
                $str .= $this->configureString($propertyDefinition);
            if (is_array($propertyDefinition)){
                if ($propertyDefinition['type'] == 'array')
                    $str .= $this->configureArray($propertyDefinition);
                else $str .= $this->configureObject($propertyDefinition);
            }
            $str .= ';';
        }
        return trim($str,';');
    }
    
    /**
     * Return serialized string
     * 
     * @param array $propertyDefinition
     * @return string
     */
    protected function configureString($propertyDefinition)
    {
        if ( ! is_array($propertyDefinition)) $value = $propertyDefinition;
        else $value = $propertyDefinition['value'];
        $str = 's:';
        $str .= strlen($value) . ':';
        $str .= '"' . $value . '"';
        return $str;
    }
    
    /**
     * Return object serialized string
     * 
     * @param array $propertyDefinition
     * @return string
     */
    protected function configureObject($propertyDefinition)
    {
        $str = 'O:';
        $str .= strlen($propertyDefinition['className']) .':';
        $str .= '"' . $propertyDefinition['className'] .'":';
        $str .= count($propertyDefinition['value']) .':{';
        $str .= $this->getSerialString($propertyDefinition['value']);
        $str .= '}';
        return $str;
    }
    
    /**
     * Return array serialized string
     *
     * @param array $propertyDefinition
     * @return string
     */
    protected function configureArray($propertyDefinition)
    {
        $str = 'a:';
        $str .= count($propertyDefinition['value']) .':{';
        foreach ($propertyDefinition['value'] as $key => $value)
        {
            $str .= $this->configureString($key) . ';';
            $str .= $this->getSerialString($value) . ';';
        }
        $str .= '}';
        return $str;
    }
    
   
}