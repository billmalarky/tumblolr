<?php

class View
{
    
    protected $templatePath = null;
    
    public function __construct(){
        $this->templatePath = APP_PATH . 'views/';
    }
    
    public function loadTemplate($templateName, Array $data = array()){
        
        $filepath = $this->templatePath . strtolower($templateName) . '.php';
        
        if (is_readable($filepath) == false || is_file($filepath) == false) {
            throw new Exception($modelName . ' view template not found.');
            return false;
        }
        
        include($filepath);
        return true;
    }
    
}