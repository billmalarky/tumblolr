<?php

class IndexController extends Controller
{
    
    public function __construct(User $user, Array $parameters = array(), $queryString, View $view){
        parent::__construct($user, $parameters, $queryString, $view);
    }
    
    public function index(){
        
        $data = [];
        $data['user'] = $this->user;
        $data['parameters'] = $this->parameters;
        $data['queryString'] = $this->queryString;
        
        //Add some flash data
        $this->user->addFlashData('message', array('status' => 'alert-success', 'content' => 'Welcome!'));
        
        $post = new Post();
        
        $data['userInfo'] = $post->getUserInfo();
        
        var_dump($data);
        die();
        
        $this->view->loadTemplate('home', $data);
    }
    
}