<?php
namespace TestBox\DataInjector;


use TestBox\Framework\Parameters\Parameters;
class CsvDataInjector extends ArrayDataInjector
{
    /**
     * List of parameters names
     * 
     * @var array
     */
    protected $paramNames = array();
    
    /**
     * Constructor 
     * @param unknown $csvFile
     * @param number $length
     * @param string $separator
     * @param string $delimiter
     * @param string $enclosure
     */
    public function __construct($csvFile,$length=0,$delimiter=',',$enclosure='"',$escape='\\')
    {
        parent::__construct(array());
        $fileRes = fopen($csvFile, 'r');
        if ( ! $fileRes) return null;
        $this->paramNames = fgetcsv($fileRes,$length,$delimiter,$enclosure,$escape);
        while (($data = fgetcsv($fileRes,$length,$delimiter,$enclosure,$escape)) !== FALSE) {
            $this->append($data);
        }
        fclose($fileRes);
    }
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\DataInjector\DataInjectorInterface::getParam()
     */
    public function getParam()
    {
        $data = $this->current();
        $param = new Parameters();
        for ($i = 0; count($data); $i++)
        {
            $name = $this->paramNames[$i];
            $param->setParam($name, $data[$i]);
        }
        $this->next();
        return $param;
    }
}