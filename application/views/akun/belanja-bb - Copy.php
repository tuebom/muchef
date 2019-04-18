				<div class="col-md-9">
                    <div class="row">
                        <ul class="nav nav-page nav-fill">
                            <li class="nav-item"><a href="#" class="nav-link active">Belum Bayar</a></li>
                            <li class="nav-item"><a href="<?php echo site_url('akun?p=bk'); ?>" class="nav-link">Belum Dikirimkan</a></li>
                            <li class="nav-item"><a href="<?php echo site_url('akun?p=bt'); ?>" class="nav-link">Belum Diterima</a></li>
                            <li class="nav-item"><a href="<?php echo site_url('akun?p=bs'); ?>" class="nav-link">Selesai</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        
                        <div class="table-responsive">
                            <table class="timetable_sub">
                                <!-- <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Name</th>
                                        <th>&nbsp;Qty&nbsp;</th>
                                        <th>Price</th>
                                    </tr>
                                </thead> -->
                                <tbody>
                            <?php 
                            foreach ($this->data['detil'] as $item) {
                            ?>
								<tr class="rem">
									<td class="invert-image">
                                        <img src="<?= site_url($this->data['products_dir'].'/'.$item->gambar); ?>" alt="<?= $item->kdbar ?>" class="img-responsive">
									</td>
									<td class="invert"><?= $item->nama; ?></td>
									<td class="invert">
										<div class="quantity">
											<span><?= $item->qty; ?></span>
										</div>
									</td>
									<td class="price invert">Rp<?= number_format($item_price, 0, ',', '.') ?></td>
								</tr>
                            <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
				</div>
			</div>
		</div>
	</div>
	<!--content-->
