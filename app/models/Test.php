<?php

class Test extends Model
{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function test(){
        
        return 'we are connected';
        
    }
    
}