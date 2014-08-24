<?php if ($data['user']->showWelcomeMessage()): ?>
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h3>Welcome to Tumblolr where we display tagged posts from tumblr for easy editing</h3>
        <p>Enter a tag to see posts from tumblr with that tag.</p>
    </div>
<?php endif; ?>
<form id="tagForm" class="form-inline" role="form">
  <div class="form-group">
    <label class="sr-only" for="postTagInput">Post Tag</label>
    <input type="text" name="tag" class="form-control" id="postTagInput" placeholder="Enter Post Tag">
  </div>
  <button id="tagFormSubmitButton" type="submit" class="btn btn-default">Load Tagged Posts</button>
</form>
<h3>Showing posts tagged with <?php echo $data['tag'] ?></h3>
<div class="posts">
    <?php if (isset($data['tumblrPosts']) && count($data['tumblrPosts']) > 0): ?>
        <?php foreach ($data['tumblrPosts'] as $post): ?>
            <div class="post">
                <h5>
                    <a target="_blank" href="<?php echo $post->post_url ?>">
                        <?php echo $post->blog_name ?>
                        <?php if (isset($post->title)){echo ' | ' . $post->title;}?>
                        <?php if (isset($post->source_title)){echo ' | ' . $post->source_title;}?>
                    </a>
                </h5>
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
                                    <div class="tumblr-post-photo-image">
                                        <img width="500" src="<?php echo $photo->original_size->url ?>">
                                    </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
    <p>Sorry. There are no posts with the "<?php echo $data['tag'] ?>" tag.</p>
    <?php endif; ?>
</div>

