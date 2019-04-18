	<!--content-->
		<div class="content">
			<div class="cart-items">
				<div class="container">
					<?php

					if(!isset($_SESSION["cart_item"])) { ?>
					<h2>Cart is empty</h2>
					<?php } else {
						
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
									<th>&nbsp;No.&nbsp;</th>
									<th>Product Code</th>
									<th>Product</th>
									<th>Product Name</th>
									<th>Product Size (CM)</th>
									<th>&nbsp;Qty&nbsp;</th>
									<th>Amount</th>
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
									<td class="invert"><?= $item["kdbar"] ?></td>
									<td class="invert-image">
										<a href="<?= site_url('detail/'.$item["kdurl"]) ?>">
											<img src="<?= site_url($this->data['products_dir'].'/'.$item["gambar"]); ?>" alt="<?= $item["kdbar"] ?>" class="img-responsive">
										</a>
									</td>
									<td class="invert"><?= $item["nama"]; ?></td>
									<td class="invert">P: <?= $item["pnj"]; ?><br>L: <?= $item["lbr"]; ?><br>T: <?= $item["tgi"]; ?></td>
									<td class="invert">
										<div class="quantity">
											<span><?= $item["qty"]; ?></span>
										</div>
									</td>
									<td class="price invert">Rp<?= number_format($item_price, 0, ',', '.') ?></td>
									<td class="invert">
										<div class="rem">
											<div class="close"> </div>
										</div>
									</td>
								</tr>
							<?php } /* end foreach***/ ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="5" style="text-align: right"><b>Total</b></td>
									<td><?= $total_qty ?></td>
									<td class="price">Rp<?= number_format($total_price, 0, ',', '.') ?></td>
									<td></td>
								</tr>
							</tfoot>
						</table>
					<?php  endif; } /* end if */ ?>
					</div>
					<?php if(isset($_SESSION["cart_item"])):
						if (count($_SESSION["cart_item"]) > 0) {
					?>
					<div class="checkout-right-basket">
						<a href="<?php echo site_url('checkout'); ?>">Proceed to Checkout</a>
					</div>
					<?php } endif; ?>
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
