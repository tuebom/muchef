    <!--content-->
        <div class="content">
			  <div class="products-agileinfo">
				<!-- <h4 class="tittle1"><?php echo $this->data['title']; ?></h4> -->
				<div class="container">
				
					<div class="product-agileinfo-grids w3l">
						<div class="row">
						<h4 class="tittle1"><?php echo $this->data['title']; ?></h4>
						<div class="col-md-4 col-xs-12"></div>
						<div class="col-md-4 col-xs-12">
							<ul class="nav nav-product-pills nav-fill" style="width:100%; align-items:center; display: flex;">
								
								<li class="nav-item dropdown"><a class="cat dropdown-toggle" data-toggle="dropdown">Category</a>
									<ul class="dropdown-menu multi-column category" style="padding: 10px;">
										<div class="row">
											<?php 
												$index = 0;
												foreach ($golongan as $item) { 
													
													if ($item->kdgol !== $this->data['kdgol']) {
														continue;
													}
													$index++;
											
											?><div class="col-sm-3  multi-gd-img">
												<ul class="multi-column-dropdown">
													<!-- <h4><?=$item->nama?></h4> -->
													<?php foreach($this->data['item_'.$item->kdgol] as $detail) { ?><li><a class="category" href="<?= site_url('subcategories/'.$item->kdgol.'/'.$detail->kdgol2); ?>"><?= $detail->nama?></a></li>
													<?php } ?>
												</ul>
											</div>
											<?php break; } ?>
								
											<div class="clearfix"></div>
										</div>
									</ul>
								</li>
								<script>
								$( function() {
									
									$( "#slider-range" ).slider({
										range: true,
										min: <?php echo $price_range->hmin; ?>,
										max: <?php echo $price_range->hmax; ?>,
										values: [ <?php echo $price_range->hmin; ?>, <?= $price_range->hmax; ?> ],
										slide: function( event, ui ) {
											$( "#amount1" ).text( "Rp" + $( "#slider-range" ).slider( "values", 0 ).toLocaleString());
											$( "#amount2" ).text( "Rp" + $( "#slider-range" ).slider( "values", 1 ).toLocaleString());
											// load_product(ui.values[0], ui.values[1]);
										}
									});

									$( "#amount1" ).text( "Rp" + $( "#slider-range" ).slider( "values", 0 ).toLocaleString());
									$( "#amount2" ).text( "Rp" + $( "#slider-range" ).slider( "values", 1 ).toLocaleString());

									$( "#slider-range" ).mouseup(function(){
										
										var theUrl = <?php echo '"'.site_url().'search?q='.$kode.'"' ?>;
										var newUri = theUrl + "&p1=" + $( "#slider-range" ).slider( "values", 0 ) + "&p2=" + $( "#slider-range" ).slider( "values", 1 );
										location.href = newUri;
									});
								} );
								</script>
								
								<!-- https://jqueryui.com/slider/#range -->
								<li class="nav-item dropdown"><a class="cat dropdown-toggle" data-toggle="dropdown">Price</a>
									<ul class="dropdown-menu multi-column range">
										<p class="range">
											<label id="amount1">Rp0</label>
											<label id="amount2" class="pull-right">Rp0</label>
										</p>
										<div id="slider-range"></div>
									</ul>
								</li>
								
								<li class="nav-item dropdown"><a class="cat dropdown-toggle" data-toggle="dropdown">Brand</a>
									<ul class="dropdown-menu multi-column brand" style="padding: 10px;">
										<div class="row">
											<div class="col-sm-3  multi-gd-img">
												<ul class="multi-column-dropdown">
													<?php foreach($brands as $item) { ?><li><a class="brand" href="<?php echo site_url('search?q='.$this->data['kode'].'&b='.$item->name); ?>"><?=$item->name?></a></li>
													<?php } ?>
												</ul>
											</div>
								
											<div class="clearfix"></div>
										</div>
									</ul>
								</li>
							</ul>
						</div>
						<div class="col-md-4"></div>
						</div>

						<!-- content -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
								<?php
									
									foreach ($products as $item) {

								?>
									<div class="col-md-3 col-xs-12 product-tab-grid simpleCart_shelfItem">
										<div class="grid-arr">
											<div class="grid-arrival">
												<figure>		
													<a href="<?php echo site_url('detail/'.$item->kdurl); ?>" class="new-gri">
														<div class="grid-img">
															<img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar);?>" class="img-responsive" alt="<?= $item->kdbar; ?>">
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
												</div><?php endif; ?>
												<div class="dimensi">
													<span class="size"><?= $item->kdbar; ?></span>
												</div>
												<div class="buyonline">
													<a href="<?php echo site_url('detail/'.$item->kdurl); ?>"><img class="buyonline" src="<?= site_url('images/buyonline.png'); ?>" alt="Cart" /></a>
												</div>
											</div>

										</div>
									</div>
								<?php 
									}
								?>
							</div>
						</div>
						<div class="clearfix"> </div>
						<div class="box-footer" align="center">
							<?php echo $this->data['pagination']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!--content-->
