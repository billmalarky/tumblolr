<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tumblolr</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $this->getUrl() ?>packages/bootstrap/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->getUrl() ?>css/main.css" media="all" />
    
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>packages/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>packages/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>packages/pixlr/pixlr.js"></script>
    
    <?php /* Bootstrap Javascript */ ?>
    <script type="text/javascript">
        window.tumblolr = {};
    </script>
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>js/core.js"></script>
    <script type="text/javascript">
        window.tumblolr.CoreObj = new window.tumblolr.Core({
            "baseUrl": "<?php echo $this->getUrl() ?>"
        });
    </script>
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>js/tagform.js"></script>
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>js/sortform.js"></script>
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>js/imageeditor.js"></script>
    <script type="text/javascript" src="<?php echo $this->getUrl() ?>js/main.js"></script>
    
</head>
<body>
