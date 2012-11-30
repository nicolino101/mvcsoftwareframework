<?php 
ini_set('error_reporting', E_ALL);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../Application'));

defined('MODULE_PATH')
|| define('MODULE_PATH', realpath(dirname(__FILE__) . '/../module'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
    
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

require_once '/autoloader.php';

/** Mvcs_Application */
require_once 'Mvcs/Application/Application.php';

// Create application, bootstrap, and run
$application = new \Mvcs\Application\Application();

$application->bootstrap()
                  ->run(); 