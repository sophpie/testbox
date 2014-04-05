<?php
namespace TestBox\Framework\Configuration;

use TestBox\Framework\Exception\Exception;

class ConfigurationJson extends ConfigurationArray
{
    /**
     * Constructor 
     * 
     * @param string $jsonData
     */
    public function __construct($jsonData = null)
    {
       if ($jsonData) $this->setJsonData($jsonData);
       
    }
    
    /**
     * Set interbal data from Json string
     * 
     * @param string $jsonData
     */
    public function setJsonData($jsonData, $namespace = '')
    {
        $json = json_decode($jsonData, true);
        if ( ! $this->isValidJson()) return;
        $this->setArrayData($json, $namespace);
    }
    
    /**
     * Check Json string validity
     * 
     * @return boolean
     */
    protected function isValidJson()
    {
        if ( ! json_last_error()) return true;
        $message = '';
        switch (json_last_error()) {
        	case JSON_ERROR_NONE:
        	    $message =  'No errors'; break;
        	case JSON_ERROR_DEPTH:
        	    $message =  'Maximum stack depth exceeded'; break;
        	case JSON_ERROR_STATE_MISMATCH:
        	    $message =  'Underflow or the modes mismatch'; break;
        	case JSON_ERROR_CTRL_CHAR:
        	    $message =  'Unexpected control character found'; break;
        	case JSON_ERROR_SYNTAX:
        	    $message = 'Syntax error, malformed JSON'; break;
        	case JSON_ERROR_UTF8:
        	    $message =  'Malformed UTF-8 characters, possibly incorrectly encoded'; break;
        	default:
        	    $message =  'Unknown error';
        }
        throw new Exception($message);
        return false;
    }
}