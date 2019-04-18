	<script src="js/jssor.slider-27.5.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:800,$Opacity:2}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 1440;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?= site_url('images/spin.svg'); ?>" />
        </div>
		<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
		<?php foreach ($banner as $item) {?>
            <div>
				<img src="<?php echo site_url($this->data['banner_dir'].'/'.$item->filename); ?>" class="img-responsive" alt="">
			</div>
		<?php } ?>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>

	<script>
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		document.getElementById("myBtn").style.display = "block";
	} else {
		document.getElementById("myBtn").style.display = "none";
	}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
	}
	</script>
	
		<!--banner-->
		<!--content-->

			<!--hot-products-->
			<div class="hot-w3agile">
				<div class="container" data-step="2" data-intro="You can find our various products, promotion and our most favorite pickup from our customer">
					<div class="arrivals-grids">
						<div class="col-md-4 arrival-grid simpleCart_shelfItem">
							<div class="grid-arr-hot">
								<a href="<?php echo site_url('new-products'); ?>" class="new-gri">
									<img src="<?=site_url('images/new-product.jpg');?>" class="img-hot" alt="">
									<div class="text">
										<h3>New Products</h3>
									</div>
								</a>		
							</div>
						</div>
					
						<div class="col-md-4 arrival-grid simpleCart_shelfItem">
							<div class="grid-arr-hot">
								<a href="<?php echo site_url('promotion'); ?>" class="new-gri">
									<img src="<?=site_url('images/promotion.jpg');?>" class="img-hot" alt="">
									<div class="text">
										<h3>Promotions</h3>
									</div>
								</a>		
							</div>
						</div>
						
						<div class="col-md-4 arrival-grid simpleCart_shelfItem">
							<div class="grid-arr-hot">
								<a href="<?php echo site_url('best-seller'); ?>" class="new-gri">
									<img src="<?=site_url('images/best-seller.jpg');?>" class="img-hot" alt="">
									<div class="text">
										<h3>Best Seller</h3>
									</div>
								</a>		
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<!--hot-products-->

			<!--new-arrivals-->
				<div class="new-arrivals-w3agile">
					<div class="container">
						<h4 class="tittle1">New Arrivals</h4>
						<div class="arrivals-grids">
							<?php
								foreach ($this->data['rnd_products'] as $item) {
							?>
							<!-- <div class="col-md-3 arrival-grid simpleCart_shelfItem"> -->
							<div class="col-md-3 product-tab-grid simpleCart_shelfItem">
								<div class="grid-arr">
									<div class="grid-arrival">
										<figure>		
											<a href="<?php echo site_url('detail/'.$item->kdurl); ?>" class="new-gri">
												<div class="grid-img1">
													<img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar);?>" class="img-responsive" alt="<?= $item->kdbar?>">
												</div>
											</a>		
										</figure>	
									</div>
									<div class="dashboard">
										<span class="size"><?= $item->nama; ?></span>
										<?php if ($item->kriteria == 'P'):?>
										<div class="dimensi">
											<span class="size"><del>Rp<?= $item->hjual; ?></del></span>
										</div>
										<div class="harga-promo">
											<span class="detail">Rp<?= $item->hpromof; ?>
										</div>
										<?php else:?>
										<div class="harga">
											<span class="detail">Rp&nbsp<?= $item->hjual; ?>&nbsp,-</span>
										</div>
										<?php endif;?>
										<?php if($item->pnj): ?>
										<div class="dimensi">
											<span class="size"><?= $item->pnj; ?> x <?= $item->lbr; ?><?= ($item->tgi)?' x '.$item->tgi:''; ?></span>
										</div>
										<?php endif; ?>
										<div class="dimensi">
											<span class="size"><?= $item->kdbar; ?></span>
										</div>
										<div class="buyonline">
										<a href="<?php echo site_url('detail/'.$item->kdurl); ?>"><img class="buyonline" src="<?= site_url('images/buyonline.png'); ?>" alt="Cart" /></a>
										</div>
									</div>
									
								</div>
								
							</div>
							<?php } ?>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			<!--new-arrivals-->

			<!--Products-->
				<div class="product-agile">
					<div class="container">
						<h4 class="tittle1">Best Seller of The Month</h4>
						<div class="slider">
							<div class="callbacks_container">
								<ul class="rslides" id="slider">
									<li>	 
										<div class="caption">
											<?php
												foreach ($this->data['rnd_best'] as $item) {
											?>
											<div class="col-md-3 cap-left simpleCart_shelfItem">
												<div class="grid-arr">
													<div class="grid-arrival">
														<figure>		
															<a href="<?php echo site_url('detail/'.$item->kdurl); ?>">
																<div class="grid-img1">
																	<img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar);?>" class="img-responsive" alt="<?= $item->kdbar ?>">
																</div>
															</a>		
														</figure>	
													</div>
													<div class="dashboard">
														<span class="size"><?= $item->nama; ?></span>
														<?php if ($item->kriteria == 'P'):?>
														<div class="dimensi">
															<span class="size"><del>Rp<?= $item->hjual; ?></del></span>
														</div>
														<div class="harga-promo">
															<span class="detail">Rp<?= $item->hpromof; ?>
														</div>
														<?php else:?>
														<div class="harga">
															<span class="detail">Rp&nbsp<?= $item->hjual; ?>&nbsp,-</span>
														</div>
														<?php endif;?>
														<?php if($item->pnj): ?>
														<div class="dimensi">
															<span class="size"><?= $item->pnj; ?> x <?= $item->lbr; ?><?= ($item->tgi)?' x '.$item->tgi:''; ?></span>
														</div>
														<?php endif; ?>
														<div class="dimensi">
															<span class="size"><?= $item->kdbar; ?></span>
														</div>
														<div class="buyonline">
															<a href="<?php echo site_url('detail/'.$item->kdurl); ?>"><img class="buyonline" src="<?= site_url('images/buyonline.png'); ?>" alt="Buy online" /></a>
														</div>
													</div>
												</div>
											</div>
											<?php } ?>
											<div class="clearfix"></div>
										</div>
									</li>
									<li>	 
										<div class="caption">
											<?php
												foreach ($this->data['rnd_best2'] as $item) {
											?>
											<div class="col-md-3 cap-left simpleCart_shelfItem">
												<div class="grid-arr">
													<div class="grid-arrival">
														<figure>		
															<a href="<?php echo site_url('detail/'.$item->kdurl); ?>">
																<div class="grid-img">
																	<img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar);?>" class="img-responsive" alt="<?= $item->kdbar ?>">
																</div>
															</a>		
														</figure>	
													</div>
													<div class="dashboard">
													<span class="size"><?= $item->nama; ?></span>
														<?php if ($item->kriteria == 'P'):?>
														<div class="dimensi">
															<span class="size"><del>Rp<?= $item->hjual; ?></del></span>
														</div>
														<div class="harga-promo">
															<span class="detail">Rp<?= $item->hpromof; ?>
														</div>
														<?php else:?>
														<div class="harga">
															<span class="detail">Rp&nbsp<?= $item->hjual; ?>&nbsp,-</span>
														</div>
														<?php endif;?>
														<?php if($item->pnj): ?>
														<div class="dimensi">
															<span class="size"><?= $item->pnj; ?> x <?= $item->lbr; ?><?= ($item->tgi)?' x '.$item->tgi:''; ?></span>
														</div>
														<?php endif; ?>
														<div class="dimensi">
															<span class="size"><?= $item->kdbar; ?></span>
														</div>
														<div class="buyonline">
															<a href="<?php echo site_url('detail/'.$item->kdurl); ?>"><img class="buyonline" src="<?= site_url('images/buyonline.png'); ?>" alt="Buy online" /></a>
														</div>
													</div>
												</div>
											</div>
											<?php } ?>
											<div class="clearfix"></div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<!--Products-->
			<!--<div class="latest-w3">
				<div class="container">
					<h3 class="tittle1">Latest Fashion Trends</h3>
					<div class="latest-grids">
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img src="<?php echo site_url('images/l1.jpg'); ?>" class="img-responsive" alt="">
								<div class="latest-text">
									<h4>Men</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-50%</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img src="<?php echo site_url('images/l2.jpg'); ?>" class="img-responsive" alt="">
								<div class="latest-text">
									<h4>Shoes</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-20%</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img src="<?php echo site_url('images/l3.jpg'); ?>" class="img-responsive" alt="">
								<div class="latest-text">
									<h4>Women</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-50%</h4>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="latest-grids">
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img src="<?php echo site_url('images/l4.jpg'); ?>" class="img-responsive" alt="">
								<div class="latest-text">
									<h4>Watch</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-45%</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img src="<?php echo site_url('images/l5.jpg'); ?>" class="img-responsive" alt="">
								<div class="latest-text">
									<h4>Bag</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-10%</h4>
								</div>
							</div>
						</div>
						<div class="col-md-4 latest-grid">
							<div class="latest-top">
								<img src="<?php echo site_url('images/l6.jpg'); ?>" class="img-responsive" alt="">
								<div class="latest-text">
									<h4>Cameras</h4>
								</div>
								<div class="latest-text2 hvr-sweep-to-top">
									<h4>-30%</h4>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>-->
			<!--new-arrivals-->
			<!--best-seller-->
			<!--<div class="new-arrivals-w3agile">
				<div class="container">
					<h3 class="tittle1">Best Sellers</h3>
					<div class="arrivals-grids">
						<div class="col-md-3 arrival-grid simpleCart_shelfItem">
							<div class="grid-arr">
								<div class="grid-arrival">
									<figure>		
										<a href="single.html">
											<div class="grid-img">
												<img src="<?php echo site_url('images/p28.jpg'); ?>" class="img-responsive" alt="">
											</div>
											<div class="grid-img">
												<img src="<?php echo site_url('images/p27.jpg'); ?>" class="img-responsive" alt="">
											</div>			
										</a>		
									</figure>	
								</div>
								<div class="ribben">
									<p>NEW</p>
								</div>
								<div class="ribben1">
									<p>SALE</p>
								</div>
								<div class="block">
									<div class="starbox small ghosting"> </div>
								</div>
								<div class="women">
									<h6><a href="single.html">Sed ut perspiciatis unde</a></h6>
									<span class="size">XL / XXL / S </span>
									<p ><del>$100.00</del><em class="item_price">$70.00</em></p>
									<a href="#" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a>
								</div>
							</div>
						</div>
						<div class="col-md-3 arrival-grid simpleCart_shelfItem">
							<div class="grid-arr">
								<div class="grid-arrival">
									<figure>		
										<a href="single.html">
											<div class="grid-img">
												<img src="<?php echo site_url('images/p30.jpg'); ?>" class="img-responsive" alt="">
											</div>
											<div class="grid-img">
												<img src="<?php echo site_url('images/p29.jpg'); ?>" class="img-responsive" alt="">
											</div>			
										</a>		
									</figure>	
								</div>
								<div class="ribben2">
									<p>OUT OF STOCK</p>
								</div>
								<div class="block">
									<div class="starbox small ghosting"> </div>
								</div>
								<div class="women">
									<h6><a href="single.html">Sed ut perspiciatis unde</a></h6>
									<span class="size">XL / XXL / S </span>
									<p ><del>$100.00</del><em class="item_price">$70.00</em></p>
									<a href="#" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a>
								</div>
							</div>
						</div>
						<div class="col-md-3 arrival-grid simpleCart_shelfItem">
							<div class="grid-arr">
								<div class="grid-arrival">
									<figure>		
										<a href="single.html">
											<div class="grid-img">
												<img src="<?php echo site_url('images/s2.jpg'); ?>" class="img-responsive" alt="">
											</div>
											<div class="grid-img">
												<img src="<?php echo site_url('images/s1.jpg'); ?>" class="img-responsive" alt="">
											</div>			
										</a>		
									</figure>	
								</div>
								<div class="ribben1">
									<p>SALE</p>
								</div>
								<div class="block">
									<div class="starbox small ghosting"> </div>
								</div>
								<div class="women">
									<h6><a href="single.html">Sed ut perspiciatis unde</a></h6>
									<span class="size">XL / XXL / S </span>
									<p ><del>$100.00</del><em class="item_price">$70.00</em></p>
									<a href="#" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a>
								</div>
							</div>
						</div>
						<div class="col-md-3 arrival-grid simpleCart_shelfItem">
							<div class="grid-arr">
								<div class="grid-arrival">
									<figure>		
										<a href="single.html">
											<div class="grid-img">
												<img src="<?php echo site_url('images/s4.jpg'); ?>" class="img-responsive" alt="">
											</div>
											<div class="grid-img">
												<img src="<?php echo site_url('images/s3.jpg'); ?>" class="img-responsive" alt="">
											</div>			
										</a>		
									</figure>	
								</div>
								<div class="ribben">
									<p>NEW</p>
								</div>
								<div class="block">
									<div class="starbox small ghosting"> </div>
								</div>
								<div class="women">
									<h6><a href="single.html">Sed ut perspiciatis unde</a></h6>
									<span class="size">XL / XXL / S </span>
									<p ><del>$100.00</del><em class="item_price">$70.00</em></p>
									<a href="#" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>-->
			<!--new-arrivals-->
		</div>
		<!--content-->
