<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="<?php echo $charset; ?>">
        <title><?php echo $title; ?></title>
<?php if ($mobile === FALSE): ?>
        <!--[if IE 8]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
<?php else: ?>
        <meta name="HandheldFriendly" content="true">
<?php endif; ?>
<?php if ($mobile == TRUE && $mobile_ie == TRUE): ?>
        <meta http-equiv="cleartype" content="on">
<?php endif; ?>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="google" content="notranslate">
        <meta name="robots" content="noindex, nofollow">
<?php if ($mobile == TRUE && $ios == TRUE): ?>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="<?php echo $title; ?>">
<?php endif; ?>
<?php if ($mobile == TRUE && $android == TRUE): ?>
        <meta name="mobile-web-app-capable" content="yes">
<?php endif; ?>
        <link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAzUExURQAAAMQVG8QVG8QVG8QVG8MUGcQWHMQWHMQWHMQVGsQVG8QWHMMVG8QVG8QVGsMUGcQWHBiWaGEAAAAQdFJOUwAlilPupF/5xQsYM7racUEuThiQAAAA5klEQVQ4y+WTWXLEMAhE0YJAO/c/bYxkbM3kBsn7cqm7cLewAf4fxeX9kI1PvWIfeuSGN8ZpcY0kBoDJkYw4Xj0jiciAynLQXoOPepDAq88m9PDoY+mSchPpI6TNfDKEvkcmx3K+2Ji3vg3eGTbAPcHUQL0Z6PYFoWrcaRtO/Cq4gnPQnqk0+VVzFYgh46qZ+OE6Ry2gOg0ovAzg6s3kZahagDDDGp7O3TU17FCtgBnKTGGj0TzsAg7MkH00NNkE1ftcE1m+a9IV4UoQ071O7VKQ3mVj0UuO9lVUJp+herzxIf+Vf+UH6HQR34ampwcAAAAASUVORK5CYII=">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/ionicons/css/ionicons.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/adminlte.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/skins/skin-blue.min.css'); ?>">
<?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/animsition/animsition.min.css'); ?>">
<?php endif; ?>
<?php if ($this->router->fetch_class() == 'groups' && ($this->router->fetch_method() == 'create' OR $this->router->fetch_method() == 'edit')): ?>
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/colorpickersliders/colorpickersliders.min.css'); ?>">
<?php endif; ?>
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/domprojects/css/dp.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/jquery.fileupload/css/jquery.fileupload.css'); ?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/icheck/flat/blue.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/richtext.min.css'); ?>">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<?php if ($mobile === FALSE): ?>
        <!--[if lt IE 9]>
            <script src="<?php echo base_url($plugins_dir . '/html5shiv/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url($plugins_dir . '/respond/respond.min.js'); ?>"></script>
        <![endif]-->
<?php endif; ?>
        <script src="<?php echo base_url($frameworks_dir . '/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery.richtext.js'); ?>"></script>
        <!-- <script src="<?php echo base_url('js/brokenimage.js'); ?>"></script> -->
       <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
        <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script> 
        <!-- The Canvas to Blob plugin is included for image resizing functionality -->
        <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
        <script src="<?php echo base_url($frameworks_dir . '/jquery.fileupload/js/jquery.ui.widget.js'); ?>"></script>
        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <script src="<?php echo base_url($frameworks_dir . '/jquery.fileupload/js/jquery.iframe-transport.js'); ?>"></script>
        <!-- The basic File Upload plugin -->
        <script src="<?php echo base_url($frameworks_dir . '/jquery.fileupload/js/jquery.fileupload.js'); ?>"></script>
        <!-- The File Upload processing plugin -->
        <script src="<?php echo base_url($frameworks_dir . '/jquery.fileupload/js/jquery.fileupload-process.js'); ?>"></script>
        <!-- The File Upload image preview & resize plugin -->
        <script src="<?php echo base_url($frameworks_dir . '/jquery.fileupload/js/jquery.fileupload-image.js'); ?>"></script>
        <!-- The File Upload validation plugin -->
        <script src="<?php echo base_url($frameworks_dir . '/jquery.fileupload/js/jquery.fileupload-validate.js'); ?>"></script>
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
<?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
        <div class="wrapper animsition">
<?php else: ?>
        <div class="wrapper">
<?php endif; ?>
