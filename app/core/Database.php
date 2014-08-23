<?php
/**
 * Creates singleton database connection to share across models.
 */
class Database_Instance
{
    private static $db = null;
    
    public static function getDatabaseConnection(){
    	
        if (Database_Instance::$db === null){
            try{
                Database_Instance::$db = new PDO('mysql:host=127.0.0.1;dbname=tumblrtest', 'root', 'root');
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        return Database_Instance::$db;
        
    }
}