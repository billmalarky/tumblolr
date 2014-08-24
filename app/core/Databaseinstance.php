<?php
/**
 * Creates singleton database connection to share across models.
 */
class Databaseinstance
{
    private static $db = null;
    
    public static function getDatabaseConnection(){
    	
        if (Databaseinstance::$db === null){
            try{
                Databaseinstance::$db = new PDO('mysql:host=127.0.0.1;dbname=tumblolr', 'root', '');
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        
        return Databaseinstance::$db;
        
    }
}