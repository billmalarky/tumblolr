<?php

abstract class Model
{
    
    protected $db;
    
    public function __construct(){
        
        // Get Singleton Database connection to share across models.
        try{
            $this->db = new PDO('mysql:host=127.0.0.1;dbname=tumblrtest', 'root', 'root');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
    }
    
    
}