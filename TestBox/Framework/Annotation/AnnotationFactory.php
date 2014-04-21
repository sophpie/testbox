<?php
namespace TestBox\Framework\Annotation;

use TestBox\Framework\Annotation\AnnotationAbstract;

class AnnotationFactory extends AnnotationAbstract
{
    public function fromstring($annotationString)
    {
        if (preg_match('@\(@',$annotationString) != 1 ) $annotationString .= '()';
        preg_match('@^([a-zA-Z0-9]*)\s*\(([^()]*)\)@', $annotationString, $tmp);
        if (count($tmp) != 3) return;
        $annotationClass = ucfirst($tmp[1]);
        if (empty($annotationClass)) return;
        $annotationParametersString = $tmp[2];
        $annotation = $this->getAnotationClass($annotationClass,$annotationParametersString);
        if ( ! $annotation) return;
        return $annotation;
    }
    
    /**
     * Get Annotation
     * 
     * @param string $name
     * @return string
     */
    protected function getAnotationClass($name, $parametersString = null)
    {
        if (preg_match('@\\\\@', $name)) $className = $name;
        else $className = 'TestBox\Framework\Annotation\Annotation\\' . ucfirst($name);
        if ( ! class_exists($className,true)) {
            return false;
        }
        return new $className($parametersString);
    }
}