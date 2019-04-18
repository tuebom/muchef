	<!--content-->
		<div class="content" style="background-color:lightgrey;">
			<div class="cart-items">
				<div class="container">
                    <form id="frmAddress" action="<?= site_url('checkout?tab=delivery'); ?>" method="post">

                    <input type="hidden" name="mbrid" value="<?=isset($this->data['anggota']->id) ? $this->data['anggota']->id : '';?>">
                    <input type="hidden" name="submit1" value="submit">
                    <div class="col-md-7 col-sm-8 bill-detail">
                        <div>
                            <ul class="nav nav-pills nav-fill">
                                <li class="nav-item"><a href="#" class="nav-link active"> <i class="fa fa-map-marker"></i><br>Address</a></li>
                                <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-truck"></i><br>Delivery Method</a></li>
                                <!-- <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-money"></i><br>Payment Method</a></li> -->
                            </ul>

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
                                <div class="col-sm-12">    
                                    <div class="form-group">
                                        <label for="address"><?= lang('checkout_address') ?></label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?=isset($_SESSION["address"])? $_SESSION["address"] : '';?>" placeholder="Enter address" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">    
                                    <div class="form-group">
                                        <label for="province"><?= lang('checkout_province') ?></label>
                                        <select id="province" name="province" class="form-control">
                                            <option value=""<?=isset($_SESSION['province'])?'': ' selected';?>>-</option>
                                            <?php
                                                foreach ($this->data['provinsi'] as $itemx) {
                                                    if (isset($_SESSION['province']))
                                                    {
                                            ?>
                                            <option value="<?= $itemx->id ?>"<?php if( $itemx->id == $_SESSION['province'] ): ?> selected="selected"<?php endif; ?>><?= $itemx->name ?></option>
                                            <?php   } else { ?>
                                            <option value="<?= $itemx->id ?>"><?= $itemx->name ?></option>
                                            <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">    
                                    <div class="form-group">
                                        <label for="regency"><?= lang('checkout_regency') ?></label>
                                        <select id="regency" name="regency" class="form-control">
                                        <?php
                                            if (isset($this->data['kabupaten'])) :
                                                foreach ($this->data['kabupaten'] as $item) {
                                        ?>
                                        <option value="<?= $item->id ?>"<?php if( $_SESSION["regency"] == $item->id ): ?> selected="selected"<?php endif; ?>><?= $item->name ?></option>
                                        <?php   }
                                            endif;
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">    
                                    <div class="form-group">
                                        <label for="district"><?= lang('checkout_district') ?></label>
                                        <select id="district" name="district" class="form-control">
                                        <?php
                                            if (isset($this->data['kecamatan'])) :
                                                foreach ($this->data['kecamatan'] as $item) {
                                        ?>
                                        <option value="<?= $item->id ?>"<?php if( $_SESSION["district"] == $item->id ): ?> selected="selected"<?php endif; ?>><?= $item->name ?></option>
                                        <?php   }
                                            endif;
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">    
                                    <div class="form-group">
                                        <label for="zip"><?= lang('checkout_post_code') ?></label>
                                        <input type="text" class="form-control" id="post_code" name="post_code" value="<?=isset($_SESSION["post_code"])? $_SESSION["post_code"] : '';?>" placeholder="Enter post code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">    
                                    <div class="form-group">
                                        <label for="phone"><?= lang('checkout_phone') ?></label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?=isset($this->data['anggota']->phone)? $this->data['anggota']->phone : '';?>" placeholder="Enter phone number">
                                    </div>
                                </div>
                                <div class="col-sm-6">    
                                    <div class="form-group">
                                        <label for="email"><?= lang('checkout_email') ?></label>
                                        <input type="text" class="form-control" id="email" name="email" value="<?=isset($this->data['anggota']->email)? $this->data['anggota']->email : '';?>" placeholder="Enter email address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">    
                                    <div class="form-group">
                                        <label for="note"><?= lang('checkout_order_notes') ?></label>
                                        <input type="text" class="form-control" id="note" name="note" value="<?=isset($_SESSION["note"])? $_SESSION["note"] : '';?>" placeholder="Enter order notes">
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
                        <div class="col-md-6 col-sm-5 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="<?php echo site_url(); ?>">Back</a></div>
                        <div class="col-md-6 col-sm-7 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="javascript:void(0);" id="btnSubmit">Continue to Delivery Method</a></div>
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
            $('#frmAddress').submit();
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
