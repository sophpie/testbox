<?php
return array(
	'assertion_manager' => array(
        'assertTrue' => array(
	       'serviceClass' => 'Constructor',
	       'options' => array('class' => '\TestBox\Assertion\Boolean\AssertTrue'),
	    ),
        'assertFalse' => array(
            'serviceClass' => 'Constructor',
            'options' => array('class' => '\TestBox\Assertion\Boolean\AssertFalse'),
        ),
    ),
);