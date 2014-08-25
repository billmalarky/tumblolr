<?php
/**
 * Post sorting logic.
 */
class Postsorter
{
    
    protected $sort;
    protected $order;
    
    public function __construct($sort = 'date', $order = 'desc'){
        $this->sort = $sort;
        $this->order = $order;
    }
    
    public function sortPosts(Array $posts){
        
        if ($this->sort == 'date'){
            $posts = $this->sortPostsByDate($posts);
        }
        else{
            $posts = $this->sortPostsByNotes($posts);
        }
        
        return $posts;
    }
    
    protected function sortPostsByDate(Array $posts){
        
        if ($this->order == 'desc'){
            usort($posts, function($a, $b){
                if ($a->timestamp == $b->timestamp){
                    return 0;
                }
                else{
                    return ($a->timestamp > $b->timestamp) ? -1 : 1;
                }
            });
        }
        else{
            usort($posts, function($a, $b){
                if ($a->timestamp == $b->timestamp){
                    return 0;
                }
                else{
                    return ($a->timestamp < $b->timestamp) ? -1 : 1;
                }
            });
        }
        
        return $posts;
        
    }
    
    protected function sortPostsByNotes(Array $posts){
        
        if ($this->order == 'desc'){
            usort($posts, function($a, $b){
                if ($a->note_count == $b->note_count){
                    return 0;
                }
                else{
                    return ($a->note_count > $b->note_count) ? -1 : 1;
                }
            });
        }
        else{
            usort($posts, function($a, $b){
                
                //It appears not all posts have note counts? Recieved undefined error here a few times.
                if (!isset($a->note_count)){
                    $a->note_count = 0;
                }
                if (!isset($b->note_count)){
                    $b->note_count = 0;
                }
                
                if ($a->note_count == $b->note_count){
                    return 0;
                }
                else{
                    return ($a->note_count < $b->note_count) ? -1 : 1;
                }
            });
        }
        
        return $posts;
        
    }
    
}