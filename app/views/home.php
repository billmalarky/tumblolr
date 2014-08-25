<?php if ($data['user']->showWelcomeMessage()): ?>
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h3>Welcome to Tumblolr where we display tagged posts from tumblr for easy editing</h3>
        <p>Enter a tag to see posts from tumblr with that tag.</p>
    </div>
<?php endif; ?>
<div id="tagForm" class="form-inline" role="form">
  <div class="form-group">
    <label class="sr-only" for="postTagInput">Post Tag</label>
    <input type="text" name="tag" class="form-control" id="postTagInput" placeholder="Enter Post Tag">
  </div>
  <button id="tagFormSubmitButton" type="button" class="btn btn-default">Load Tagged Posts</button>
</div>
<div class="sorting-buttons-container">
    <button id="sortTypeButton" data-sort="date" type="button" class="btn btn-default<?php if($data['sort']=='date'){echo ' disabled';} ?>">Sort By Date</button>
    <button id="sortTypeButton" data-sort="notes" type="button" class="btn btn-default<?php if($data['sort']=='notes'){echo ' disabled';} ?>">Sort By Notes</button>
    <button id="orderToggleButton" type="button" class="btn btn-default">Toggle Order</button>
</div>
<h3>Showing posts tagged with <?php echo $data['tag'] ?></h3>
<div class="posts">
    <?php if (isset($data['tumblrPosts']) && count($data['tumblrPosts']) > 0): ?>
        <?php foreach ($data['tumblrPosts'] as $post): ?>
            <div class="post">
                <h4>
                    <a target="_blank" href="<?php echo $post->post_url ?>">
                        <span class="tumblr-post-blog-name"><?php echo $post->blog_name ?></span>
                        <?php if (isset($post->title)){echo ' | ' . $post->title;}?>
                        <?php if (isset($post->source_title)){echo ' | ' . $post->source_title;}?>
                    </a>
                </h4>
                <?php if (isset($post->date) || isset($post->note_count)): ?>
                    <h5>
                        <?php if (isset($post->date)){echo $post->date;} ?>
                        <?php if (isset($post->date) && isset($post->note_count)){echo ' | ';} ?>
                        <?php if (isset($post->note_count)){echo $post->note_count . ' notes';} ?>
                    </h5>
                <?php endif; ?>
                <?php if (isset($post->body)): ?>
                    <div class="tumblr-post-body"><?php echo $post->body ?></div>
                <?php endif; ?>
                <?php if (isset($post->photos) && count($post->photos) > 0): ?>
                    <div class="tumblr-post-photos">
                        <?php foreach ($post->photos as $photo): ?>
                            <div class="tumblr-post-photo">
                                <?php if (!empty($photo->caption)): ?>
                                    <div class="tumblr-post-photo-caption"><?php echo $photo->caption ?></div>
                                <?php endif; ?>
                                    <div class="tumblr-post-photo-image-container">
                                        <img class="tumblr-post-photo-image" width="500" src="<?php echo $photo->original_size->url ?>">
                                    </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Sorry. There are no <?php if($data['pageNum']>1){echo 'more ';} ?>posts with the "<?php echo $data['tag'] ?>" tag.</p>
    <?php endif; ?>
    <div class="pagination-container">
        <ul class="pagination">
            <li class="<?php if ($data['pageNum'] <= 1){echo 'disabled';} ?>">
                <a href="<?php if($data['pageNum'] <= 1){echo 'javascript:void(0)';}else{echo $this->getUrl('index/index/', array('tag'=>$data['tag'],'page'=>$data['pageNum']-1));} ?>">&laquo;</a>
            </li>
            <?php foreach ($data['pages'] as $pageNumber): ?>
                <li class="<?php if ($data['pageNum'] == $pageNumber){echo 'active';} ?>">
                    <a href="<?php if($data['pageNum'] == $pageNumber){echo 'javascript:void(0)';}else{echo $this->getUrl('index/index/', array('tag'=>$data['tag'],'page'=>$pageNumber));} ?>">
                        <?php echo $pageNumber ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <li class="<?php if ($data['pageNum'] >= $data['pageCount']){echo 'disabled';} ?>">
                <a href="<?php if($data['pageNum'] >= $data['pageCount']){echo 'javascript:void(0)';}else{echo $this->getUrl('index/index/',array('tag'=>$data['tag'],'page'=>$data['pageNum']+1));} ?>">&raquo;</a>
            </li>
        </ul>
    </div>
</div>

