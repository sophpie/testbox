<?php
namespace TestBox\Framework\Annotation;

class AnnotationParser
{
    const NS_CLASS = 'class';
    const NS_PROPERTY = 'property';
    const NS_METHOD = 'method';
    
    /**
     * Annotations
     * 
     * @var array of AnnotationInterface
     */
    protected $annotations = array();
    
    /**
     * In with chunk of file are we ?
     * 
     * @var string
     */
    protected $currentChunk = self::NS_CLASS;
    
    /**
     * Chunk annotation buffer
     * 
     * @var array
     */
    protected $annotationBuffer = array();
    
    /**
     * Current parsed annotatoin expression
     */
    protected $annotationExpression = '';
    
    /**
     * Annotation factory
     * 
     * @var AnnotationFactory
     */
    protected $annotationFactory;
    
    /**
     * True if a multiline annotation is open
     * @var unknown
     */
    protected $multilineAnnotaion = false;
    
    
    public function __construct($classFile)
    {
        $this->annotationFactory = new AnnotationFactory();
        $classFileResource = fopen($classFile,'r');
        while ($line = fgets($classFileResource)){
            $line = trim($line);
            if (preg_match('@^(//|\*{1})@', $line) == 1) {
                $exp = $this->manageAnnotationLine($line);
                if ($exp) {
                    array_push($this->annotationBuffer, $exp);
                    $this->annotationExpression = '';
                }
            }
            $this->manageChunk($line);
        }
    }
    
    /**
     * Parse annotaion lines
     * 
     * return false if annotation expression is empty or not finished
     * return the entire annotaion expression 
     * @param string $line
     * @return boolean|string
     */
    protected function manageAnnotationLine($line)
    {
        $line = trim(preg_replace('@[/*\@]@', '', $line));
        if (empty($line)) return false;
        if (preg_match('@\($@', $line) == 1 ) {
            $this->multilineAnnotation = true;
            $this->annotationExpression .= $line;
            return false;
        }
        if (preg_match('@\)$@', $line) == 1 ) {
            $this->multilineAnnotation = false;
            $this->annotationExpression  .= $line;
            return $this->annotationExpression;
        }
        if ($this->multilineAnnotation) $this->annotationExpression  .= $line;
        else return $line;
    }
    
    /**
     * Manage class file chunks : class, method or property related
     * 
     * @param string $line
     */
    protected function manageChunk($line)
    {
        if (preg_match('@^class@', $line)) {
            $this->currentChunk = self::NS_CLASS;
            $this->parseAnnotations();
            $this->annotationBuffer = array();
        }
        if (preg_match('@function@', $line)) {
            $this->currentChunk = self::NS_METHOD;
            preg_match_all('@function ([^()]*)@', $line, $tmp);
            $this->parseAnnotations($tmp[1][0]);
            $this->annotationBuffer = array();
        }
        else if (preg_match('@^(public|protected|private|static)@', $line)) {
            $this->currentChunk = self::NS_PROPERTY;
            preg_match_all('@([a-zA-Z0-9]*);$@', $line, $tmp);
            $this->parseAnnotations($tmp[1][0]);
            $this->annotationBuffer = array();
        }
    }
    
    /**
     * Parse annotations
     * 
     * @param string $name
     */
    protected function parseAnnotations($name = null)
    {
        foreach ($this->annotationBuffer as $annotationString){
            $this->annotations[$this->currentChunk] = $this->annotationFactory->fromString($annotationString);
        }
    }
}