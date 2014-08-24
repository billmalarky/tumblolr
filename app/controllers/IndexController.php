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
        
        //Init Get data and validate.
        $tag = (isset($this->parameters['tag'])) ? $this->parameters['tag'] : 'lol';
        $page = (isset($this->parameters['page'])) ? (int) $this->parameters['page'] : 1;
        if ($page < 1){
            $page = 1;
        }
        
        
        //Init Models
        $post = new Post();
        $pager = new Pager();
        
        //Init view data
        $data = [];
        $data['user'] = $this->user;
        $data['tag'] = $tag;
        $tumblrPosts = $post->getTaggedTumblrPosts($tag);
        
        //Paginate posts
        $data['tumblrPosts'] = $pager->paginatePosts($tumblrPosts, $page, 16);
        $data['pageCount'] = $pager->getPageCount($tumblrPosts, 16);
        $data['pages'] = $pager->getPagesArray($data['pageCount']);
        $data['pageNum'] = $page;
        
        //Load template
        $this->view->loadTemplate('home', $data);
        
    }
    
}