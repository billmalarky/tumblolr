<?php


class User extends Model
{
    
    protected $flashData = null;
    protected $session = null;
    
    public function __construct(){
        session_start();
        
        // Set flash data then clear from session.
        if (isset($_SESSION['flashData'])){
            $this->flashData = $_SESSION['flashData'];
            $_SESSION['flashData'] = null;
        }
        
        // Set session data to user object
        if (isset($_SESSION['session'])){
            $this->session = $_SESSION['session'];
        }
        
    }
    
    /**
     * Types of flash data:
     * 
     * $noticeType = alert-success, alert-warning, alert-info, alert-danger
     * message => array('status' => $noticeType, 'content' => 'message content')
     */
    public function setFlashData($key, $data){
        $_SESSION['flashData'][$key] = $data;
    }
    
    /**
     * Add generic data to the user's session.
     */
    public function setSessionData($key, $data){
        $_SESSION['session'][$key] = $data;
    }
    
    /**
     * Retrieve generic data from the user's session.
     */
    public function getSessionData($key){
        if (isset($this->session[$key])){
            return $this->session[$key];
        }
        else{
            return false;
        }
    }
    
    public function getFlashMessageStatus(){
        return (isset($this->flashData['message'])) ? $this->flashData['message']['status'] : false;
    }
    
    public function getFlashMessageContent(){
        return (isset($this->flashData['message'])) ? $this->flashData['message']['content'] : false;
    }
    
    /**
     * Determine when to show the app welcome message to user. User should only see it once per session.
     * @return boolean
     */
    public function showWelcomeMessage(){
        if ($this->getSessionData('welcomeMessage') === false){
            $this->setSessionData('welcomeMessage', 1);
            return true;
        }
        else{
            return false;
        }
    }
    
    /**
     * Sets the sort type to the user session.
     * 
     * @param string $sortType
     */
    public function setSortType($sortType){
        //Update sort value in session
        $this->setSessionData('sort', $sortType);
        
        $order = ($this->getSessionData('order')) ? $this->getSessionData('order'): 'desc';
        $orderText = ($order == 'desc') ? 'Descending' : 'Ascending';
        
        //Add success message to user's flash data.
        $this->setFlashData(
                'message', 
                array('status' => 'alert-success', 'content' => 'Order by ' . ucfirst($sortType) . ' ' .$orderText)
        );
        
    }
    
    /**
     * Sets the sort order to the user session.
     * 
     * @param string $sortType
     */
    public function toggleSortOrder(){
        
        //Get new order value
        $order = ($this->getSessionData('order')) ? $this->getSessionData('order'): 'desc';
        $newOrder = ($order == 'desc') ? 'asc' : 'desc';
        
        //Update order value in session
        $this->setSessionData('order', $newOrder);
        
        $sort = ($this->getSessionData('sort')) ? $this->getSessionData('sort'): 'date';
        $orderText = ($newOrder == 'desc') ? 'Descending' : 'Ascending';
        
        //Add success message to user's flash data.
        $this->setFlashData(
                'message', 
                array('status' => 'alert-success', 'content' => 'Order by ' . ucfirst($sort) . ' ' .$orderText)
        );
        
    }
    
}