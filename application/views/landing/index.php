<!DOCTYPE HTML>
<html lang="<?php echo $lang; ?>">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134835738-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-134835738-1');
    </script>

	<meta charset="<?php echo $charset; ?>">
	<title>Professional Food Service Supplies | Home :: ASKITCHEN</title>
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
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="google" content="notranslate">
	<meta name="robots" content="noindex, nofollow">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="Professional Food Service Supplies" />
	<meta name="keywords" content="Freezer, Cooler, Cooler Showcase, Cooler Dispenser, Ice Maker, Ice Cream, Ice Cream Machine, 
	Refrigerator, Refrigeration, Stainless Steel Refrigeration, Minimarket, Minimarket Refrigeration,
	Apparel, Bakeware, Bar Tools, Container, Pantry, Cookware, Knives, Cutlery, Table Top, Utensil" />
	<meta name="author" content="ASKITCHEN" />
	<meta name="reply-to" content="marketing@askitchen.com" />
	<meta name="owner" content="webmaster@askitchen.com" />
<?php if ($mobile == TRUE && $ios == TRUE): ?>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="Professional Food Service Supplies | Home :: ASKITCHEN">
<?php endif; ?>
<?php if ($mobile == TRUE && $android == TRUE): ?>
	<meta name="mobile-web-app-capable" content="yes">
<?php endif; ?>
	<link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAzUExURQAAAMQVG8QVG8QVG8QVG8MUGcQWHMQWHMQWHMQVGsQVG8QWHMMVG8QVG8QVGsMUGcQWHBiWaGEAAAAQdFJOUwAlilPupF/5xQsYM7racUEuThiQAAAA5klEQVQ4y+WTWXLEMAhE0YJAO/c/bYxkbM3kBsn7cqm7cLewAf4fxeX9kI1PvWIfeuSGN8ZpcY0kBoDJkYw4Xj0jiciAynLQXoOPepDAq88m9PDoY+mSchPpI6TNfDKEvkcmx3K+2Ji3vg3eGTbAPcHUQL0Z6PYFoWrcaRtO/Cq4gnPQnqk0+VVzFYgh46qZ+OE6Ry2gOg0ovAzg6s3kZahagDDDGp7O3TU17FCtgBnKTGGj0TzsAg7MkH00NNkE1ftcE1m+a9IV4UoQ071O7VKQ3mVj0UuO9lVUJp+herzxIf+Vf+UH6HQR34ampwcAAAAASUVORK5CYII=">
	<link rel="stylesheet" type="text/css" href='//fonts.googleapis.com/css?family=Calibri'>
	<link rel="stylesheet" type="text/css" href='//fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300'>
	
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/bootstrap.min.css');?>" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/font-awesome.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/jquery-ui.css');?>">
	
	<!--<link rel="stylesheet" type="text/css" href="<?=base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">-->
	<link rel="stylesheet" type="text/css" href="<?=base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($frameworks_dir . '/adminlte/css/adminlte.min.css'); ?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?=base_url($frameworks_dir . '/adminlte/plugins/iCheck/flat/blue.css'); ?>"> -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/style.css');?>" media="all"/>
	<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- <script src="<?=base_url('js/jquery.min.js');?>"></script> -->
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

<?php if (current_url() == site_url()): ?>
<script src="<?=base_url('js/responsiveslides.min.js');?>"></script>
<script>
  $(function () {
   $("#slider").responsiveSlides({
   	auto: true,
   	nav: true,
   	speed: 500,
    namespace: "callbacks",
    pager: true,
   });

  });
</script>
<?php endif; ?>
<script type="text/javascript" src="<?=base_url('js/bootstrap-3.1.1.min.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha256-dHf/YjH1A4tewEsKUSmNnV05DDbfGN3g7NMq86xgGh8=" crossorigin="anonymous"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<script defer src="<?=base_url('js/jquery.flexslider.js');?>"></script>
<link rel="stylesheet" href="<?=base_url('css/flexslider.css');?>" type="text/css" media="screen" />


<?php if ($mobile === FALSE): ?>
	<!--[if lt IE 9]>
		<script src="<?php echo base_url($plugins_dir . '/html5shiv/html5shiv.min.js'); ?>"></script>
		<script src="<?php echo base_url($plugins_dir . '/respond/respond.min.js'); ?>"></script>
	<![endif]-->
<?php endif; ?>
<!-- <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c2f0a6a04c7730011f604db&product=sticky-share-buttons' async='async'></script> -->
</head>
<body>

	<!--wrapper-->
    <div class="wrapper">
        <div class="blocks" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/1.jpg');background-size: cover;">
			<div>
				<a href="equipment" >
					<img class="aslanding" src="images/logoaskitchenwhite.png" alt="askitchen"></a>
				<h1>
					<p>Serve the best culinary experience with GETRA, one stop supply of commercial kitchen and food processing equipment. Find all your food service needs in one site.</p></h1>
					
						<!-- <a href="equipment" class="btn-ask"><span class="shift">equipment</span></a> -->
						<!-- <div class="mask"></div> -->
					
			</div>
		</div>
        <div class="blocks" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/2.jpg');background-size: cover;">
			<div>
				<a href="utensil">
				<img class="utelanding" src="images/logoaskitchenutensil.png" alt="askitchenutensil"></a>
				<h1>
					<!-- <p>Serve the best culinary experience with GETRA, one stop supply of commercial kitchen and food processing equipment. Find all your food service needs in one site.</p></h1> -->
				<!-- <a href="utensil" class="btn-asovic">Click Here</a> -->
			</div>
		</div>
	</div>
	<!--wrapper-->
	<script>
		$(document).ready(function() {
			const body = document.body;
			const btn = document.querySelectorAll('.button')[0];

			btn.addEventListener('mouseenter', () => {
			body.classList.add('show');
			});

			btn.addEventListener('mouseleave', () => {
				body.classList.remove('show');
			});
		})
	</script>
</body>
</html>