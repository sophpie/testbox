<?php
namespace TestBox\DataInjector;


use TestBox\Framework\Parameters\Parameters;

class CsvDataInjector extends ArrayDataInjector
{
    /**
     * Delimiter character
     * 
     * @var string
     */
    protected $delimiter = ',';
    
    /**
     * Enclosure character
     * 
     * @var string
     */
    protected $enclosure = '"';
    
    /**
     * Escape character
     * 
     * @var string
     */
    protected $escape = '\\';
    
    /**
     * CSV file path
     * 
     * @var string
     */
    protected $csvFile ='';
    
    /**
     * List of parameters names
     * 
     * @var array
     */
    protected $paramNames = array();
    
    /**
     * Check weither stack is initiated or not
     * 
     * @var boolean
     */
    protected $isInitiated = false;
    
    /**
     * (non-PHPdoc)
     * @see \TestBox\DataInjector\DataInjectorInterface::getParam()
     */
    public function getParam()
    {
        if ( ! $this->isInitiated) $this->init();
        $data = $this->current();
        $param = new Parameters();
        for ($i = 0; $i < count($data); $i++)
        {
            $name = $this->paramNames[$i];
            $param->setParam($name, $data[$i]);
        }
        $this->next();
        return $param;
    }
    
    /**
     * Initiate csv data
     * 
     * @return NULL
     */
    public function init()
    {
        $fileRes = fopen($this->csvFile, 'r');
        if ( ! $fileRes) return null;
        $this->paramNames = fgetcsv($fileRes,0,$this->delimiter,$this->enclosure,$this->escape);
        while (($data = fgetcsv($fileRes,0,$this->delimiter,$this->enclosure,$this->escape)) !== FALSE) {
            $this->append($data);
        }
        fclose($fileRes);
        $this->isInitiated = true;
    }
    
	/**
     * @param string $delimiter
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }

	/**
     * @param string $enclosure
     */
    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;
    }

	/**
     * @param string $escape
     */
    public function setEscape($escape)
    {
        $this->escape = $escape;
    }

	/**
     * @param string $csvFile
     */
    public function setCsvFile($csvFile)
    {
        $this->csvFile = $csvFile;
    }

}