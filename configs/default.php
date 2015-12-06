<?php

// app path
define("APPLICATION_PATH", getcwd());
define("LIBRARY_PATH", APPLICATION_PATH . "/library");
define("CONTROLLER_PATH", APPLICATION_PATH . "/controllers");
define("FORM_PATH", APPLICATION_PATH . "/forms");
define("VIEW_PATH", APPLICATION_PATH . "/views");

// errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// database
const DB_DATABASE = "booking";
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "root";

// date
const DATE_FORMAT = "Y.m.d H:i:s";