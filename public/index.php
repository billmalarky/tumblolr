<?php
/**
 * Bootstrap the tumblr test app
 */

//Define Global Constants
define('ROOT_PATH', realpath(__DIR__.'/../') . '/');
define('APP_PATH', realpath(__DIR__.'/../app/') . '/');

//Include Core Classes
//include(APP_PATH . 'core/Session.php'); depricated?
include(APP_PATH . 'core/Model.php'); //Database connection held in core model abstract class. user root pass root expected.
include(APP_PATH . 'core/View.php');
include(APP_PATH . 'core/Controller.php');
include(APP_PATH . 'core/Router.php');
include(APP_PATH . 'core/User.php');

//Set up model autoloader
function My_autoloader($modelName){
    $filename = ucfirst($modelName) . '.php';
    $filepath = APP_PATH . 'models/' . $filename;
    
    if (is_readable($filepath) == false || is_file($filepath) == false) {
        throw new Exception($modelName . ' class not found.');
        return false;
    }
    
    include_once($filepath);
}

spl_autoload_register('My_autoloader');

//Begin routing
$router = new Router($_SERVER['REQUEST_URI']);

//Load Controller
$router->loadController(new User(), new View());

