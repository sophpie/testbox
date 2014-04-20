<?php
namespace TestBox\Framework\Annotation;

class Parser
{
    /**
     * 
     * @var unknown
     */
    protected $class;
    
    /**
     * Annotations
     * 
     * @var array
     */
    protected $annoation = array();
    
    public function parse($string)
    {
        preg_match_all('/@ ([a-zA-Z][a-zA-Z0-9]*)\(([^()]?)\)/',$string,$tmp,null);
    }
}