<?php


class User extends Model
{
    
    public $userId = null;
    
    public function __construct(){
        session_start();
        
        if (isset($_SESSION['userId'])){
            $this->userId = $_SESSION['userId'];
        }
        
    }
    
    public function isLoggedIn(){
        if (isset($this->userId)){
            return true;
        }
        else{
            return false;
        }
    }
    
}