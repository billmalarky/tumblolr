<?php

class IndexController extends Controller
{
    
    public function __construct(User $user, Array $parameters = array(), $queryString, View $view){
        parent::__construct($user, $parameters, $queryString, $view);
    }
    
    public function index(){
        
        //Init Get data
        $tag = (isset($this->parameters['tag'])) ? $this->parameters['tag'] : 'lol';
        $page = (isset($this->parameters['page'])) ? (int) $this->parameters['page'] : 1;
        $sort = ($this->user->getSessionData('sort')) ? $this->user->getSessionData('sort'): 'date';
        $order = ($this->user->getSessionData('order')) ? $this->user->getSessionData('order'): 'desc';
        
        //Init Models
        $post = new Post();
        $pager = new Pager();
        $postSorter = new Postsorter($sort, $order);
        
        //Init view data
        $data = [];
        $data['user'] = $this->user;
        $data['tag'] = $tag;
        $totalPosts = $post->getTaggedTumblrPosts($tag);
        
        //Order Posts
        $sortedPosts = $postSorter->sortPosts($totalPosts);
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['orderToggle'] = ($order == 'desc') ? 'asc': 'desc';
        
        //Paginate posts
        $data['tumblrPosts'] = $pager->paginatePosts($sortedPosts, $page, 16);
        $data['pageCount'] = $pager->getPageCount($totalPosts, 16);
        $data['pages'] = $pager->getPagesArray($data['pageCount']);
        $data['pageNum'] = $page;
        
        //Load template
        $this->view->loadTemplate('home', $data);
        
    }
    
}