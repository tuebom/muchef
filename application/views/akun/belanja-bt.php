				<div class="col-md-9 col-sm-9">
                    <div class="row">
                        <ul class="nav nav-page nav-fill">
                            <li class="nav-item"><a href="<?php echo site_url('akun?p=pending'); ?>" class="nav-link">Belum Bayar</a></li>
                            <li class="nav-item"><a href="<?php echo site_url('akun?p=process'); ?>" class="nav-link">Belum Dikirimkan</a></li>
                            <li class="nav-item"><a href="#" class="nav-link active">Belum Diterima</a></li>
                            <li class="nav-item"><a href="<?php echo site_url('akun?p=finish'); ?>" class="nav-link">Selesai</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="box box-primary items">
                            <div class="box-body items">
                                <?php if( count($detil) > 0) { ?>
                                <ul class="products-list product-list-in-box">
                                <?php 
                                        $total = 0;
                                        foreach ( $detil as $item) {
                                            $total += $item->jumlah;
                                    ?>
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar)?>" alt="Image">
                                        </div>
                                        <div class="product-info">
                                            <a class="product-title promo" href="<?= site_url('detail/'.$item->kdurl); ?>"><?=$item->nama . ' ('. $item->kdbar .')'?></a>
                                            <span class="label label-success pull-right">Rp<?=number_format($item->jumlah, 0, ',', '.')?></span></a><br>
                                            <span class="product-description">Qty: <?=$item->qty?></span>
                                        </div>
                                    </li>
                                    <!-- /.item -->
                                    <?php } ?>
                                </ul>
                                <?php } ?>
                            </div>
                            <div class="box-body" style="float: right;">
                            <?php if( count($detil) > 0) { ?>
                                <span class="description-text">TOTAL PESANAN: <b>Rp<?=number_format($total, 0, ',', '.')?></b></span>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!--content-->
