<?php
/**
 * Creates singleton tumblr api connection to share across models.
 */
class Tumblrinstance
{
    private static $api = null;
    
    //Tumblr App Keys
    const CONSUMER_KEY = 'ogLbxvXn8wH7VICAcP5m6LdAGOGb7d1WEkGEqTawoiwxnlAIBY';
    const CONSUMER_SECRET = 'PQwoQiyzdskJd1kYd7awifSnMmQ1ATvJNtUCX7u7RYfNsDNmA7';
    
    //Tumblr User Keys (hardcoded for user reidmayo@gmail.com)
    const TOKEN = 'YbG0AUW4CasEqoLylb7jC8ZQSaora8Qkg5i8hbDUjQpZVZCh2k';
    const TOKEN_SECRET = 'FlwtvnfuqgjatWgQfKkqoq8gcKMqnYMLwgHy7VEXkmsv7pbztH';
    
    public static function getTumblrApiConnection(){
    	
        if (Tumblrinstance::$api === null){
            Tumblrinstance::$api = new Tumblr\API\Client(CONSUMER_KEY, CONSUMER_SECRET, TOKEN, TOKEN_SECRET);
        }
        
        return Tumblrinstance::$api;
        
    }
}