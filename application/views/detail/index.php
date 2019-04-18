
	<!--content-->
	<div class="content">
			<!--single-->
			<div class="single-wl3">
				<div class="container">
					<div class="single-grids">
						<div clas="single-top">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<!-- <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span> -->
									<a id="imgzoom" href="<?=base_url($this->data['products_dir'].'/'.$product->gambar);?>" class="zoompleFixed">
									<img id="expandedImg" style="width:100%"></a>
									<!-- <div id="imgtext"></div> -->
								</div>
								<div class="thumbnail-column">
									<img id="img1" src="<?=base_url($this->data['products_dir'].'/'.$product->gambar);?>" alt="<?=$product->gambar;?>" style="width:100%" onclick="myFunction(this);">
								</div>
								<?php if($product->gambar2): ?>
								<div class="thumbnail-column">
									<img id="img2" src="<?=base_url($this->data['products_dir'].'/'.$product->gambar2);?>" alt="<?=$product->gambar2;?>" style="width:100%" onclick="myFunction(this);">
								</div>
								<?php endif; if($product->gambar3): ?>
								<div class="thumbnail-column">
									<img id="img3" src="<?=base_url($this->data['products_dir'].'/'.$product->gambar3);?>" alt="<?=$product->gambar3;?>" style="width:100%" onclick="myFunction(this);">
								</div>
								<?php endif; ?>
									</div>
								</div>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<form id="formAdd" action="<?= site_url('cart/add'); ?>" method="post">
								<input type="hidden" name="kode" value="<?= $product->kdbar ?>">
								<input type="hidden" id="qty" name="qty" value="1">
								
								<h4 class="nama"><?= $product->nama ?></h4>
								<h6>(<?= $product->kdbar ?>)</h6>
								<div class="block">
									<div class="starbox small ghosting unchangeable" data-start-value="<?= $this->data['item_rating']->rating ?>"> </div>
								</div>
								<?php if ($product->pnj) { ?>
								<span class="size"><?= $product->pnj; ?> x <?= $product->lbr; ?><?= ($product->tgi)?' x '.$product->tgi:''; ?></span><br>
								<?php } if (!isset($varian) && strlen($product->size) > 4) { ?>
								<span class="size"><?= $product->size; ?></span><br>
								<?php } if ($product->listrik) { ?>
								<span class="size">Electricity: <?= $product->listrik; ?></span><br>
								<?php } ?>
								<?php if ($product->kapasitas) { ?>
								<span class="size">Capacity: <?= $product->kapasitas; ?></span>
								<?php } ?>
								<?php if ($product->gas) { ?>
								<br><span class="size"><?= $product->gas; ?></span>
								<?php } ?>
								<?php if($product->kriteria == 'P') : ?>
								<p class="price item_price">Rp <?= $product->hpromof ?></p>
								<?php else :?>
								<p class="price item_price">Rp <?= $hjual ?></p>
								<?php endif; ?>
								
								<?php if(isset($varian)): if(sizeof($varian)>0): ?><div class="color-quality">
									<h6>Varian:</h6>
									<select id="size" name="size" class="form-control" style='width: 150px;'>
										<?php
											foreach ($varian as $item) {
												if (isset($_SESSION['varian']))
												{
										?>
										<option value="<?= $item->kdurl ?>"<?php if( $item->size == $_SESSION['varian'] ): ?> selected="selected"<?php endif; ?>><?= $item->size ?></option>
										<?php   } else { ?>
										<option value="<?= $item->kdurl ?>"><?= $item->size ?></option>
										<?php } } ?>
									</select>
								</div><?php endif; endif; ?>
								<div class="color-quality">
								<?php if ($stok > 0) :?>
									<h6>Ready Stock</h6>
									<h6>Quantity:</h6>
										<input type="hidden" id="maxqty" value="<?= $stok ?>">
										<div class="quantity"> 
											<div class="quantity-select">                           
												<div class="entry value-minus">&nbsp;</div>
												<div class="entry value"><span>1</span></div>
												<div class="entry value-plus active">&nbsp;</div>
											</div>
										</div>
										<script>
										$('.value-plus').on('click', function(){
											var divUpd = $(this).parent().find('.value'), maxVal = $('#maxqty').val(), newVal = parseInt(divUpd.text(), 10)+1;
											if (newVal > maxVal)
											{
												newVal = maxVal;
											}
											divUpd.text(newVal);
											$(this).parents("#formAdd").find('#qty')[0].value = divUpd.text();

											var theUrl = "<?= current_url().'?action=add&code='.$product->kdurl ?>";
											var newUri = theUrl + '&qty='+divUpd.text();
											$('#qtyOrder').attr("href", newUri);
										});

										$('.value-minus').on('click', function(){
											var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
											if(newVal>=1) divUpd.text(newVal);
											$(this).parents("#formAdd").find('#qty')[0].value = divUpd.text();

											var theUrl = "<?= current_url().'?action=add&code='.$product->kdurl ?>";
											var newUri = theUrl + '&qty='+divUpd.text();
											$('#qtyOrder').attr("href", newUri);
										});
										</script>
								<?php else: ?>
									<h6>Coming soon!</h6>
								<?php endif;?>
								</div>
								<?php if ($stok > 0) :?>
								<div class="women">
									<a id="qtyOrder" href="<?= current_url().'?action=add&code='.$product->kdurl ?>" class="my-cart-b item_add">Add To Cart</a>
								</div>
								<?php endif;?>
								<div class="social-icon">
									<h6>Share:</h6>
									<?php if ($_SESSION['context'] == 1): ?>
									<a href="http://www.facebook.com/askitchen"><i class="icon"></i></a>
									<a href="http://www.instagram.com/askitchen"><i class="icon1"></i></a>
									<?php else: ?>
									<a href="http://www.facebook.com/asoviconline"><i class="icon"></i></a>
									<a href="http://www.instagram.com/askitchen.utensil"><i class="icon1"></i></a>
									<?php endif; ?>
									<!-- <a href="#"><i class="icon2"></i></a>
									<a href="#"><i class="icon3"></i></a> -->
								</div>
								</form>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="box box-primary">
									<div class="box-header with-border">

									<!-- <div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div> -->
									</div>
									<!-- /.box-header -->
									<div class="box-body">
									<?php if( count($promotion) > 0) { ?>
									<h3 class="box-title">Promotion Products</h3>
									<ul class="products-list product-list-in-box">
										<?php 
											$index = 0;
											foreach ( $promotion as $item) { ?>
										<li class="item">
											<div class="product-img">
												<img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar)?>" alt="Image">
											</div>
											<div class="product-info">
												<a class="product-title promo" href="<?= site_url('detail/'.$item->kdurl); ?>"><?=$item->nama?></a><br>
												<span class="label label-warning">Rp<?=$item->hpromo?></span></a>
												<span class="product-description"><?=$item->deskripsi?></span>
											</div>
										</li>
										<!-- /.item -->
										<?php 
											$index++;
											if ($index == 10) break;
											} ?>
									</ul>
									<?php } // tidak ada item promo
									elseif( count($related) > 0) { ?>
									<h3 class="box-title">Related Products</h3>
									<ul class="products-list product-list-in-box">
										<?php 
											$index = 0;
											foreach ( $related as $item) { ?>
										<li class="item">
											<div class="product-img">
												<img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar)?>" alt="Image">
											</div>
											<div class="product-info">
												<a class="product-title promo" href="<?= site_url('detail/'.$item->kdurl); ?>"><?=$item->nama?></a><br>
												<span class="label label-warning">Rp<?=$item->hjual?></span></a>
												<span class="product-description"><?=$item->deskripsi?></span>
											</div>
										</li>
										<!-- /.item -->
										<?php 
											$index++;
											if ($index == 5) break;
											} ?>
									</ul>
									<?php } ?>
									</div>
									<!-- /.box-body -->
									<!-- <div class="box-footer text-center">
									<a href="javascript:void(0)" class="uppercase">View All Products</a>
									</div> -->
									<!-- /.box-footer -->
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
						<script type="text/javascript">

						jQuery(function() {
							jQuery('.starbox').each(function() {
								var starbox = jQuery(this);
									
								starbox.starbox({
								average: starbox.attr('data-start-value'),
								changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
								ghosting: starbox.hasClass('ghosting'),
								autoUpdateAverage: starbox.hasClass('autoupdate'),
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

						<div class="tab-wl3">
							<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
								<ul id="myTab" class="nav nav-tabs left-tab" role="tablist">
									<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Description</a></li>
									<li role="presentation" class=""><a href="#reviews" role="tab" id="reviews-tab" data-toggle="tab" aria-controls="reviews">Fitur</a></li>
								</ul>
								<div id="myTabContent" class="tab-content">
									<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab"><div class="descr">
										<p> <?= $product->deskripsi ?></p>
									</div></div>
									
									<div role="tabpanel" class="tab-pane fade" id="reviews" aria-labelledby="reviews-tab">
										<ul>
											<p> <?= $product->fitur ?></p>
										</ul>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="custom" aria-labelledby="custom-tab"></div>
								</div>
							</div>
						</div>
						<div clas="single-top">
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<!--single-->
			<?php
				if (count($this->data['related']) > 0) :
			?>
			<!--related-products-->
			<div class="related-w3agile">
				<div class="container">
					<h3 class="tittle1">Related Products</h3>
					<div class="related-grids">
						<div id="owl-demo" class="owl-carousel owl-theme owl-loaded owl-drag">

							<?php
								$index = 0;
								foreach ($this->data['related'] as $item) {
							?>
							<div class="item related">
								<div class="grid-rel">
									<div class="grid-related">
										<figure>		
											<a href="<?php echo site_url('detail/'.$item->kdurl); ?>" class="new-gri">
												<div class="grid-img">
													<img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar);?>" class="img-responsive" alt="<?= $item->kdbar?>">
												</div>
											</a>		
										</figure>	
									</div>
									<div class="women">
										<p ><em class="item_price">Rp<?= $item->hjual; ?></em></p>
										<span class="size"><?= $item->nama; ?></span>
										<?php if($item->pnj): ?>
										<span class="size"><?= $item->pnj; ?> x <?= $item->lbr; ?><?= ($item->tgi)? ' x '.$item->tgi:''; ?></span>
										<?php endif; ?>
										<!-- <span class="detail"><a href="<?= current_url().'?action=add&code='.$item->kdurl ?>" class="my-cart-d item_add"><img src="<?= site_url('images/bag.png'); ?>" alt="Cart" /></a>&nbsp;<a href="<?php echo site_url('detail/'.$item->kdurl); ?>" class="my-cart-d item_add">Detail</a></span> -->
										<span class="detail"><a href="<?= current_url().'?action=add&code='.$item->kdurl ?>" class="my-cart-d item_add"><img src="<?= site_url('images/buyonline5.png'); ?>" alt="Cart" /></a>&nbsp;<a href="<?php echo site_url('detail/'.$item->kdurl); ?>"></a></span>
									</div>
								</div>
							</div>
							<?php 
								$index++;
								} ?>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<!--related-products-->
			<?php
				endif;
			?>
			<!--reviews-->
			<div class="reviews">
				<div class="container">
					<h3 class="tittle1">Reviews</h3>
					<div class="col-md-7">
						<div class="related-grids">
							<div class="reviews-top">
								<?php
									foreach ($this->data['reviews'] as $item) {
								?>
								<div class="comment">
									<div class="reviews-left">
										<img src="<?=site_url('images/user.jpg');?>" alt=" " class="img-responsive">
									</div>
									<div class="reviews-right">
										<ul>
											<li><a href="#"><?=$item->name?></a> <!--<?=date_format($item->timestamp, "j D Y")?>--></li>
											<!-- <li><a href="#"><i class="glyphicon glyphicon-share" aria-hidden="true"></i>Reply</a></li> -->
										</ul>
										<p><?=$item->comment?></p>
									</div>
									<div class="clearfix"></div>
								</div>
								<?php }
									if(isset($this->data['showbutton'])) {
								?>
									<a class="all-reviews" href="<?=current_url().'?action=getall';?>">Read All Reviews</a>
								<?php } ?>
							</div>
							<div class="reviews-bottom">
								<h4>Add Reviews</h4>
								<p>Your email address will not be published. Required fields are marked *</p>
								Your Rating
								<form id="formReview" action="<?=current_url().'?action=comment';?>" method="post">
								<div class="block">
									<div class="starbox small ghosting" data-start-value="<?=isset($this->data['rating']) ? $this->data['rating'] : '0'; ?>"><div class="positioner" style=""><div class="stars"><div class="ghost" style="width: 0px; display: none;"></div><div class="colorbar" style="width: 42.5px;"></div><div class="star_holder"><div class="star star-0"></div><div class="star star-1"></div><div class="star star-2"></div><div class="star star-3"></div><div class="star star-4"></div></div></div></div></div>
								</div>
									<input type="hidden" name="kdbar" value="<?= $product->kdbar ?>">
									<input type="hidden" name="url" value="<?= current_url() ?>">
									<input type="hidden" id="rating" name="rating" value="<?=isset($this->data['rating']) ? $this->data['rating'] : '0';?>">
									<label>Your Review </label>
									<textarea type="text" name="comment" placeholder="Message..." required><?=isset($this->data['comment']) ? $this->data['comment'] : '';?></textarea>
									<div class="row">
										<div class="col-md-6 row-grid">
											<label>Name</label>
											<input type="text" name="name" placeholder="Name" value="<?=isset($this->data['name']) ? $this->data['name'] : '';?>" required>
										</div>
										<div class="col-md-6 row-grid">
											<label>Email</label>
											<input type="email" name="email" placeholder="Email" value="<?=isset($this->data['email']) ? $this->data['email'] : '';?>" required>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="row">
										<div class="col-md-6 row-grid">
											<div class="form-group">
                                        		<div class="g-recaptcha" data-sitekey="6Le1AowUAAAAAF_pBHB401tykRs1buhibhqTC0uy" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                        		<input class="form-control hidden" data-recaptcha="true" required data-error="Please complete the Captcha">
                                        	<div class="help-block with-errors"></div>
                                    	</div>
									</div>
									<div class="row">
										<div class="col-md-3 col-xs-4 row-grid">
											<input id="btnSend" type="submit" value="Send">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--reviews-->
		</div>
    <!--content-->
<script>
$(document).ready(function() {
	$('.zoompleFixed').zoomple({
		offset : {x:5,y:0},
		showOverlay : false , 
		roundedCorners: false, 
		windowPosition : {x:'right',y:'top'}, 
		zoomWidth : 400,  
		zoomHeight : 400, 
		attachWindowToMouse : false
	});
	$('.zoomple').zoomple({ 
		blankURL : 'images/blank.gif',
		bgColor : '#fff',
		loaderURL : 'images/loader.gif',
		offset : {x:-75,y:-75},
		zoomWidth : 150,  
		zoomHeight : 150,
		roundedCorners : true
	}); 
// $(function () {


	// init the validator
	// validator files are included in the download package
	// otherwise download from http://1000hz.github.io/bootstrap-validator

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change')
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change')
    }
        
    $('#size').change(function(){

		var url = <?php echo '"'.site_url().'detail/"' ?> + $('#size option:selected').val();
		window.location.href = url;
    });
});
</script>
<script>
	function myFunction(imgs) {
		var expandImg = document.getElementById("expandedImg");
		var imgText = document.getElementById("imgtext");
		var imgZoom = document.getElementById("imgzoom");

		expandImg.src = imgs.src;
		imgZoom.href = imgs.src;
		imgText.innerHTML = imgs.alt;
		expandImg.parentElement.style.display = "block";
	}
	var img = document.getElementById("img1");
	myFunction(img);
</script>
<script type="text/javascript" src="<?=base_url('js/readMoreJS.min.js');?>"></script>
<script>
		$readMoreJS.init({
			target: '.descr p',
			numOfWords: 50,
			toggle: true,
			moreLink: 'Read More',
			lessLink: 'Close'
		});
	</script>


