    <!--banner-->
		<div class="banner1">
			<div class="container">
				<h3><a href="<?php echo site_url(); ?>">Home</a> / <span>Checkout</span></h3>
			</div>
		</div>
	<!--banner-->

	<!--content-->
		<div class="content">
			<div class="cart-items">
				<div class="container">
					<?php

					if(isset($_SESSION["cart_item"])){
						
						$total_qty = 0;
						$item_price = 0;
						$total_price = 0;

						if (count($_SESSION["cart_item"]) == 0):
					?>
					<h2>Cart is empty</h2>
					<?php else: ?>
					<h2>My Shopping Cart (<?= $_SESSION["totqty"] ?>)</h2>
					<?php endif;
					
					if (count($_SESSION["cart_item"]) > 0):

					?>
					<div class="table-responsive">
						<table class="timetable_sub">
							<thead>
								<tr>
									<th>SL No.</th>
									<th>Product</th>
									<th>Quantity</th>
									<th>Product Name</th>
									<th>Price</th>
									<th>Remove</th>
								</tr>
							</thead>
							<tbody>
					<?php

								$index = 0;

								foreach ($_SESSION["cart_item"] as $item){

									$item_price  = (float)$item["qty"]*$item["harga"];
									$total_price += $item_price;
									
									// count total item
									$total_qty  += $item["qty"];

									$index++;

							?>
								<tr class="rem">
									<form class="formRem" action="<?= site_url('cart/remove'); ?>" method="post">
									<input type="hidden" name="kode" value="<?= $item["kdbar"] ?>">
									<input type="hidden" name="qty" value="<?= $item["qty"] ?>">
									<input type="hidden" name="harga" value="<?= $item["harga"] ?>">
									</form>

									<td class="invert"><?= $index ?></td>
									<td class="invert-image">
										<a href="<?= site_url('detail/'.$item["kdurl"]) ?>">
											<img src="<?= site_url($this->data['products_dir'].'/'.$item["gambar"]); ?>" alt="<?= $item["kdbar"] ?>" class="img-responsive">
										</a>
									</td>
									<td class="invert"><?= $item["nama"]; ?></td>
									<td class="invert">
										<div class="quantity">
											<span><?= $item["qty"]; ?></span>
										</div>
									</td>
									<td class="invert">Rp<?= number_format($item_price, 0, '.', ',') ?></td>
									<td class="invert">
										<div class="rem">
											<div class="close"> </div>
										</div>
									</td>
								</tr>
							<?php } /* end foreach*/ ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3" style="text-align: right"><b>Total</b></td>
									<td><?= $total_qty ?></td>
									<td>Rp<?= number_format($total_price, 0, '.', ',') ?></td>
									<td></td>
								</tr>
							</tfoot>
						</table>
					<?php  endif; } /* end if */ ?>
					</div>
				</div>
			</div>
		</div>
	<!-- checkout -->
	<script>
		$(document).ready(function (c) {
			$('.close').on('click', function (c) {
				$(this).parents(".rem").find('.formRem')[0].submit();
			});
		});
	</script>
	