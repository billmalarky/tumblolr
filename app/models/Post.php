<?php

class Post extends Model
{
    
    /**
     * Get DB connection
     */
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * This gets our 100 posts. First we check the database to see if we have any recent posts with that tag,
     * then if we don't have any recent posts saved locally we hit the tumblr api enough times to get 100 posts
     * and then save those posts in the database.
     * 
     * Default timeout limit for tags is set to 30 minutes. So the feed will only update from the tumblr api
     * every 30 minutes once the posts have been cached in the DB.
     * 
     * This helps site performance and also rate limits us from hitting tumblr's API too much.
     * @param type $tag
     * @return type
     */
    public function getTaggedTumblrPosts($tag){
        
        //Check if there are recent posts in the DB with this tag
        $freshDate = new DateTime(date('Y-m-d H:i:s'));
        $freshDate->sub(new DateInterval('PT30M'));
        
        $dbPosts = $this->getDbTaggedPosts($tag, $freshDate, 100, true);
        
        if ($dbPosts && count($dbPosts) >= 100){
            return $dbPosts;
        }
        else{
            
            //Get the posts from tumblr
            $posts = $this->getTumblrApiTaggedPosts($tag, 100);
            
            //Save tumblr posts to DB for caching
            $this->saveTumblrPostsToDb($tag, $posts);
            
            return $posts;
            
        }
        
    }
    
    /**
     * This gets posts tagged with $tag that have been saved in DB at least
     * after $freshDate. $limit sets up to how many records to return and
     * $convertTumblrFormat converts the result set into the same format that
     * the tumblr API returns natively.
     * 
     * @param string $tag
     * @param DateTime $freshDate
     * @param int $limit
     * @param boolean $convertTumblrFormat
     * @return boolean
     */
    protected function getDbTaggedPosts($tag, DateTime $freshDate, $limit = 100, $convertTumblrFormat = false){
        
        $query = $this->db->prepare('SELECT * FROM posts WHERE tag = ? AND created_at > ? AND deleted_at IS NULL LIMIT ?');
        
        //We have to manually bind the params in order to pass the limit (int) value due to emulate prepares.
        $query->bindParam(1, $tag, PDO::PARAM_STR);
        $freshDateString = $freshDate->format('Y-m-d H:i:s');
        $query->bindParam(2, $freshDateString, PDO::PARAM_STR);
        $query->bindParam(3, $limit, PDO::PARAM_INT);
        
        $query->execute();
        
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        
        if ($result){
            
            //If $convertTumblrFormat, convert the PDO multi-dimensional array into an array of
            // objects similar to the result the tumblr api provides.
            if ($convertTumblrFormat){
                $result = $this->convertToTumblrFormat($result);
            }
            
            return $result;
        }
        else{
            return false;
        }
        
    }
    
    /**
     * convert the PDO multi-dimensional data array into an array of objects 
     * similar to the result the tumblr api provides.
     * 
     * @param array $data
     * @return array
     */
    protected function convertToTumblrFormat(Array $data){
        foreach($data as $key => $record){
            $data[$key] = json_decode($record['post_data']);
        }
        return $data;
    }
    
    /**
     * This function grabs up to $limit number of posts that are tagged with $tag
     * from the tumblr api in batches of at most 20.
     * 
     * @param string $tag
     * @param int $limit
     * @return Array $posts
     */
    protected function getTumblrApiTaggedPosts($tag, $limit = 100){
        
        //Get shared tumblr api connection
        $tumblr = Tumblrinstance::getTumblrApiConnection();
        
        //Set default options
        $options = array(
            'limit' => 20
        );
        
        $posts = [];
        $timeout = 0;
        do {
            
            //Set before option to timestamp of last result array object if result exists.
            if (isset($result) && count($result) > 0){
                $lastResultObject = end($result);
                $options['before'] = $lastResultObject->timestamp;
            }
            
            $result = $tumblr->getTaggedPosts($tag, $options);
            $posts = array_merge($posts, $result);
            
            $timeout++;
        } while (count($posts) < $limit && $result && $timeout <= 5);
        
        return $posts;
        
    }
    
    /**
     * Saves the posts to the DB for caching/performance/rate limiting reasons.
     * @param array $posts
     */
    protected function saveTumblrPostsToDb($tag, Array $posts){
        
        $return = true;
        
        foreach ($posts as $post){
            $query = $this->db->prepare('INSERT INTO posts (tag, post_data, created_at, updated_at) VALUES (:tag,:postdata,:createdat,:updatedat)');
            
            $dateTime = new DateTime(date('Y-m-d H:i:s'));
            
            $binds = array(
                ':tag' => $tag,
                ':postdata' => json_encode($post),
                ':createdat' => $dateTime->format('Y-m-d H:i:s'),
                ':updatedat' => $dateTime->format('Y-m-d H:i:s'),
            );
            
            $result = $query->execute($binds);
            
            if (!$result){
                $return = false;
            }
        }
        
        return $return;
        
    }
    
    public function getUserInfo(){
        
        $tumblr = Tumblrinstance::getTumblrApiConnection();
        
        $userInfo = $tumblr->getUserInfo();
        
        return $userInfo;
        
    }
    
}