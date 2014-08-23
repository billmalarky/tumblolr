<?php

class IndexController extends Controller
{
    
    public function __construct(User $user, Array $parameters = array(), $queryString, View $view){
        parent::__construct($user, $parameters, $queryString, $view);
    }
    
    public function test(){
        
        
        
        $data = [];
        $data['user'] = $this->user;
        $data['parameters'] = $this->parameters;
        $data['queryString'] = $this->queryString;
        
        //Add some flash data
        $this->user->setFlashData('message', array('status' => 'alert-success', 'content' => 'Welcome!'));
        
        $post = new Post();
        
        //$data['userInfo'] = $post->getUserInfo();
        $data['tumblrPosts'] = $post->getTaggedTumblrPosts($tag);
        
        var_dump($data);
        die();
        
        $this->view->loadTemplate('home', $data);
    }
    
    public function index(){
        
        //Init Get and Post data.
        $tag = (isset($_POST['tag'])) ? $_POST['tag']: 'lol';
        
        //Init Models
        $post = new Post();
        
        //Init view data
        $data = [];
        $data['user'] = $this->user;
        $data['tag'] = $tag;
        $data['tumblrPosts'] = $post->getTaggedTumblrPosts($tag);
        
        //Load template
        $this->view->loadTemplate('home', $data);
        
    }
    
}