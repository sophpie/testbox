<?php
namespace TestBox\Framework\Configuration;

abstract class ConfigurationFileAbstract extends ConfigurationAbstract
{
    /**
     * Configuration file path 
     * 
     * @var string
     */
    protected $fileName;
    
    /**
     * Set data
     * 
     * @param unknown $data
     */
    abstract  public function setData($data,$namespace = null);
    
    /**
     * Set data from Json file
     *
     * @param string $jsonFile
     */
    public static function fromFile($configFile)
    {
        
        $data = file_get_contents($configFile);
        $class = get_called_class();
        $config = new $class();
        $config->setFileName($configFile);
        $data = $config->replacePhpConsts($data);
        $config->setData($data);
        return $config;
    }
    
    /**
     * Replace any PHP const in file data
     * 
     * @param string $string
     * @return string
     */
    protected function replacePhpConsts($string)
    {
        $directory = dirname($this->fileName);
        $string = preg_replace('@__DIR__@', $directory, $string);
        return $string;
    }
    
	/**
     * @return the $fileName
     */
    public function getFileName()
    {
        return $this->fileName;
    }

	/**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

}