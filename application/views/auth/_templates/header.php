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
<?php endif; ?>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="google" content="notranslate">
        <meta name="robots" content="noindex, nofollow">
        <link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAzUExURQAAAMQVG8QVG8QVG8QVG8MUGcQWHMQWHMQWHMQVGsQVG8QWHMMVG8QVG8QVGsMUGcQWHBiWaGEAAAAQdFJOUwAlilPupF/5xQsYM7racUEuThiQAAAA5klEQVQ4y+WTWXLEMAhE0YJAO/c/bYxkbM3kBsn7cqm7cLewAf4fxeX9kI1PvWIfeuSGN8ZpcY0kBoDJkYw4Xj0jiciAynLQXoOPepDAq88m9PDoY+mSchPpI6TNfDKEvkcmx3K+2Ji3vg3eGTbAPcHUQL0Z6PYFoWrcaRtO/Cq4gnPQnqk0+VVzFYgh46qZ+OE6Ry2gOg0ovAzg6s3kZahagDDDGp7O3TU17FCtgBnKTGGj0TzsAg7MkH00NNkE1ftcE1m+a9IV4UoQ071O7VKQ3mVj0UuO9lVUJp+herzxIf+Vf+UH6HQR34ampwcAAAAASUVORK5CYII=">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($frameworks_dir . '/adminlte/css/adminlte.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url($plugins_dir . '/icheck/css/blue.css'); ?>">
<?php if ($mobile === FALSE): ?>
        <!--[if lt IE 9]>
            <script src="<?php echo base_url($plugins_dir . '/html5shiv/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url($plugins_dir . '/respond/respond.min.js'); ?>"></script>
        <![endif]-->
<?php endif; ?>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
