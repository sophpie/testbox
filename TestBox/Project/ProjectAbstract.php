<?php
namespace TestBox\Project;

abstract class ProjectAbstract implements ProjectInterface
{
    /**
     * Working directory of project
     * 
     * @var string
     */
    protected $workingDirectory;
    
    protected $workbench;
    
    protected $boxes;
    
    protected $scenarios;
    
    protected $report;
    
    /**
     * 
     * @param unknown $workingDirectory
     */
    public function __construct($workingDirectory)
    {
        $this->setWorkingDirectory($workingDirectory);
        if (method_exists($this, 'init')) $this->init();
    }
    
	/**
     * @return the $workingDirectory
     */
    public function getWorkingDirectory()
    {
        return $this->workingDirectory;
    }

	/**
     * @return the $workbench
     */
    public function getWorkbench()
    {
        return $this->workbench;
    }

	/**
     * @return the $boxes
     */
    public function getBoxes()
    {
        return $this->boxes;
    }

	/**
     * @return the $scenarios
     */
    public function getScenarios()
    {
        return $this->scenarios;
    }

	/**
     * @return the $report
     */
    public function getReport()
    {
        return $this->report;
    }

	/**
     * @param field_type $workingDirectory
     */
    public function setWorkingDirectory($workingDirectory)
    {
        $this->workingDirectory = $workingDirectory;
    }

	/**
     * @param field_type $workbench
     */
    public function setWorkbench($workbench)
    {
        $this->workbench = $workbench;
    }

	/**
     * @param field_type $boxes
     */
    public function setBoxes($boxes)
    {
        $this->boxes = $boxes;
    }

	/**
     * @param field_type $scenarios
     */
    public function setScenarios($scenarios)
    {
        $this->scenarios = $scenarios;
    }

	/**
     * @param field_type $report
     */
    public function setReport($report)
    {
        $this->report = $report;
    }

    
    
    
}