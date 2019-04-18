	<!--content-->
		<div class="content">
			<div class="cart-items">
				<div class="container">
                    <form id="frmDelivery" action="<?= site_url('checkout?action=submit'); ?>" method="post">

                    <input type="hidden" name="mbrid" value="<?=isset($this->data['anggota']->id) ? $this->data['anggota']->id : '';?>">
                    <input type="hidden" name="submit1" value="submit">
                    <div class="col-md-7 col-sm-8 bill-detail">
                        <div>
                            <ul class="nav nav-pills nav-fill">
                                <li class="nav-item"><a href="#" class="nav-link disabled"> <i class="fa fa-map-marker"></i><br>Address</a></li>
                                <li class="nav-item"><a href="#" class="nav-link active"><i class="fa fa-truck"></i><br>Delivery Method</a></li>
                                <!-- <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-money"></i><br>Payment Method</a></li> -->
                            </ul>

                            <div class="row">
                                <div class="col-sm-12">    
                                    <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item deli"><h4>Domestic Freight</h4>
                                        <div><input type="radio" class="delivery" name="delivery" value="DOMESTIC"<?php if(isset($_SESSION['delivery'])){ if($_SESSION['delivery'] == 'DOM') echo 'checked="checked"'; } else { echo 'checked="checked"'; }?>></div>
                                    </li>
                                    <li class="list-group-item deli"><!--<h4>JNE</h4>-->
                                        <img src="<?=base_url('images/jne.png');?>">
                                        <div><input type="radio" class="delivery" name="delivery" value="JNE"<?php if(isset($_SESSION['delivery'])){ if($_SESSION['delivery'] == 'JNE') echo 'checked="checked"'; }?>></div>
                                    </li>
                                    <li class="list-group-item deli"><!--<h4>J&amp;T</h4>-->
                                        <img src="<?=base_url('images/jnt.png');?>">
                                        <div><input type="radio" class="delivery" name="delivery" value="J&T"<?php if(isset($_SESSION['delivery'])){ if($_SESSION['delivery'] == 'JNT') echo 'checked="checked"'; }?>></div>
                                    </li>
                                    </ul>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-4 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="<?= site_url('checkout'); ?>">Back to Address</a></div>
                        <div class="col-md-6 col-sm-8 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="javascript:void(0);" id="btnSubmit">Mail Order</a></div>
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
                                    $item_price  = 0;
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
            $('#frmDelivery').submit();
        });
    });
	</script>
