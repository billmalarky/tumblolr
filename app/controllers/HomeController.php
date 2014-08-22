<?php

class HomeController extends Controller
{
    
    public function __construct(User $user, Array $parameters = array(), View $view){
        parent::__construct($user, $parameters, $view);
    }
    
    public function index(){
        
        $data = [];
        
        $test = new Test();
        
        $data['test'] = $test->test();
        
        $this->view->loadTemplate('home', $data);
    }
    
}