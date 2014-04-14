<?php
use TestBox\Framework\Loader\StandardAutoloader;
//include 'vendor/autoload.php';

require_once 'TestBox/Framework/Loader/StandardAutoloader.php';
$standardAutoloader = new StandardAutoloader();
$standardAutoloader->addNamespace('TestBox', __DIR__ . '/TestBox');
$standardAutoloader->addNamespace('TestBox\Console', __DIR__ . '/TestBox/Console');
$standardAutoloader->splRegister();

$consoleRoute = new TestBox\Console\Route($argv);

$workbench = new TestBox\Workbench\Workbench($rootDirectory);
$workbench->boostrap($initialConfig);