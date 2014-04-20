<?php
namespace TestBox\Project;

interface ProjectInterface
{
    /**
     * Constructor
     *
     * @param string $workingDirectory
     */
    public function __construct($workingDirectory);
}