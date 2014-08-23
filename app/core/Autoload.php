<?php
/**
 * This file sets up all the app model autoloading logic.
 */

//Set up autoloader function for native models.
function My_autoloader($className){
    $filename = ucfirst($className) . '.php';
    $filepath = APP_PATH . 'models/' . $filename;
    
    if (is_readable($filepath) == false || is_file($filepath) == false) {
        return false;
    }
    
    include_once($filepath);
}
//Set up library autoloader for psr-0 libraries.
function Lib_PSR_0_autoloader($className){
    
    $filepath = APP_PATH . 'lib/';
    $pathSections = explode('\\', $className);
    
    //First build directory path to class file, then append class file name.
    for ($i = 0; $i < (count($pathSections) - 1); $i++){
        $filepath .= $pathSections[$i] . '/';
    }
    $filepath .= $pathSections[$i+1] . '.php';
    
    if (is_readable($filepath) == false || is_file($filepath) == false) {
        return false;
    }
    
    include_once($filepath);
    
}
// Error handling autoload function to cleanly handle error reporting
function Error_autoloader($className){
    throw new Exception($className . ' class not found.');
    return false;
}
spl_autoload_register('My_autoloader');
spl_autoload_register('Lib_PSR_0_autoloader');
spl_autoload_register('Error_autoloader');
