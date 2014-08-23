<?php

class HomeController extends Controller
{
    
    public function __construct(User $user, Array $parameters = array(), View $view){
        parent::__construct($user, $parameters, $view);
    }
    
    public function index(){
        
        $data = [];
        $data['user'] = $this->user;
        
        //Add some flash data
        $this->user->addFlashData('message', array('status' => 'alert-success', 'content' => 'Welcome!'));
        
        $post = new Post();
        
        $data['userInfo'] = $post->getUserInfo();
        
        var_dump($data['userInfo']);
        die();
        
        $this->view->loadTemplate('home', $data);
    }
    
}