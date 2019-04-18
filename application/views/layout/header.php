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
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/couture" type="text/css"/>
	
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

	$.ajax({
		url: "https://geoip-db.com/jsonp",
		jsonpCallback: "callback",
		dataType: "jsonp",
		success: function( location ) {
			// $('#country').html(location.country_name);
			$('#state').html(location.state);
			$('#city').html(location.city);
			// $('#latitude').html(location.latitude);
			// $('#longitude').html(location.longitude);
			// $('#ip').html(location.IPv4);  
		}
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
	
	  // $('#img-logo').hover(function(){
		// 	$(this).attr('src','<?= site_url('images/asovic2.png'); ?>');
		// },function(){
		// 	$(this).attr('src','<?= site_url('images/asovic.png'); ?>');
		// });
	
	  // $('.dropdown-toggle').hover(function(){
		// 	var menu = $(this).attr('data-menu');
		// 	$('#'+menu).not('.in .dropdown-menu').stop(true, true).delay(100).fadeIn(400);
		// 	$(this).toggleClass('open');
		// },function(){
		// 	var menu = $(this).attr('data-menu');
		// 	$('#'+menu).not('.in .dropdown-menu').stop(true, true).delay(100).fadeOut(400);
		// 	$(this).toggleClass('open');
		// });
	
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
	
		var navbar = document.getElementById("nav1");
		var navmenu = document.getElementById("bs-megadropdown-tabs");
		var sticky = navbar.offsetTop;
		var topPos = (window.screen.width > 768) ? 132: 192;
		
		$(".dropdown-menu.catalog").css( 'top', topPos+'px');
		
		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
			
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				document.getElementById("myBtn").style.display = "block";
			} else {
				document.getElementById("myBtn").style.display = "none";
			}
			
			if (window.pageYOffset >= sticky) {
				
				navbar.classList.add("sticky");
				navmenu.classList.add("sticky")
				
				topPos = 40;
				$(".dropdown-menu.catalog").css( 'top', topPos+'px');
			} else {
				
				navbar.classList.remove("sticky");
				navmenu.classList.remove("sticky");
				
				if (window.screen.width > 768)
				{
					topPos = 132 - window.pageYOffset;
				}
				else
				{
					topPos = 192 - window.pageYOffset;
				}
				$(".dropdown-menu.catalog").css( 'top', topPos+'px');
			}
		}
	});
	</script>
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/introjs.css');?>">

	<!--header-->
		<div class="header">
			<div class="header-top-most">
				<div class="container2">
					<div class="top-left">
						<a href="<?php echo site_url('equipment'); ?>"><img id="img-logo" class="img-header" src="<?= site_url('images/equipment/askitchen.jpg'); ?>" alt="ASKITCHEN Logo" hspace="3" /></a>
						<a href="<?php echo site_url('utensil'); ?>" target="_blank"><img class="img-header" src="<?= site_url('images/equipment/utensilatas1.jpg'); ?>" alt="ASOVIC Logo" hspace="3" /></a>
						<a href="http://www.muchef.com/" target="_blank"><img class="img-header" src="<?= site_url('images/equipment/muchef.jpg'); ?>" alt="MUCHEF Logo" hspace="3" /></a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="header-top">
				<div class="container top">
					<div class="top-left">
						<div>
							<a href="<?php echo site_url('equipment'); ?>"><img class="logo atas" src="<?= site_url('images/equipment/logoasknew.png'); ?>" alt="ASKITCHEN"></a>
						</div>
						<div class="location">
							<!-- <img src="<?= site_url('images/location.png'); ?>" alt="location"/>
							<span style="display: inline-block; vertical-align: middle; color:#fff;">Deliver To<br><span id="city"></span>,&nbsp<span id="state"></span></span></a> -->
						</div>
					</div>
					<div class="top-left2" data-step="1" data-tooltipclass="forIntro" data-intro="Click here to search our item.">
						<!-- search form -->
						<form id="frmSearch" action="<?php echo site_url('search'); ?>" method="get" class="sidebar-form">
							<div class="input-group search">
								<div class="input-group-btn">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All <span class="caret"></span></button>
									<ul class="dropdown-menu">
									<?php
										foreach ($this->data['golongan'] as $item) {
									?>
										<li><a href="<?php echo site_url('categories/'.$item->kdgol); ?>"><?= $item->nama ?></a></li>
									<?php
										}
									?>
									</ul>
								</div>
								<input type="text" name="q" class="form-control" placeholder="Search for..." value="">
								<span class="input-group-btn">
									<button id='search-btn' class="btn btn-default-go" type="button" onclick="frmSearch.submit();"><img class="img-go" src="<?= site_url('images/search.png'); ?>"></button>
								</span>
							</div>
						</form>
						
						<nav class="navbar navbar-default" id="nav1">
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">

									<!-- Mega Menu -->
									<?php 
										$index = 0;

										foreach ($this->data['golongan'] as $item) {
									?>
									<li class="dropdown" data-menu="dropdown-<?=$item->kdgol?>">
										<a href="<?php echo site_url('products/'.$item->kdgol); ?>" class="dropdown-toggle" data-toggle="dropdown" data-menu="dropdown-<?=$item->kdgol?>"><?php echo $item->nama ?><b class="caret"></b></a>
										<!-- <ul class="dropdown-menu multi-column columns-3">
										</ul> -->
									</li>
									<?php 
											$index++;
											// if ($index == 5) break;
										}
									?>
								</ul>
							</div>
						</nav>
					</div>
					<div class="top-right">
						<ul style="display: inline-flex;">
							<?php if ($admin_link): ?>
							<li><a class="top-text" href="<?php echo site_url('admin'); ?>">Admin</a></li>
							<?php endif; ?>
							<?php if ($logout_link): ?>
							<li class="dropdown"><a class="dropdown-toggle top-text" data-toggle="dropdown" style="cursor: pointer;"><?= $first_name ?>&nbsp;<b class="caret"></b></a>
								<ul class="dropdown-menu dropdown-menu-right">
									<?php if ($this->ion_auth->logged_in()):
									if ( ! $this->ion_auth->is_admin()  && !isset($_SESSION['guest']) ): ?>
									<li class=""><a href="<?= site_url('akun'); ?>"><i class="mi fa fa-user"></i> Profile</a></li>
									<li class=""><a href="<?= site_url('akun?p=pending'); ?>"><i class="mi fa fa-book"></i> Orders</a></li>
									<li class=""><a href="<?= site_url('akun?p=histori'); ?>"><i class="mi fa fa-bar-chart-o"></i> History</a></li>
									<li role="separator" class="divider"></li>
									<?php endif; endif; ?>
									<li class=""><a href="<?= site_url('auth/logout/public'); ?>"><i class="mi fa fa-sign-out"></i> Logout</a></li>
								</ul>
							</li>
							<!-- <li><a class="top-text" href="<?php echo site_url('auth/logout/public'); ?>">Logout</a></li> -->
							<?php else: ?>
							<li><a class="top-text" href="<?php echo site_url('register'); ?>">Register</a></li>
							<li><a class="top-text" href="<?php echo site_url('login'); ?>">Sign In</a></li>
							<?php endif; ?>
							<li><a class="top-text" href="#" id="cart">Cart&nbsp;<img src="<?= site_url('images/bag.png'); ?>" alt="Cart" /></a>
							&nbsp;<span class="badge badge-primary"><?php if($this->session->userdata('totqty')): echo $this->session->userdata('totqty'); else: echo '0'; endif; ?></span></li>
						</ul>
						<h4><a href="javascript:void(0);" onclick="javascript:introJs().setOption('tooltipClass', 'customDefault').start();">Help Me</a></h4>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			
			<script type="text/javascript" src="<?=base_url('js/intro.js');?>"></script>

			<div class="heder-bottom">
				<div class="container">
					<div class="logo-nav">
						<div class="logo-nav-left1">
							<nav class="navbar navbar-default" id="nav2">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs2">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div> 
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs2">
								
								<ul class="nav navbar-nav">

									<!-- Mega Menu -->
									<?php 
										$index = 0;

										foreach ($this->data['golongan'] as $item) {
									?>
									<li class="dropdown">
										<a href="<?php echo site_url('products/'.$item->kdgol); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $item->nama ?><b class="caret"></b></a>
											<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<?php foreach ($this->data['item_'.$item->kdgol] as $detail) { ?>
												<li class="col-sm-2 multi-gd-img">
													<div class="row text-center"><label class="block-with-text"><?php echo $detail->nama ?></label></div>
													<div class="row">
														<div class="sample">
														<a href="<?php echo site_url('subcategories/'.$item->kdgol.'/'.$detail->kdgol2); ?>">
															<img src="<?php echo site_url($this->data['products_dir'].'/'.$detail->gbr); ?>" alt="<?php echo $detail->nama ?>"/></a>
														</div>
													</div>
													<!-- <div><label class="block-with-text"><?php echo $detail->nama ?></label></div> -->
													<div class="row text-center">
														<a class="view-more btn- btn-sm" href="<?php echo site_url('subcategories/'.$item->kdgol.'/'.$detail->kdgol2); ?>">More</a>
													</div>
												</li>
												<?php } ?>
											</div>
										</ul>
									</li>
									<?php 
											$index++;
										}
									?>
								</ul>
							</div>
							</nav>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
	
			</div>
		</div>
	<!--header-->
	
	
	<?php 
		$index = 0;

		foreach ($this->data['golongan'] as $item) {
	?>
	<div id="dropdown-<?=$item->kdgol?>" class="dropdown-menu catalog">
	<?php foreach ($this->data['item_'.$item->kdgol] as $detail) { ?>
		<div class="col-sm-2 multi-gd-img">
			<div class="row text-center"><label class="block-with-text"><?php echo $detail->nama ?></label></div>
			<div class="row">
				<div class="sample">
					<a href="<?php echo site_url('subcategories/'.$item->kdgol.'/'.$detail->kdgol2); ?>">
					<img src="<?php echo site_url($this->data['products_dir'].'/'.$detail->gbr); ?>" alt="<?php echo $detail->nama ?>"/></a>
				</div>
			</div>
			<!-- <div class="row text-center"><label class="block-with-text"><?php echo $detail->kdbar ?></label></div> -->
			<div class="row text-center">
				<a class="view-more btn- btn-sm" href="<?php echo site_url('subcategories/'.$item->kdgol.'/'.$detail->kdgol2); ?>">More</a>
			</div>
		</div>
	<?php } ?>
	</div>
	<?php } ?>

	<div class="shopping-cart">
		<div class="shopping-cart-header">
		<i class="fa fa-shopping-cart cart-icon"></i><span class="badge"><?php if($this->session->userdata('totqty')): echo number_format($this->session->userdata('totqty'),0,",","."); else: echo '0'; endif; ?></span>
		<div class="shopping-cart-total">
			<span class="lighter-text">Total:&nbsp;</span>
			<span class="main-color-text">Rp<?php if($this->session->userdata('tot_price')): echo number_format($this->session->userdata('tot_price'),0,",","."); else: echo '0'; endif; ?></span>
		</div>
		</div> <!--end shopping-cart-header -->

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
					<span class="item-name"><?= $item["nama"]; ?></span>
					<span class="item-price">Rp<?= number_format($item_price, 0, ',', '.') ?></span>
					<span class="item-quantity">Qty: <?= $item["qty"]; ?></span>
				</div>
				<div class="rem2">
				<a href="<?= current_url().'?action=remove&code='.$item["kdurl"] ?>"><span class="close2"></span></a>
				</div>
			</div>
		</li>
		<?php } endif; ?>
		</ul>

		<a href="<?php echo site_url('cart'); ?>" class="button <?php if($this->session->userdata('totqty')): echo ''; else: echo 'btn disabled'; endif;?>">Checkout</a>
	</div> <!--end shopping-cart -->
