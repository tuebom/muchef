    <!--content-->
        <div class="content">
				<div class="products-agileinfo">
                    <h4 class="tittle1"><?php echo $this->data['title']; ?></h4>
					<div class="container">
						<div class="product-agileinfo-grids w3l">
						<?php
							foreach ($this->data['item_'.$this->data['kdgol2']] as $item) {
						?>
							<div class="col-md-3 col-sm-12 col-xs-12 product-tab-grid simpleCart_shelfItem">
								<div class="grid-arr-cat">
									<div class="grid-arrival">
										<figure>		
											<a href="<?= site_url('products/'.$item->kode); ?>" class="new-gri">
												<div class="grid-img">
													<img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar);?>" class="img-responsive" alt="<?= $item->gambar; ?>">
												</div>
											</a>		
										</figure>	
									</div>
									<div class="article-title"><?=$item->nama?></div>
									<a href="<?= site_url('products/'.$item->kode); ?>" class="new-gri">
										<div class="opacity-container">
											<div class="article-desc"><?=$item->info?></div>
										</div>
									</a>
								</div>
							</div>
						<?php 
							}
						?>
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
		<!--content-->
