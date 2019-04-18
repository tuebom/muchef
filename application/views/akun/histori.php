				<div class="col-md-9 col-sm-9">
                    <div class="row">
                        <div class="box box-primary histori">
                            <div class="box-body table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th class="text-right">Qty</th>
                                        <th class="text-right">Price</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php if( count($detil) > 0) { ?>
                                        <tr>
                                            <?php 
                                                $total = 0;
                                                foreach ( $detil as $item) {
                                                    $total += $item->jumlah;
                                            ?>
                                            <td>#<?= $item->id?></td>
                                            <td><?= $item->tglinput?></td>
                                            <td>
                                                <div class="product-img">
                                                    <img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar)?>" alt="Image">
                                                </div>
                                            </td>
                                            <td><a class="product-title promo" href="<?= site_url('detail/'.$item->kdurl); ?>"><?=$item->nama . '<br>('. $item->kdbar .')'?></a></td>
                                            <td class="text-right"><?= $item->qty?></td>
                                            <td class="text-right">Rp<?=number_format($item->hjual, 0, ',', '.')?></td>
                                            <td class="text-right">Rp<?=number_format($item->jumlah, 0, ',', '.')?></td>
                                            <!-- /.item -->
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	<!--content-->
