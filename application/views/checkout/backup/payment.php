	<!--content-->
		<div class="content">
			<div class="cart-items">
				<div class="container">
                    <form id="frmPayment" action="<?= site_url('checkout?action=submit'); ?>" method="post">

                    <input type="hidden" name="mbrid" value="<?=isset($this->data['anggota']->id) ? $this->data['anggota']->id : '';?>">
                    <input type="hidden" name="submit1" value="submit">
                    <div class="col-md-7 col-sm-8 bill-detail">
                        <div>
                            <ul class="nav nav-pills nav-fill">
                                <li class="nav-item"><a href="#" class="nav-link disabled"> <i class="fa fa-map-marker"></i><br>Address</a></li>
                                <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-truck"></i><br>Delivery Method</a></li>
                                <li class="nav-item"><a href="#" class="nav-link active"><i class="fa fa-money"></i><br>Payment Method</a></li>
                            </ul>

                            <div class="row">
                                <div class="col-sm-6">    
                                    <div class="box shipping-method">
                                        <h4>Direct bank transfer</h4>
                                        <p>Make your payment directly into our bank account.</p>
                                        <div class="box-footer text-center">
                                            <input type="radio" name="payment" value="transfer"<?php if(isset($_SESSION['payment'])){ if($_SESSION['payment'] == 'transfer') echo 'checked="checked"'; } else { echo 'checked="checked"'; } ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">    
                                    <div class="box shipping-method">
                                        <h4>Cash On Delivery</h4>
                                        <p>&nbsp;</p>
                                        <div class="box-footer text-center">
                                            <input type="radio" name="payment" value="cod"<?php if(isset($_SESSION['payment'])){ if($_SESSION['payment'] == 'cod') echo 'checked="checked"'; } ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">    
                                    <div class="box shipping-method">
                                        <h4>Paypal</h4>
                                        <p>Make your payment via paypal account.</p>
                                        <div class="box-footer text-center">
                                            <input type="radio" name="payment" value="paypal"<?php if(isset($_SESSION['payment'])){ if($_SESSION['payment'] == 'paypal') echo 'checked="checked"'; } ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="<?= site_url('checkout?tab=delivery'); ?>">Back to Delivery Method</a></div>
                        <div class="col-sm-6 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="javascript:void(0);" id="btnSubmit">Place the Order</a></div>
                    </div>

                    <div class="col-md-1">
                    </div>

                    <div class="col-md-4 col-sm-4 order">
                        <h2>Your Order</h2>
                        <table class="table table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $item_price = 0;
                                    $total_price = 0;

                                    foreach ($_SESSION["cart_item"] as $item) {

                                        $item_price  = (float)$item["qty"]*$item["harga"];
                                        $total_price += $item_price;
                                ?>
                                <tr>
                                    <!-- <input type="hidden" name="kdbar[]" value="<?= $item["kdbar"]; ?>">
                                    <input type="hidden" name="qty[]" value="<?= $item["qty"]; ?>">
                                    <input type="hidden" name="harga[]" value="<?= $item["harga"]; ?>">
                                    <input type="hidden" name="jumlah[]" value="<?= $item_price; ?>"> -->
                                    <td><?= $item["nama"]; ?></td>
                                    <td class="text-right">Rp<?= number_format($item_price, 0, '.', ',') ?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><b>Subtotal</b></td>
                                    <td class="text-right"><b>Rp<?= number_format($total_price, 0, '.', ',') ?></b></td>
                                </tr>
                                <tr>
                                    <td><b>Shipping</b></td>
                                    <td class="text-right"><b>0</b></td>
                                </tr>
                                <tr>
                                    <td><b>Tax</b></td>
                                    <td class="text-right"><b>0</b></td>
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td class="text-right"><b>Rp<?= number_format($total_price, 0, '.', ',') ?></b></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <input type="hidden" name="total" value="<?=$total_price?>">
                    <input type="hidden" name="shipcost" value="0">
                    <input type="hidden" name="tax" value="0">
                    </form>
				</div>
			</div>
		</div>
	<!-- content -->
	<script type="text/javascript">
    $(document).ready(function() {
        
        $('#btnSubmit').click(function(event) {
            event.preventDefault();
            $('#frmPayment').submit();
        });
    });
	</script>
