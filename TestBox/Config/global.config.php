<?php
return array(
    'workbench' => array(
        'environments' => array(
            'serviceClass' => 'Factory',
            'options' => array(
                'factory' => 'TestBox\Environment\EnvironmentManagerFactory',
            ),
        ),
        'assertionManager' => array(
            'serviceClass' => 'Factory',
            'options' => array(
                'factory' => 'TestBox\Assertion\AssertionManagerFactory',
            )
        ),
        'report' => array(
            'serviceClass' => 'Constructor',
            'options' => array(
                'class' => 'TestBox\Report\Console\ConsoleReport',
            )
        ),
        'dataInjectorManager' => array(
            'serviceClass' => 'Factory',
            'options' => array(
                'factory' => 'TestBox\DataInjector\DataInjectorManagerFactory',
            )
        ),
    ),
    'assertion_manager' => array(
        'assertTrue' => array(
            'serviceClass' => 'Constructor',
            'options' => array(
                'class' => '\TestBox\Assertion\Boolean\AssertTrue'
            )
        ),
        'assertFalse' => array(
            'serviceClass' => 'Constructor',
            'options' => array(
                'class' => '\TestBox\Assertion\Boolean\AssertFalse'
            )
        ),
        'assertEquals' => array(
            'serviceClass' => 'Constructor',
            'options' => array(
                'class' => '\TestBox\Assertion\Comparison\AssertEquals'
            )
        ),
    ),
    
    'data_injectors' => array(
	   'datacsv' => array(
            'serviceClass' => 'ConfigurableConstructor',
	        'options' => array(
	   	       'class' => 'TestBox\DataInjector\CsvDataInjector',
	           'parameter' => '',
	        ),    	
        ),
    ),
);