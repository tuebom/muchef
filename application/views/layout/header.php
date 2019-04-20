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
<title>Professional Food Service Supplies | Home :: MUCHEF</title>
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
	Refrigerator, Refrigeration, Stainless Steel Refrigeration, Minimarket, Minimarket Refrigeration" />
	<meta name="author" content="MUCHEF" />
	<meta name="reply-to" content="marketing@askitchen.com" />
	<meta name="owner" content="marketing@askitchen.com" />
<?php if ($mobile == TRUE && $ios == TRUE): ?>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="Professional Food Service Supplies | Home :: MUCHEF">
<?php endif; ?><!--if mobile-->
<?php if ($mobile == TRUE && $android == TRUE): ?>
	<meta name="mobile-web-app-capable" content="yes">
<?php endif; ?>
	<link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAzUExURQAAAMQVG8QVG8QVG8QVG8MUGcQWHMQWHMQWHMQVGsQVG8QWHMMVG8QVG8QVGsMUGcQWHBiWaGEAAAAQdFJOUwAlilPupF/5xQsYM7racUEuThiQAAAA5klEQVQ4y+WTWXLEMAhE0YJAO/c/bYxkbM3kBsn7cqm7cLewAf4fxeX9kI1PvWIfeuSGN8ZpcY0kBoDJkYw4Xj0jiciAynLQXoOPepDAq88m9PDoY+mSchPpI6TNfDKEvkcmx3K+2Ji3vg3eGTbAPcHUQL0Z6PYFoWrcaRtO/Cq4gnPQnqk0+VVzFYgh46qZ+OE6Ry2gOg0ovAzg6s3kZahagDDDGp7O3TU17FCtgBnKTGGj0TzsAg7MkH00NNkE1ftcE1m+a9IV4UoQ071O7VKQ3mVj0UuO9lVUJp+herzxIf+Vf+UH6HQR34ampwcAAAAASUVORK5CYII=">
	<link rel="stylesheet" type="text/css" href='//fonts.googleapis.com/css?family=Calibri'>
	<link rel="stylesheet" type="text/css" href='//fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300'>
	<!-- <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/couture" type="text/css"/> -->
	
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/bootstrap.min.css');?>" media="all"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/font-awesome.css');?>">

	<!-- <link rel="stylesheet" type="text/css" href="<?=base_url('css/jquery-ui.css');?>"> -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<link rel="stylesheet" type="text/css" href="<?=base_url($frameworks_dir . '/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($frameworks_dir . '/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($frameworks_dir . '/adminlte/css/adminlte.min.css'); ?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?=base_url($frameworks_dir . '/adminlte/plugins/iCheck/flat/blue.css'); ?>"> -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/style.css');?>" media="all"/>
	<link rel="stylesheet" media="screen" href="<?=base_url('css/zoomple.css');?>" type="text/css" />
	
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<?php if (current_url() == site_url().'checkout'): ?>
	<!-- <script type="text/javascript"
            src="https://app.midtrans.com/snap/snap.js"
            data-client-key="VT-client-_sRu4j_KmIMbLb2B"></script> -->
	<script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="VT-client-yVeq4w-N-aPHTl6a"></script>
	<?php endif; ?>
	<!-- <script src="<?=base_url('js/jquery.min.js');?>"></script> -->
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="<?=base_url('js/zoomple.js');?>" type="text/javascript"></script>

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
<!-- cart -->
<script src="<?=base_url('js/simpleCart.min.js');?>"></script>
<!-- cart -->

<!--start-rate-->
<script src="<?=base_url('js/jstarbox.js');?>"></script>
<link rel="stylesheet" href="<?=base_url('css/jstarbox.css');?>" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript">
jQuery(function() {

	jQuery('.starbox').each(function() {
		var starbox = jQuery(this);
			
		starbox.starbox({
		average: 0, //starbox.attr('data-start-value'),
		changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
		ghosting: starbox.hasClass('ghosting'),
		autoUpdateAverage: true, //starbox.hasClass('autoupdate'),
		buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
		stars: starbox.attr('data-star-count') || 5
		}).bind('starbox-value-changed', function(event, value) {
			starbox.starbox('setOption', 'average', value);
			var el = $(this).parents("#formReview").find('#rating')[0];
			if (el) el.value = value;
		});
	});

});
</script>
<!--//End-rate-->

<script defer src="<?=base_url('js/jquery.flexslider.js');?>"></script>
<link rel="stylesheet" href="<?=base_url('css/flexslider.css');?>" type="text/css" media="screen" />
<script src="<?=base_url('js/imagezoom.js');?>"></script>
<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });

	$(".dropdown").hover(
		function() {
			$('.dropdown-menu', this).stop( true, true ).slideDown("fast");
			$(this).toggleClass('open');
		},
		function() {
			$('.dropdown-menu', this).stop( true, true ).slideUp("fast");
			$(this).toggleClass('open');
		}
	);

});
</script>

