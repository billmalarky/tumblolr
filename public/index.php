<?php
/**
 * Bootstrap the tumblr test app
 */

//Define Global Constants
define('ROOT_PATH', realpath(__DIR__.'/../') . '/');
define('APP_PATH', realpath(__DIR__.'/../app/') . '/');

//Include Core Classes and Files
include(APP_PATH . 'core/Database.php');
include(APP_PATH . 'core/Model.php');
include(APP_PATH . 'core/View.php');
include(APP_PATH . 'core/Controller.php');
include(APP_PATH . 'core/Router.php');
include(APP_PATH . 'core/User.php');
include(APP_PATH . 'core/Autoload.php');

//Begin routing
$router = new Router($_SERVER['REQUEST_URI']);

//Load Controller
$router->loadController(new User(), new View());

