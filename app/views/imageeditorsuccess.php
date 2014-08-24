<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->getUrl() ?>packages/bootstrap/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->getUrl() ?>css/sharemodal.css" media="all" />
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>packages/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>js/sharemodal.js"></script>
</head>
<body>
    <div class="share-on-tumblr-modal text-center">
        <div class="modal-buttons-container">
            <button id="shareOnTumblrButton" data-url="<?php echo $data['imageUrl'] ?>" data-title="<?php echo $data['imageTitle'] ?>" data-clickthru="http://tumblolr.com" type="button" class="btn btn-default btn-lg btn-success">Share on Tumblr</button>
            <button id="cancelShareOnTumblrButton" type="button" class="btn btn-default btn-lg btn-danger">Cancel</button>
        </div>
        <img alt="<?php echo $data['imageTitle'] ?>" src="<?php echo $data['imageUrl'] ?>">
    </div>
</body>
</html>