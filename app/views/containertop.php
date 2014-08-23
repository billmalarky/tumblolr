<div class="container text-center">
    <?php if($status = $data['user']->getFlashMessageStatus()): ?>
        <div class="alert alert-dismissable <?php echo $status ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><?php if($content = $data['user']->getFlashMessageContent()){echo $content;} ?></p>
        </div>
    <?php endif; ?>