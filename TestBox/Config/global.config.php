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
    )
);