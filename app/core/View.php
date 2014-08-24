<?php

class View
{
    
    protected $templatePath = null;
    
    public function __construct(){
        $this->templatePath = APP_PATH . 'views/';
    }
    
    public function loadTemplate($templateName, Array $data = array(), $contentOnly = false){
        
        $filepath = $this->templatePath . strtolower($templateName) . '.php';
        
        if (is_readable($filepath) == false || is_file($filepath) == false) {
            throw new Exception($modelName . ' view template not found.');
            return false;
        }
        
        if (!$contentOnly){
            include($this->templatePath . 'htmlheader.php');
            include($this->templatePath . 'header.php');
            include($this->templatePath . 'containertop.php');
        }
        
        //Include content
        include($filepath);
        
        if (!$contentOnly){
            include($this->templatePath . 'containerbottom.php');
            include($this->templatePath . 'footer.php');
            include($this->templatePath . 'htmlfooter.php');
        }
        
        return true;
    }
    
    /**
     * Used to create URLs inside views.
     * @param type $path
     * @param array $parameters
     */
    public function getUrl($path = '', Array $parameters = array()){
        
        $url = WEB_PATH;
        
        if ($path){
            $url .= $path;
        }
        
        foreach ($parameters as $key => $value){
            $url .= $key . '/' . $value . '/';
        }
        
        return $url;
        
    }
    
}