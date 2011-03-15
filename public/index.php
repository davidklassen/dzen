<?php

error_reporting(E_ALL);

defined('__DIR__') || define('__DIR__', dirname(__FILE__));

// Set path to application directory
define('APPLICATION_PATH', realpath(__DIR__ . '/../application'));

// Set path to library directory
define('LIBRARY_PATH', realpath(__DIR__ . '/../library'));

set_include_path(implode(PATH_SEPARATOR, array(
    APPLICATION_PATH,
    LIBRARY_PATH,
    get_include_path(),
)));

require_once 'application.php';

$application = new Application();

$application->bootstrap()
            ->run();