<link href="<?=base_url('css/owl.carousel.css');?>" rel="stylesheet">
<script src="<?=base_url('js/owl.carousel.js');?>"></script>
<script>
	$(document).ready(function() {
		$("#owl-demo").owlCarousel({
			items : 5,
			loop:true,
			lazyLoad : true,
			autoPlay : true,
			navigation : false,
			navigationText :  false,
			pagination : true,
		});
	});
</script>

<?php if ($mobile === FALSE): ?>
	<!--[if lt IE 9]>
		<script src="<?php echo base_url($plugins_dir . '/html5shiv/html5shiv.min.js'); ?>"></script>
		<script src="<?php echo base_url($plugins_dir . '/respond/respond.min.js'); ?>"></script>
	<![endif]-->
<?php endif; ?>
<!-- <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c2f0a6a04c7730011f604db&product=sticky-share-buttons' async='async'></script> -->
</head>
<body>

	<?php echo '<!-- '.current_url(). ' -->' ?>

	<script>
	$(document).ready(function() {
		
		$("#cart").on("click", function() {
			$(".shopping-cart").fadeToggle( "fast");
		});
		
		$('#login-form-link').click(function(e) {
			$("#login-form").delay(100).fadeIn(100);
			$("#register-form").fadeOut(100);
			$('#register-form-link').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});

		$('#register-form-link').click(function(e) {
			$("#register-form").delay(100).fadeIn(100);
			$("#login-form").fadeOut(100);
			$('#login-form-link').removeClass('active');
			$(this).addClass('active');
			e.preventDefault();
		});
	});
	</script>

	<!--header-->
	<div class="header">
		<!-- Navigation -->
		<nav class="navbar navbar-default w3ls navbar-fixed-top">
			<div class="container">
				<div class="navbar-header wthree nav_2">
					<!-- <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button> -->
					<a class="" href="<?= site_url(); ?>"><img src="images/logo-muchef.jpg" alt="Logo MUCHEF"></a> 
					<ul class="w3header-cart">
						<li class="wthreecartaits"><span class="my-cart-icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span class="badge badge-notify my-cart-badge"></span></span></li>
					</ul>
				</div>
				<div id="bs-megadropdown-tabs" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle w3-agile hyper" data-toggle="dropdown"><span> Aprons </span></a>
							<ul class="dropdown-menu aits-w3 multi multi1">
								<div class="row">

									<?php foreach ($item_21 as $detail) { ?>	
									<div class="col-sm-3 w3layouts-nav-agile w3layouts-mens-nav-agileits w3layouts-mens-nav-agileits-2">
										<a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><img src="<?php echo site_url($products_dir.'/'.$detail->gbr); ?>" alt="<?= $detail->nama ?>"></a>
										<p class="sample"><a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><?= $detail->nama ?></a></p>
									</div>
									<?php } ?>
									<div class="clearfix"></div>
								</div>

							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown"><span> Chef Jackets </span></a>
							<ul class="dropdown-menu multi multi2">
								<div class="row">

									<?php foreach ($item_22 as $detail) { ?>	
									<div class="col-sm-3 w3layouts-nav-agile w3layouts-mens-nav-agileits w3layouts-mens-nav-agileits-2">
										<a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><img src="<?php echo site_url($products_dir.'/'.$detail->gbr); ?>" alt="<?= $detail->nama ?>"></a>
										<p class="sample"><a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><?= $detail->nama ?></a></p>
									</div>
									<?php } ?>
									<div class="clearfix"></div>
								</div>

							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown"><span> Chef Hats </span></a>
							<ul class="dropdown-menu multi multi3">
								<div class="row">

									<?php foreach ($item_23 as $detail) { ?>	
									<div class="col-sm-3 w3layouts-nav-agile w3layouts-mens-nav-agileits w3layouts-mens-nav-agileits-2">
										<a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><img src="<?php echo site_url($products_dir.'/'.$detail->gbr); ?>" alt="<?= $detail->nama ?>"></a>
										<p class="sample"><a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><?= $detail->nama ?></a></p>
									</div>
									<?php } ?>
									<div class="clearfix"></div>
								</div>

							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown"><span> Chef Pants </span></a>
							<ul class="dropdown-menu multi multi4">
								<div class="row">

									<?php foreach ($item_24 as $detail) { ?>	
									<div class="col-sm-3 w3layouts-nav-agile w3layouts-mens-nav-agileits w3layouts-mens-nav-agileits-2">
										<a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><img src="<?php echo site_url($products_dir.'/'.$detail->gbr); ?>" alt="<?= $detail->nama ?>"></a>
										<p class="sample"><a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><?= $detail->nama ?></a></p>
									</div>
									<?php } ?>
									<div class="clearfix"></div>
								</div>

							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown"><span> Kitchen Shoes </span></a>
							<ul class="dropdown-menu multi multi5">
								<div class="row">

									<?php foreach ($item_25 as $detail) { ?>	
									<div class="col-sm-3 w3layouts-nav-agile w3layouts-mens-nav-agileits w3layouts-mens-nav-agileits-2">
										<a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><img src="<?php echo site_url($products_dir.'/'.$detail->gbr); ?>" alt="<?= $detail->nama ?>"></a>
										<p class="sample"><a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><?= $detail->nama ?></a></p>
									</div>
									<?php } ?>
									<div class="clearfix"></div>
								</div>

							</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle hyper" data-toggle="dropdown"><span> Accessories </span></a>
							<ul class="dropdown-menu multi multi6">
								<div class="row">

									<?php foreach ($item_23 as $detail) { ?>	
									<div class="col-sm-3 w3layouts-nav-agile w3layouts-mens-nav-agileits w3layouts-mens-nav-agileits-2">
										<a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><img src="<?php echo site_url($products_dir.'/'.$detail->gbr); ?>" alt="<?= $detail->nama ?>"></a>
										<p class="sample"><a href="<?= site_url('subcategories/'.$detail->kdgol.'/'.$detail->kdgol2); ?>"><?= $detail->nama ?></a></p>
									</div>
									<?php } ?>
									<div class="clearfix"></div>
								</div>

							</ul>
						</li>
						<!-- <li class="wthreesearch">
							<form action="#" method="post">
								<input type="search" name="Search" placeholder="Search for a Product" required="">
								<button type="submit" class="btn btn-default search" aria-label="Left Align">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						</li>
						<li class="wthreecartaits wthreecartaits2 cart cart box_1"> 
						 <form action="#" method="post" class="last"> 
								<input type="hidden" name="cmd" value="_cart" />
								<input type="hidden" name="display" value="1" />
								<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
							</form>   
						</li> -->
					</ul>
				</div>
				<div class="top-right">
					<ul class="nav navbar-nav">
						<li><a href="<?= site_url('contact'); ?>">Contact Us</a></li>
						<li><a href="<?= site_url('find-store'); ?>">Find Store</a></li>
						<li><a href="<?= site_url('login'); ?>">Login/Register</a></li>
					</ul>
					<span><a class="top-text" href="#" id="cart"><i class="fa fa-shopping-cart cart-icon"></i></a><span class="badge badge-primary">0</span></span>
				</div>

			</div>
		</nav>
		<!-- //Navigation -->

	</div>
	<!--header-->
	
	<div class="shopping-cart">
		<!-- <div class="shopping-cart-header">
		<i class="fa fa-shopping-cart cart-icon"></i><span class="badge"><?php if($this->session->userdata('totqty')): echo number_format($this->session->userdata('totqty'),0,",","."); else: echo '0'; endif; ?></span>
		<div class="shopping-cart-total">
			<span class="lighter-text">Total:&nbsp;</span>
			<span class="main-color-text">Rp<?php if($this->session->userdata('tot_price')): echo number_format($this->session->userdata('tot_price'),0,",","."); else: echo '0'; endif; ?></span>
		</div>
		</div> -->

		<ul class="shopping-cart-items">
		<?php 
			$item_price = 0;
			
			if(isset($_SESSION["cart_item"])):
			foreach ($_SESSION["cart_item"] as $item) {
			
			$item_price  = (float)$item["qty"]*$item["harga"];

		?><li class="clearfix">
			<div style="display: flex; align-items: center;">
				<div class="cart-img">
					<img src="<?= site_url($this->data['products_dir'].'/'.$item["gambar"]); ?>" alt="item1" />
				</div>
				<div class="cart-desc">
					<span class="item-price">Rp<?= number_format($item_price, 0, ',', '.') ?></span>
					<span class="item-name"><?= $item["nama"]; ?></span>
					<span class="item-quantity">Qty: <?= $item["qty"]; ?></span>
				</div>
				<div class="rem2">
				<a href="<?= current_url().'?action=remove&code='.$item["kdurl"] ?>"><span class="close2"></span></a>
				</div>
			</div>
		</li>
		<?php } endif; ?>
		</ul>

		<!-- <a href="<?php echo site_url('cart'); ?>" class="button <?php if($this->session->userdata('totqty')): echo ''; else: echo 'btn disabled'; endif;?>">Checkout</a> -->

		<div class="clearfix"></div>
		<p class="cart-footer"><a href="<?= site_url('cart'); ?>">Cancel</a>&nbsp;<a href="<?= site_url('cart'); ?>">Checkout</a></p>
	</div> <!--end shopping-cart -->
