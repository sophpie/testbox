<?php
namespace TestBox\Framework\Annotation;

abstract class AnnotationAbstract implements AnnotationInterface
{
    /**
     * Constructor
     * 
     * @param string $parametersString
     */
    public function __construct($parametersString = null)
    {
        preg_match_all('@([a-zA-Z0-9]*)=([a-zA-Z0-9]*)@', $parametersString,$tmp,PREG_SET_ORDER);
        foreach ($tmp as $item){
            $property = $item[1];
            if ( ! property_exists($this, $property)) continue;
            $this->$property = $item[2];
        }
    }
}