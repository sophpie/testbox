<?php
namespace TestBox\Console;

class Route
{
    /**
     * Parsed arguments
     * 
     * @var array
     */
    protected $arguments = array();
    
    /**
     * TestBox command
     * 
     * @var string
     */
    protected $command;
    
    /**
     * 
     * @param array $argv
     */
    public function __construct(array $argv)
    {
        if ($argv) $this->parseArguments($argv);
    }
    
    /**
     * Parse command line
     * 
     * @param array $argv
     * @return array
     */
    protected function parseArguments($argv)
    {
        $data = array();
        for ($i = 1; $i < count($argv); $i++){
            $str = $argv[$i];
            $str = preg_replace('@-@', '', $str);
            $tmp = preg_split('@=@', $str);
            if (count($tmp) == 2){
                $this->arguments[trim($tmp[0])] = trim($tmp[1]);
            }
            else {
                if (! isset($argv[$i+1])) $value = true;
                elseif (preg_match('@-@', $argv[$i+1]) == 1 ) $value = true;
                else {
                    $i++;
                    $value = $argv[$i];
                }
            	$data[$str] = $value;
            }
        }
        return $data;
    }
    
	/**
     * @return the $arguments
     */
    public function getArguments()
    {
        return $this->arguments;
    }
    
    /**
     * Get argument
     * 
     * @param string $key
     * @return multitype:
     */
    public function get($key)
    {
        return $this->arguments[$key];
    }
    
    
    public function getRootDirectory()
    {
        $root = $this->get('root');
        if ()
    }

}