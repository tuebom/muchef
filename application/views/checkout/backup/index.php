    <!--banner-->
		<!-- <div class="banner1">
			<div class="container">
				<h3><a href="<?php echo site_url(); ?>">Home</a> / <span>Checkout</span></h3>
			</div>
		</div> -->
	<!--banner-->

	<!--content-->
		<div class="content">
			<div class="cart-items">
				<div class="container">
                    <form id="frmSubmit" action="<?= site_url('checkout'); ?>" method="post">

                    <input type="hidden" name="mbrid" value="<?=isset($this->data['anggota']->id) ? $this->data['anggota']->id : '';?>">
                    <input type="hidden" name="submit1" value="submit">
                    <div class="col-md-7 col-sm-6 bill-detail">    
                        <h2><?= lang('checkout_billing_details') ?></h2>
                        <div class="row">
                            <div class="col-sm-6">    
                                <div class="form-group">
                                    <label for="firstname"><?= lang('checkout_first_name') ?></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?=isset($this->data['anggota']->first_name) ? $this->data['anggota']->first_name : '';?>" placeholder="Enter first name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">    
                                <div class="form-group">
                                    <label for="lastname"><?= lang('checkout_last_name') ?></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?=isset($this->data['anggota']->last_name)? $this->data['anggota']->last_name : '';?>" placeholder="Enter last name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">    
                                <div class="form-group">
                                    <label for="company"><?= lang('checkout_company') ?></label>
                                    <input type="text" class="form-control" id="company" name="company" value="<?=isset($this->data['anggota']->company)? $this->data['anggota']->company : '';?>" placeholder="Enter company name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">    
                                <div class="form-group">
                                    <label for="email"><?= lang('checkout_email') ?></label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?=isset($this->data['anggota']->email)? $this->data['anggota']->email : '';?>" placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-sm-6">    
                                <div class="form-group">
                                    <label for="phone"><?= lang('checkout_phone') ?></label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?=isset($this->data['anggota']->phone)? $this->data['anggota']->phone : '';?>" placeholder="Enter phone number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">    
                                <div class="form-group">
                                    <label for="province"><?= lang('checkout_province') ?></label>
                                    <select id="province" name="province" class="form-control">
                                        <option value="" selected>-</option>
                                        <?php
                                            foreach ($this->data['provinsi'] as $itemx) {
                                        ?>
                                        <option value="<?= $itemx->id ?>"<?php if( $itemx->id == $this->data['province'] ): ?> selected="selected"<?php endif; ?>><?= $itemx->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">    
                                <div class="form-group">
                                    <label for="regency"><?= lang('checkout_regency') ?></label>
                                    <select id="regency" name="regency" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">    
                                <div class="form-group">
                                    <label for="district"><?= lang('checkout_district') ?></label>
                                    <select id="district" name="district" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">    
                                <div class="form-group">
                                    <label for="zip"><?= lang('checkout_post_code') ?></label>
                                    <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Enter post code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">    
                                <div class="form-group">
                                    <label for="address1"><?= lang('checkout_address1') ?></label>
                                    <input type="text" class="form-control" id="address1" name="address1" value="<?=isset($this->data['anggota']->address1)? $this->data['anggota']->address1 : '';?>" placeholder="Enter address 1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">    
                                <div class="form-group">
                                    <label for="address2"><?= lang('checkout_address2') ?></label>
                                    <input type="text" class="form-control" id="address2" name="address2" value="<?=isset($this->data['anggota']->address2)? $this->data['anggota']->address2 : '';?>" placeholder="Enter address 2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">    
                                <div class="form-group">
                                    <label for="note"><?= lang('checkout_order_notes') ?></label>
                                    <input type="text" class="form-control" id="note" name="note" placeholder="Enter order notes">
                                </div>
                            </div>
                        </div>
                        <?php if (isset($this->data['message'])) :?>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php echo $this->data['message']; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-1">
                    </div>

                    <div class="col-md-4 col-sm-6 order">
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
                                    <input type="hidden" name="kdbar[]" value="<?= $item["kdbar"]; ?>">
                                    <input type="hidden" name="qty[]" value="<?= $item["qty"]; ?>">
                                    <input type="hidden" name="harga[]" value="<?= $item["harga"]; ?>">
                                    <input type="hidden" name="jumlah[]" value="<?= $item_price; ?>">
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

                        <div class="col-sm-6 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="<?php echo site_url('cart'); ?>">Back</a></div>
                        <div class="col-sm-6 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="javascript:void(0);" id="btnSubmit">Submit Order</a></div>
                    </div>
                    <input type="hidden" name="total" value="<?=$total_price?>">
                    <input type="hidden" name="shipcost" value="0">
                    </form>
				</div>
			</div>
		</div>
	<!-- content -->
	<script type="text/javascript">
    $(document).ready(function() {
        
        $('#btnSubmit').click(function(event) {
            event.preventDefault();
            $('#frmSubmit').submit();
            // alert('haloo');
        });
        
        $('#province').change(function(){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>checkout/regencies/"+$(this).val(),
                // dataType: "json",
                // data: {"id":$(this).val()},
                success:function(json){
                    var data = json.data,
                        firstid = data[0].id;

                    $('#regency').html('');
                    for (var i = 0; i < data.length; i++) {
                        $('#regency').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                    }

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url();?>checkout/districts/"+firstid,
                        // dataType: "json",
                        // data: {"id":$(this).val()},
                        success:function(json){
                            var data = json.data;
                            $('#district').html('');
                            for (var i = 0; i < data.length; i++) {
                                $('#district').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                            }
                        },
                    });
                },
            });
        });
        
        $('#regency').change(function(){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>checkout/districts/"+$(this).val(),
                success:function(json){
                    var data = json.data;
                    $('#district').html('');
                    for (var i = 0; i < data.length; i++) {
                        $('#district').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                    }
                },
            });
        });
    });
	</script>
