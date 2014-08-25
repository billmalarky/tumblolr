<?php

class HelpController extends Controller
{
    
    public function __construct(User $user, Array $parameters = array(), $queryString, View $view){
        parent::__construct($user, $parameters, $queryString, $view);
    }
    
    public function index(){
        header('Location: ' . $this->view->getUrl());
    }
    
    public function photoediting(){
        
        //Init view data
        $data = [];
        $data['user'] = $this->user;
        
        //Load template
        $this->view->loadTemplate('photoediting', $data);
        
    }
    
}