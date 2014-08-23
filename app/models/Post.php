<?php

class Post extends Model
{
    
    /**
     * Get DB connection
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function getTaggedTumblrPosts($tag){
        
        $tumblr = Tumblrinstance::getTumblrApiConnection();
        
        $options = array(
            'limit' => 20
        );
        
        $result = $tumblr->getTaggedPosts($tag, $options);
        
        return $result;
        
    }
    
    public function getUserInfo(){
        
        $tumblr = Tumblrinstance::getTumblrApiConnection();
        
        $userInfo = $tumblr->getUserInfo();
        
        return $userInfo;
        
    }
    
}