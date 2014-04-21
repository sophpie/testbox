<?php
namespace TestBox\Framework\Annotation;

interface AnnotationInterface
{
    /**
     * Constructor
     * 
     * Parameter format : param=value,param2=value2...
     * @param string $parametersString
     */
    public function __construct($parametersString);
    
}