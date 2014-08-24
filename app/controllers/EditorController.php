<?php

class EditorController extends Controller
{
    
    public function __construct(User $user, Array $parameters = array(), $queryString, View $view){
        parent::__construct($user, $parameters, $queryString, $view);
    }
    
    public function index(){
        header('Location: ' . $this->view->getUrl());
    }
    
    public function success(){
        
        $data = [];
        $data['imageUrl'] = $_GET['image'];
        $data['imageType'] = $_GET['type'];
        $data['imageTitle'] = $_GET['title'];
        $data['imageState'] = $_GET['state'];
        
        //Load template content only
        $this->view->loadTemplate('imageeditorsuccess', $data, true);
        
    }
    
    public function quit(){
        
        //Load template content only
        $this->view->loadTemplate('imageeditorquit', array(), true);
        
    }
    
}