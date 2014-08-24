<?php
/**
 * Pagination logic.
 */
class Pager
{
    
    public function paginatePosts(Array $posts, $page, $pageLimit = 16){
        $offset = ($page - 1) * 16;
        $posts = array_slice($posts, $offset, $pageLimit);
        return $posts;
    }
    
    public function getPageCount(Array $posts, $pageLimit = 16){
        return ceil(count($posts) / $pageLimit);
    }
    
    public function getPagesArray($pageCount = 1){
        if ($pageCount > 0){
            return range(1, $pageCount);
        }
        else{
            return array(0=>1);
        }
    }
    
}