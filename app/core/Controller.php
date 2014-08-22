<?php

abstract class Controller
{
    
    protected $user;
    protected $parameters;
    protected $view;
    
    public function __construct(User $user, Array $parameters = array(), View $view){
        $this->user = $user;
        $this->parameters = $parameters;
        $this->view = $view;
    }
    
    //All controllers must have an index action method
    abstract public function index();
    
}