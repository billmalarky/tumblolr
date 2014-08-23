<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tumblolr</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo WEB_PATH ?>packages/bootstrap/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo WEB_PATH ?>css/main.css" media="all" />
    
    <script type="text/javascript" src="<?php echo WEB_PATH ?>packages/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo WEB_PATH ?>packages/bootstrap/js/bootstrap.min.js"></script>
    
    <?php /* Bootstrap Javascript */ ?>
    <script type="text/javascript">
        window.tumblolr = {};
    </script>
    <script type="text/javascript" src="<?php echo WEB_PATH ?>js/core.js"></script>
    <script type="text/javascript">
        window.tumblolr.CoreObj = new window.tumblolr.Core({
            "baseUrl": "<?php echo WEB_PATH ?>"
        });
    </script>
    <script type="text/javascript" src="<?php echo WEB_PATH ?>js/main.js"></script>
    
</head>
<body>
