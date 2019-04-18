    <!--content-->
        <div class="content">
				<div class="products-agileinfo">
					<h4 class="tittle1">Promotions</h4>
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
												<?php } ?>
											</ul>
										<!--</li>
									</ul>-->
								</div>
								<div class="price">
									<label class="title">Price</label>

									<ul>
										<li><a href="<?php echo site_url('search?p1=0&p2=999999'); ?>">Under Rp1.000.000</a></li>
										<li><a href="<?php echo site_url('search?p1=1000000&p2=5000000'); ?>">Rp1.000.000 to Rp5.000.000</a></li>
										<li><a href="<?php echo site_url('search?p1=5000000&p2=10000000'); ?>">Rp5.000.000 to Rp10.000.000</a></li>
										<li><a href="<?php echo site_url('search?p1=10000000'); ?>">Rp10.000.000 Above</a></li>
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
										
										var theUrl = <?php echo '"'.site_url().'search?"' ?>;

										$('#btnGo').click(function(event) {
											event.preventDefault();
											var p1 = document.getElementById('pf').value;
											var p2 = document.getElementById('pt').value;
											if (p1 == '' || p2 == '') {
												return false;
											}
											var newUri = theUrl + 'p1='+p1+'&p2='+p2;
											$(this).attr("href", newUri);
											window.location.href = $(this).attr('href');
										});
									
									</script>
									 
								</div>
								<div class="brand-w3l">
									<label class="title">Brand</label> <!-- display all brand -->
									<ul>
										<?php foreach($brands as $item) { ?>
										<li><a href="<?php echo site_url('search?b='.$item->name); ?>"><?=$item->name?></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<div class="col-md-9 product-agileinfon-grid1 w3l">
								<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
									<?php if (count($this->data['products']) > 0): ?>
									<ul id="myTab" class="nav1 nav1-tabs left-tab" role="tablist">
										<ul id="myTab" class="nav nav-tabs left-tab" role="tablist">
									<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><img src="<?=base_url('images/menu4.png');?>"></a></li>
									<li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile"><img src="<?=base_url('images/menu1.png');?>"></a></li>
									</ul>
									<?php endif; ?>
									<div id="myTabContent" class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
											<?php
												
												echo '<!-- rec. count: '. count($this->data['products']) . ' -->'; 

												$index = 0;
												$icount = 0;
												$iloop = 1;

												foreach ($this->data['products'] as $item) {

													if ($index == 4) $index = 0;

													if ($index == 0) { // buat tab product baru

											?>
											<div class="product-tab">
											<?php echo '<!-- prod-tab-'.$iloop. ' -->'; ?>
											<?php
													}

													if ($index < 4) {
											?>
												<div class="col-md-3 product-tab-grid simpleCart_shelfItem">
													<div class="grid-arr">
														<div class="grid-arrival">
															<figure>		
																<a href="<?php echo site_url('detail/'.$item->kdurl); ?>" class="new-gri">
																	<div class="grid-img">
																		<img src="<?=base_url($this->data['products_dir'].'/'.$item->gambar);?>" class="img-responsive" alt="<?= $item->kdbar; ?>">
																	</div>
																</a>
															</figure>	
														</div>
														<div class="ribben">
															<p>-<?=$item->diskon;?>%</p>
														</div>
														<!-- <div class="block">
															<div class="starbox small ghosting unchangeable"> </div>
														</div> -->
														<div class="women">
															<span class="size"><?= $item->nama; ?></span>
															<?php if($item->pnj): ?>
															<span class="size"><?= $item->pnj; ?> x <?= $item->lbr; ?> x <?= $item->tgi; ?> CM</span>
															<?php endif; ?>
															<span class="detail"><del>Rp<?= $item->hjual; ?></del><a href="<?= current_url().'?action=add&code='.$item->kdurl ?>" class="my-cart-search item_add"><img src="<?= site_url('images/bag.png'); ?>" alt="Cart" /></a><!--<a href="<?php echo site_url('detail/'.$item->kdurl); ?>" class="my-cart-d item_add">Detail</a>--></span>
															<span class="detail2">Rp<?= $item->hpromo; ?></span>
														</div>
													</div>
												</div>
											<?php 
													$index++;
													$icount++;
												}
												
												if ($index == 4 || $icount == count($this->data['products'])) :
													$iloop++;
											?>
												<div class="clearfix"></div>
											</div>
											<?php
												endif;
											}
											?>
										</div>
										<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
											<?php
												foreach ($this->data['products'] as $item) {
											?>
											<div class="product-tab1">
												<div class="col-md-3 product-tab1-grid">
													<div class="grid-arr">
														<div class="grid-arrival">
															<figure>		
																<a href="<?php echo site_url('detail/'.$item->kdurl); ?>" class="new-gri">
																	<div class="grid-img">
																		<img src="<?=base_url($this->data['products_dir'].'/'.$item->gambar);?>" class="img-responsive" alt="<?= $item->kdbar; ?>">
																	</div>
																</a>		
															</figure>	
														</div>
														<div class="women">
															<p ><em class="item_price">Rp<?= $item->hjual; ?></em></p>
															<span class="size"><?= $item->nama; ?></span>
															<?php if($item->pnj): ?>
															<span class="size"><?= $item->pnj; ?> x <?= $item->lbr; ?> x <?= $item->tgi; ?> CM</span>
															<?php endif; ?>
															<!--<span class="detail"><a href="<?php echo site_url('detail/'.$item->kdurl); ?>" class="my-cart-d item_add">Detail</a></span>-->
														</div>
													</div>
												</div>
												<div class="col-md-9 product-tab1-grid1 simpleCart_shelfItem">
													<!-- <div class="block">
														<div class="starbox small ghosting unchangeable"> </div>
													</div> -->
													<div class="women">
														<h6><a href="<?php echo site_url('detail/'.$item->kdurl); ?>"><?= $item->kdbar; ?></a></h6>
														<?php if($item->pnj): ?>
														<span class="size"><?= $item->pnj; ?> x <?= $item->lbr; ?> x <?= $item->tgi; ?> CM</span>
														<?php endif; ?>
														<p><?= $item->deskripsi; ?></p>
														<p><em class="item_price">Rp<?= $item->hjual; ?></em></p>
														<a href="<?= current_url().'?action=add&code='.$item->kdurl ?>" class="my-cart-detil item_add"><img src="<?= site_url('images/bag.png'); ?>" alt="Cart" /></a>&nbsp;
														<a href="<?php echo site_url('detail/'.$item->kdurl); ?>" class="my-cart-detil item_add">Detail</a>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
											<?php } ?>
											
										</div>
									</div>
								</div>
								<div class="box-footer" align="center">
									<?php echo $this->data['pagination']; ?>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
		<!--content-->
