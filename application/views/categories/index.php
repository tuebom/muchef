    <!--content-->
        <div class="content">
				<div class="products-agileinfo">
                    <h4 class="tittle1"><?php echo $this->data['title']; ?></h4>
					<div class="container">
						<div class="product-agileinfo-grids w3l">
							<div class="col-md-3 product-agileinfo-grid">
								<label class="search">Show results for</label>
								<div class="categories">

									<label class="title">Categories</label>
									<!--<ul>
										<li><input type="checkbox" id="item-001" /><label class="search" for="item-001"><span></span><b>Categories</b></label>-->
											<ul class="tree-list-pad">
												<?php
													$index = 0;
													foreach ($this->data['golongan'] as $item) {
														
														if ($item->kdgol !== $this->data['kdgol']) {
															continue;
														}
														$index++;
												?>
												<li><input type="checkbox" id="item-<?=$index?>" /><label class="tree" for="item-<?=$index?>"><span></span><?= $item->nama ?></label>
													<ul>
														<?php foreach ($this->data['item_'.$item->kdgol] as $detail) { ?>
														<li class="item"><input type="checkbox" id="item-<?=$index?>-0" />
														<?php if ($item->max_level == 3) : ?>
															<a href="<?php echo site_url('subcategories/'.$item->kdgol.'/'.$detail->kdgol2); ?>"><?= $detail->nama?></a>
														<?php else : ?>
															<a href="<?php echo site_url('products/'.$item->kdgol.'/'.$detail->kdgol2); ?>"><?= $detail->nama?></a>
														<?php endif; ?>
														</li>
														<?php } ?>
													</ul>
												</li>
												<?php break; /*$index++;*/ } ?>
											</ul>
										<!--</li>
									</ul>-->
								</div>
								<div class="price">
									<label class="title">Price</label>

									<ul>
										<li><a href="<?php echo site_url('search?q='.$this->data['kode'].'&p1=0&p2=999999'); ?>">Under Rp1.000.000</a></li>
										<li><a href="<?php echo site_url('search?q='.$this->data['kode'].'&p1=1000000&p2=5000000'); ?>">Rp1.000.000 to Rp5.000.000</a></li>
										<li><a href="<?php echo site_url('search?q='.$this->data['kode'].'&p1=5000000&p2=10000000'); ?>">Rp5.000.000 to Rp10.000.000</a></li>
										<li><a href="<?php echo site_url('search?q='.$this->data['kode'].'&p1=10000000'); ?>">Rp10.000.000 Above</a></li>
										<li><input id="pf" type="text" class="pricef" onkeypress="return isNumber(event)">&nbsp;-&nbsp;
										<input id="pt" type="text" class="pricef" onkeypress="return isNumber(event)">
										<a id="btnGo" href="<?php echo site_url('search'); ?>" class="btn-go">GO</a></li>
									</ul>
									
									<script type="text/javascript">
										
										function isNumber(evt) {
											evt = (evt) ? evt : window.event;
											var charCode = (evt.which) ? evt.which : evt.keyCode;
											if (charCode > 31 && (charCode < 48 || charCode > 57)) {
												return false;
											}
											return true;
										}
										
										var theUrl = <?php echo '"'.site_url().'search?q='.$this->data['kode'].'"' ?>;

										$('#btnGo').click(function(event) {
											event.preventDefault();
											var p1 = document.getElementById('pf').value;
											var p2 = document.getElementById('pt').value;
											if (p1 == '' || p2 == '') {
												return false;
											}
											var newUri = theUrl + '&p1='+p1+'&p2='+p2;
											$(this).attr("href", newUri);
											window.location.href = $(this).attr('href');
										});
									
									</script>
									 
								</div>
								<div class="brand-w3l">
									<label class="title">Brand</label> <!-- display all brand -->
									<ul>
										<?php foreach($brands as $item) { ?>
										<li><a href="<?php echo site_url('search?q='.$this->data['kode'].'&b=GEA'); ?>">GEA</a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<div class="col-md-9 product-agileinfon-grid1 w3l">
								<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
									<div id="myTabContent" class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
											<?php
												
												echo '<!-- rec. count: '. count($this->data['item_'.$this->data['kdgol']]) . ' -->'; 

												$index = 0;
												$icount = 0;
												$iloop = 1;

												foreach ($this->data['item_'.$this->data['kdgol']] as $item) {

													if ($index == 3) $index = 0;

													if ($index == 0) { // buat tab product baru

											?>
											<div class="product-tab">
											<?php echo '<!-- prod-tab-'.$iloop. ' -->'; ?>
											<?php
													}

													if ($index < 3) {
											?>
												<div class="col-md-4 product-tab-grid simpleCart_shelfItem">
													<div class="grid-arr-cat">
														<div class="grid-arrival">
															<figure>		
																<a href="<?= site_url('subcategories/'.$item->kdgol.'/'.$item->kdgol2); ?>" class="new-gri">
																	<div class="grid-img">
																		<img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar);?>" class="img-responsive" alt="<?= $item->kdbar; ?>">
																	</div>
																</a>		
															</figure>	
														</div>
														<div class="article-title"><?=$item->nama?></div>
														<a href="<?= site_url('subcategories/'.$item->kdgol.'/'.$item->kdgol2); ?>" class="new-gri">
															<div class="opacity-container">
																<div class="article-desc"><?=$item->info?></div>
															</div>
														</a>
													</div>
												</div>
											<?php 
													$index++;
													$icount++;
												}
												
												if ($index == 3 || $icount == count($this->data['item_'.$this->data['kdgol']])) :
													$iloop++;
											?>
												<div class="clearfix"></div>
											</div>
											<?php
												endif;
											}
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
		<!--content-->
