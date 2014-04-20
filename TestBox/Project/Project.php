<?php
namespace TestBox\Project;

use TestBox\Project\ProjectAbstract;

class Project extends ProjectAbstract
{
    /**
     * Initiate a new project
     */
    protected function init()
    {
        if ( ! is_dir($this->workingDirectory)) $this->makeWorkingDirectory();
    }
    
    /**
     * Make working directory
     */
    protected function makeWorkingDirectory()
    {
        mkdir($this->workingDirectory,755,true);
    }
}