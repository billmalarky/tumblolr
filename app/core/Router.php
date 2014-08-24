<?php

class Router
{
    
    protected $controller;
    protected $actionMethod;
    protected $queryString = null;
    protected $parameters = array();
    
    public function __construct($route){
        
        //Clean up route.
        $route = trim(strtolower($route), '/');
        
        //If route is empty default to index controller index action method, else run routing logic.
        if (empty($route)){
            $this->controller = 'index';
            $this->actionMethod = 'index';
        }
        else{
            
            //Extract query string if exists
            if (strpos($route, '?') !== false){
                $queryExplodeRt = explode('?',$route);
                $route = array_shift($queryExplodeRt);
                $this->queryString = implode($queryExplodeRt);
            }
            
            //Get controller, action method, and parameters pieces.
            //Validate that $route is not empty. If it is, set controller and action method to default (index).
            if (trim($route) !== ''){
                $routeArr =  explode('/',$route);
            }
            else{
                $routeArr = array();
                $this->controller = 'index';
                $this->actionMethod = 'index';
            }
            
            
            //Set controller, action method, and any included get parameters.
            if (!empty($routeArr)){
                $controllerFragment = array_shift($routeArr);
                $controllerFragmentArr = explode('.',$controllerFragment); //Trim off extraneous file extensions
                $controller = reset($controllerFragmentArr);
                $this->controller = $controller;
            }
            if (!empty($routeArr)){
                $actionMethodFragment = array_shift($routeArr);
                $actionMethodFragmentArr = explode('.',$actionMethodFragment);//Trim off extraneous file extensions
                $actionMethod = reset($actionMethodFragmentArr); 
                $this->actionMethod = $actionMethod;
            }
            while (!empty($routeArr)){
                
                $paramKey = array_shift($routeArr);
                $paramValue = array_shift($routeArr);
                
                if (isset($paramKey) && isset($paramValue)){
                    $this->parameters[$paramKey] = $paramValue;
                }
                
            }
        }
        
    }
    
    public function loadController(User $user, View $view){
        
        $controllerName = ucfirst($this->controller) . 'Controller';
        $controllerPath = APP_PATH . 'controllers/' . $controllerName . '.php';
        //Load class and instantiate controller
        if (is_readable($controllerPath) && is_file($controllerPath)){
            include($controllerPath);
            $controller = new $controllerName($user, $this->parameters, $this->queryString, $view);
        }
        else{
            //If controller doesn't exist or can't be read, send 404 status code.
            header("HTTP/1.0 404 Not Found");
            die();
        }
        
        //Call controller action method. If method doesn't exist, default to index action method.
        if (is_callable(array($controller, $this->actionMethod))){
            $controller->{$this->actionMethod}();
        }
        else{
            $controller->index();
        }
        
    }
    
}