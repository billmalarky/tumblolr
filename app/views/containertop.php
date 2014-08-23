<div class="container">
    <?php if(1): ?>
        <div class="alert alert-dismissable <?php if($status = $data['user']->getFlashMessageStatus()){echo $status;} ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><?php if($content = $data['user']->getFlashMessageContent()){echo $content;} ?></p>
        </div>
    <?php endif; ?>