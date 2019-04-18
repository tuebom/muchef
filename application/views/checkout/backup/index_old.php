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
                    <form action="<?= site_url('submit'); ?>" method="post">
                    <input type="hidden" name="total" value="">
                    <input type="hidden" name="shipping" value="">

                    <div class="col-md-8">    
                        <h2>Billing Details</h2>
                        <div class="row">
                            <div class="col-sm-6">    
                                <div class="key"><i class="fa fa-user" aria-hidden="true"></i>
                                <input type="text" placeholder="First Name" name="firstname" required>
                                <div class="clearfix"></div></div>
                            </div>
                            <div class="col-sm-6">    
                                <div class="key"><i class="fa fa-user" aria-hidden="true"></i>
                                <input type="text" placeholder="Last Name" name="lastname" required>
                                <div class="clearfix"></div></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">    
                                <div class="key"><i class="fa fa-building" aria-hidden="true"></i>
                                <input type="text" placeholder="Company" name="company">
                                <div class="clearfix"></div></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">    
                                <div class="key"><i class="fa fa-envelope" aria-hidden="true"></i>
                                <input type="text" placeholder="Email" name="email">
                                <div class="clearfix"></div></div>
                            </div>
                            <div class="col-sm-6">    
                                <div class="key"><i class="fa fa-phone" aria-hidden="true"></i>
                                <input type="text" placeholder="Phone" name="phone">
                                <div class="clearfix"></div></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">    
                                <div class="key"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <input type="text" placeholder="Address 1" name="address1" required>
                                <div class="clearfix"></div></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">    
                                <div class="key"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <input type="text" placeholder="Address 2" name="address2">
                                <div class="clearfix"></div></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">    
                                <div class="key"><i class="fa fa-city" aria-hidden="true"></i>
                                <input type="text" placeholder="City" name="city" required>
                                <div class="clearfix"></div></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">    
                                <div class="key"><i class="fa fa-" aria-hidden="true"></i>
                                <input type="text" placeholder="State/Province" name="province">
                                <div class="clearfix"></div></div>
                            </div>
                            <div class="col-sm-6">    
                                <div class="key"><i class="fa fa-" aria-hidden="true"></i>
                                <input type="text" placeholder="Zip" name="zip">
                                <div class="clearfix"></div></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">    
                                <div class="key"><i class="fa fa-" aria-hidden="true"></i>
                                <input type="text" placeholder="Order Notes" name="note">
                                <div class="clearfix"></div></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
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
                                    <td><b>Total</b></td>
                                    <td class="text-right"><b>Rp<?= number_format($total_price, 0, '.', ',') ?></b></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="col-sm-6 checkout-right-basket2"><a class="checkout-right-basket2" href="<?php echo site_url('cart'); ?>">Back</a></div>
                        <div class="col-sm-6 checkout-right-basket2"><a class="checkout-right-basket2" href="<?php echo site_url('submit'); ?>">Submit Order</a></div>
                    </div>
                    </form>
				</div>
			</div>
		</div>
	<!-- content -->
