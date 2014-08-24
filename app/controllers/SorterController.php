<?php

class SorterController extends Controller
{
    
    public function __construct(User $user, Array $parameters = array(), $queryString, View $view){
        parent::__construct($user, $parameters, $queryString, $view);
    }
    
    /**
     * Redirect index requests to homepage.
     */
    public function index(){
        header('Location: ' . $this->view->getUrl());
    }
    
    /**
     * Access point to manipulate sorting on user's session.
     */
    public function reorder(){
        
        if (
            isset($this->parameters['sort']) 
            && ($this->parameters['sort'] == 'date' || $this->parameters['sort'] == 'notes')
        ){
            //Set the sort type in user's session.
            $this->user->setSortType($this->parameters['sort']);
            
            //Redirect to home.
            header('Location: ' . $this->view->getUrl());
            
        }
        else if (
            isset($this->parameters['order']) 
            && $this->parameters['order'] == 'toggle'
        ){
            //Toggle the sort order in user's session.
            $this->user->toggleSortOrder();
            
            //Redirect to home.
            header('Location: ' . $this->view->getUrl());
            
        }
        else{
            
            //Add failure warning message flash data and redirect to home.
            $this->user->setFlashData('message', array('status' => 'alert-danger', 'content' => 'Failed to set sort type. Please try again.'));
            header('Location: ' . $this->view->getUrl());
            
        }
        
    }
    
    
    
}