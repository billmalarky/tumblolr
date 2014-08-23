<?php


class User extends Model
{
    
    public $flashData = null;
    
    public function __construct(){
        session_start();
        
        // Set flash data then clear from session.
        if (isset($_SESSION['flashData'])){
            $this->flashData = $_SESSION['flashData'];
            $_SESSION['flashData'] = null;
        }
        
    }
    
    /**
     * Types of flash data:
     * 
     * $noticeType = alert-success, alert-warning, alert-info, alert-danger
     * message => array('status' => $noticeType, 'content' => 'message content')
     */
    public function addFlashData($key, $data){
        $_SESSION['flashData'][$key] = $data;
    }
    
    public function getFlashMessageStatus(){
        return (isset($this->flashData['message'])) ? $this->flashData['message']['status'] : false;
    }
    
    public function getFlashMessageContent(){
        return (isset($this->flashData['message'])) ? $this->flashData['message']['content'] : false;
    }
    
}