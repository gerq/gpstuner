<?php

session_start();

// load environment data, settings
require_once('configs/local.php');
//require_once('configs/staging.php');
//require_once('configs/live.php');

// load classes
function __autoload($className) {
	$found = false;
	if(is_readable(CONTROLLER_PATH . "/" . $className . "/" . $className . '.php')){
        include_once CONTROLLER_PATH . "/" . $className . "/" . $className . '.php';
        $found = true;
    }; 

    if(is_readable(CONTROLLER_PATH . "/" . $className . '.php')){
        include_once CONTROLLER_PATH . "/" . $className . '.php'; 
        $found = true;
    }

	if(is_readable(FORM_PATH . "/" . $className . '.php')){
          include_once FORM_PATH . "/" . $className . '.php';
          $found = true;
    } 

    if(is_readable(LIBRARY_PATH . "/models/" . $className . '.php')){
          include_once LIBRARY_PATH . "/models/" . $className . '.php';
          $found = true;
    } 

    if(is_readable(LIBRARY_PATH . "/utils/" . $className . '.php')){
          include_once LIBRARY_PATH . "/utils/" . $className . '.php';
          $found = true;
    }

    if(is_readable(LIBRARY_PATH . "/" . $className . '.php')){
          include_once LIBRARY_PATH . "/" . $className . '.php';
          $found = true;
    }

    if(!$found) {
    	trigger_error("CLASS NOT FOUND: " . $className, E_USER_ERROR);
    }
} 

// start booking index action
$booking = new Booking();
$booking->index();
