<?php

abstract class Model
{
    
    protected $db;
    
    public function __construct(){
        $this->db = Database_Instance::getDatabaseConnection();
    }
    
    
}