<?php

class Post extends Model
{
    
    /**
     * Get DB connection
     */
    public function __construct(){
        parent::__construct();
    }
    
    public function getUserInfo(){
        
        $tumblr = Tumblrinstance::getTumblrApiConnection();
        
        $userInfo = $tumblr->getUserInfo();
        
        return $userInfo;
        
    }
    
}