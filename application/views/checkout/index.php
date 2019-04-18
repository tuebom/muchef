	<!--content-->
		<div class="content" style="background-color:lightgrey;">
			<div class="cart-items">
				<div class="container">
                    <form id="frmOrder" method="post">
                    <input type="hidden" id="context" value="<?=$_SESSION['context']?>">
                    <input type="hidden" name="mbrid" value="<?=isset($this->data['anggota']->id) ? $this->data['anggota']->id : '';?>">
                    <input type="hidden" name="submit1" value="submit">
                    <div class="col-md-6 col-sm-8 col-xs-12 bill-detail">
                        
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item active"><a data-toggle="tab" href="#address_tab" class="nav-link"> <i class="fa fa-map-marker"></i><br>Address</a></li>
                            <li class="nav-item"><a data-toggle="tab" href="#delivery" class="nav-link"><i class="fa fa-truck"></i><br>Delivery Method</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="address_tab" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstname"><?= lang('checkout_first_name') ?></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?=isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';?>" placeholder="Enter first name" data-error="Please enter first name." autocomplete="off" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lastname"><?= lang('checkout_last_name') ?></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?=isset($_SESSION['last_name'])? $_SESSION['last_name'] : '';?>" placeholder="Enter last name" data-error="Please enter last name." autocomplete="off" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="company"><?= lang('checkout_company') ?></label>
                                            <input type="text" class="form-control" id="company" name="company" value="<?=isset($_SESSION['company'])? $_SESSION['company'] : '';?>" placeholder="Enter company name" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="address"><?= lang('checkout_address') ?></label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?=isset($_SESSION['address'])? $_SESSION['address'] : '';?>" placeholder="Enter address" data-error="Please enter address." autocomplete="off" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="province"><?= lang('checkout_province') ?></label>
                                            <select id="province" name="province" class="form-control" data-error="Please enter province." required>
                                                <option value=""<?=isset($_SESSION['province'])?'': ' selected';?>>-</option>
                                                <?php
                                                    foreach ($this->data['provinsi'] as $itemx) {
                                                        if (isset($_SESSION['province']))
                                                        {
                                                ?>
                                                <option value="<?= $itemx->id ?>"<?php if( $itemx->id == $_SESSION['province'] ): ?> selected<?php endif; ?>><?= $itemx->name ?></option>
                                                <?php   } else { ?>
                                                <option value="<?= $itemx->id ?>"><?= $itemx->name ?></option>
                                                <?php } } ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="regency"><?= lang('checkout_regency') ?></label>
                                            <select id="regency" name="regency" class="form-control" data-error="Please enter regency." required>
                                            <?php
                                                if (isset($this->data['kabupaten'])) :
                                                    foreach ($this->data['kabupaten'] as $item) {
                                            ?>
                                            <option value="<?= $item->id ?>"<?php if( $_SESSION['regency'] == $item->id ): ?> selected<?php endif; ?>><?= $item->name ?></option>
                                            <?php   }
                                                endif;
                                            ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="district"><?= lang('checkout_district') ?></label>
                                            <select id="district" name="district" class="form-control" data-error="Please enter district."> <!--  required -->
                                            <?php
                                                if (isset($kecamatan)) :
                                                    foreach ($kecamatan as $item) {
                                            ?>
                                            <option value="<?= $item->subdistrict_id ?>"<?php if( $_SESSION['district'] == $item->subdistrict_id ): ?> selected<?php endif; ?>><?= $item->subdistrict_name ?></option>
                                            <?php   }
                                                endif;
                                            ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="zip"><?= lang('checkout_post_code') ?></label>
                                            <input type="text" class="form-control" id="post_code" name="post_code" value="<?=isset($_SESSION['post_code'])? $_SESSION['post_code'] : '';?>" placeholder="Enter post code" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone"><?= lang('checkout_phone') ?></label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?=isset($_SESSION['phone'])? $_SESSION['phone'] : '';?>" placeholder="Enter phone number" data-error="Please enter phone number." autocomplete="off" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email"><?= lang('checkout_email') ?></label>
                                            <input type="text" class="form-control" id="email" name="email" value="<?=isset($_SESSION['guest'])? '': isset($_SESSION['email'])? $_SESSION['email'] : '';?>" placeholder="Enter email address" data-error="Please enter email address." autocomplete="off" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="note"><?= lang('checkout_order_notes') ?></label>
                                            <input type="text" class="form-control" id="note" name="note" value="<?=isset($_SESSION['note'])? $_SESSION['note'] : '';?>" placeholder="Enter order notes" autocomplete="off">
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
                            <div id="delivery" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="carrier"><?= lang('checkout_carrier') ?></label>
                                            <select id="carrier" name="carrier" class="form-control" data-error="Please select carrier."<?= isset($_SESSION['paket'])? '': ' disabled'?>> <!--  required -->
                                            <?php foreach ($carrier as $item) { ?>
                                            <option value="<?=$item->code?>"<?php if( $_SESSION['carrier'] == $item->code ): ?> selected<?php endif; ?>><?=$item->name?></option>
                                            <?php } ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="package"><?= lang('checkout_package_type') ?></label>
                                            <select id="package" name="package" class="form-control" data-error="Please select package type."<?= isset($_SESSION['paket'])? '': ' disabled'?>> <!--  required -->
                                            <!-- <option value=""<?= isset( $_SESSION['paket'] )? '': 'selected' ?>>-</option> -->
                                            <?php
                                                foreach ($paket as $item) {
                                            ?>
                                            <option value="<?= $item->cost[0]->value ?>"<?php if( $_SESSION['paket'] == $item->service ): ?> selected<?php endif; ?>><?= $item->service ?></option>
                                            <?php   } ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-5 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="<?= ($_SESSION['context'] == 1)? site_url('equipment'): site_url('utensil'); ?>">Back</a></div>
                        <!-- <div class="col-md-6 col-sm-7 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="javascript:void(0);" id="btnSubmit">Continue to Delivery Method</a></div> -->
                    </div>

                    <div class="col-md-1">
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 order">
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

                                    foreach ($_SESSION['cart_item'] as $item) {

                                        $item_price   = (float)$item['qty']*$item['harga'];
                                        $total_price += $item_price;
                                ?>
                                <tr>
                                    <input type="hidden" name="kdbar" value="<?= $item["kdbar"] ?>">
                                    <input type="hidden" name="qty" value="<?= $item["qty"] ?>">
                                    <input type="hidden" name="berat" value="<?= $item["berat"] ?>">
                                    <td><?= $item['nama']; ?></td>
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
                                    <td><b>Shipping<span id="spancar"></span></b></td>
                                    <td class="text-right"><b>Rp<span id="spanship">0</span></b></td>
                                </tr>
                                <tr>
                                    <td><b>Tax</b></td>
                                    <td class="text-right"><b>Rp<span id="spantax">0</span></b></td>
                                </tr>
                                <tr>
                                    <td><b>Total</b></td>
                                    <td class="text-right"><b>Rp<span id="spangt"><?= number_format($total_price, 0, ',', '.') ?></span></b></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="col-md-6 col-sm-12 col-xs-12 checkout-right-basket2"><a class="checkout-right-basket2" href="javascript:void(0);" id="pay-button">Pay</a></div>
                    </div>
                    <input type="hidden" id="total" name="total" value="<?=$total_price?>">
                    <input type="hidden" id="shipcost" name="shipcost" value="0">
                    <input type="hidden" id="svcname" name="svcname" value="jne">
                    <input type="hidden" id="tax" name="tax" value="0">
                    <input type="hidden" id="gtotal" name="gtotal" value="<?=$total_price?>">
                    </form>
				</div>
			</div>
		</div>
	<!-- content -->

    <form id="payment-form" method="post" action="<?=site_url()?>snap/finish">
      <input type="hidden" name="result_type" id="result-type" value=""></div>
      <input type="hidden" name="result_data" id="result-data" value=""></div>
    </form>
    
	<script type="text/javascript">
    $(document).ready(function() {
        
        var total = parseFloat( $('#total').val()),
            cost  = parseFloat( $('#package option:selected').val());

            $('#svcname').val($('#package option:selected').text());
            
            if (Number.isNaN(cost))
            {
                $('#shipcost').val(0);
            }
            else
            {
            
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url();?>checkout/hitung_ongkir/"+cost,
                    success:function(json){
                        var data = json.data;
                        
                        $('#shipcost').val(data.shipcost);
                        $('#spanship').text(data.shipcost.toLocaleString());

                        // add shipping cost
                        total += data.shipcost;
                        $('#gtotal').val(total);
                        $('#spangt').text(total.toLocaleString());
                    }
                });
            }
        
        $('#frmOrder').validator();

        $('#pay-button').click(function(event) {
            event.preventDefault();
            // $(this).attr("disabled", "disabled");
            
            if ($('#first_name').val() == '')
            {
                alert('Please enter first name.');
                $( "#first_name" ).focus();
                return;
            }
            else if ($('#last_name').val() == '')
            {
                alert('Please enter last name.');
                $( "#last_name" ).focus();
                return;
            }
            else if ($('#address').val() == '')
            {
                alert('Please enter address.');
                $( "#address" ).focus();
                return;
            }
            else if ($('#province option:selected').val() == '')
            {
                alert('Please enter province.');
                $( "#province" ).focus();
                return;
            }
            else if ($('#regency option:selected').val() == '')
            {
                alert('Please enter regency.');
                $( "#regency" ).focus();
                return;
            }
            else if ($('#district option:selected').val() == '')
            {
                alert('Please enter district.');
                $( "#district" ).focus();
                return;
            }
            else if ($('#phone').val() == '')
            {
                alert('Please enter phone number.');
                $( "#phone" ).focus();
                return;
            }
            else if ($('#email').val() == '')
            {
                alert('Please enter email address.');
                $( "#email" ).focus();
                return;
            }

            var form = $('#frmOrder');
    
            $.ajax({
                url: '<?=site_url()?>snap/token',
                type: "POST",
                cache: false,
                data: form.serialize(),
                success: function(data) {

                    console.log('token = '+data); // snap token
                    
                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type, data){
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                        //resultType.innerHTML = type;
                        //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {
                    
                        onSuccess: function(result){
                            changeResult('success', result);
                            console.log(result.status_message);
                            console.log(result);
                            $("#payment-form").submit();
                        },
                        onPending: function(result){
                            changeResult('pending', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        },
                        onError: function(result){
                            changeResult('error', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        }
                    });
                }
            });
        });
         
        $('#province').change(function(){
            
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>checkout/regencies/"+$(this).val(),
                success:function(json){
                    
                    var data = json.data,
                        firstid = data[0].id;

                    $('#regency').html('');
                    for (var i = 0; i < data.length; i++) {
                        $('#regency').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                    }
            
                    // get post code
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url();?>checkout/post-code/"+$('#regency option:selected').val(),
                        success:function(json){
                            var data = json.data;
                            $('#post_code').val(data.postal_code);
                        },
                    });

                    // get current district data
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url();?>checkout/districts/"+firstid,
                        success:function(json){
                            var data = json.data;

                            $('#district').html('');
                            for (var i = 0; i < data.length; i++) {
                                $('#district').append('<option value="'+data[i].subdistrict_id+'">'+data[i].subdistrict_name+'</option>')
                            }
                        },
                    });
            
                    // get ship cost - default from JNE
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url();?>checkout/ongkir/jne/"+firstid,
                        success: function(json){
                            
                            var data = json.data,
                            total = parseFloat( $('#total').val()),
                            cost  = parseFloat(data[0].cost[0].value);
            
                            // hitung total ongkos kirim
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url();?>checkout/hitung_ongkir/"+cost,
                                success:function(json){
                                    var data = json.data;
                                    
                                    $('#shipcost').val(data.shipcost);
                                    $('#spanship').text(data.shipcost.toLocaleString());

                                    // add shipping cost
                                    total += data.shipcost;
                                    $('#gtotal').val(total);
                                    $('#spangt').text(total.toLocaleString());
                                }
                            });
                            
                            $("#carrier").prop('disabled', false);
                            $("#package").prop('disabled', false);

                            $('#package').html('');
                            for (var i = 0; i < data.length; i++) {
                                $('#package').append('<option value="'+data[i].cost[0].value+'">'+data[i].service+'</option>')
                            }
                            $('#svcname').val($('#package option:selected').text()); // nama service/layanan
                        },
                    });
                },
            });
        });
        
        $('#regency').change(function(){
            
            // get post code
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>checkout/post-code/"+$(this).val(),
                success:function(json){
                    var data = json.data;
                    $('#post_code').val(data.postal_code);
                },
            });
            
            // get district data
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>checkout/districts/"+$(this).val(),
                success:function(json){
                    var data = json.data;
                    
                    $('#district').html('');
                    for (var i = 0; i < data.length; i++) {
                        $('#district').append('<option value="'+data[i].subdistrict_id+'">'+data[i].subdistrict_name+'</option>')
                    }
                },
            });
            
            // get carrier
            var carrier = $('#carrier option:selected').val();

            // get ship cost
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>checkout/ongkir/"+carrier+"/"+$(this).val(),
                success:function(json){
                    var data = json.data,
                    total = parseFloat( $('#total').val()),
                    cost  = parseFloat(data[0].cost[0].value);
                            
                    // hitung total ongkos kirim
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url();?>checkout/hitung_ongkir/"+cost,
                        success:function(json){
                            var data = json.data;
                            
                            $('#shipcost').val(data.shipcost);
                            $('#spanship').text(data.shipcost.toLocaleString());

                            // add shipping cost
                            total += data.shipcost;
                            $('#gtotal').val(total);
                            $('#spangt').text(total.toLocaleString());
                        }
                    });
                    
                    $("#carrier").prop('disabled', false);
                    $("#package").prop('disabled', false);

                    $('#package').html('');
                    for (var i = 0; i < data.length; i++) {
                        $('#package').append('<option value="'+data[i].cost[0].value+'">'+data[i].service+'</option>')
                    }
                    $('#svcname').val($('#package option:selected').text()); // nama service/layanan
                },
            });
        });
        
        $('#carrier').change(function(){
            
            var city = $('#regency option:selected').val();

            // get ship cost
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>checkout/ongkir/"+$(this).val()+"/"+city,
                success:function(json){
                    var data = json.data,
                    total = parseFloat( $('#total').val()),
                    cost  = parseFloat(data[0].cost[0].value);
                            
                    // hitung total ongkos kirim
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url();?>checkout/hitung_ongkir/"+cost,
                        success:function(json){
                            var data = json.data;
                            
                            $('#shipcost').val(data.shipcost);
                            $('#spanship').text(data.shipcost.toLocaleString());

                            // add shipping cost
                            total += data.shipcost;
                            $('#gtotal').val(total);
                            $('#spangt').text(total.toLocaleString());
                        }
                    });
                    
                    $("#carrier").prop('disabled', false);
                    $("#package").prop('disabled', false);

                    $('#package').html('');
                    for (var i = 0; i < data.length; i++) {
                        $('#package').append('<option value="'+data[i].cost[0].value+'">'+data[i].service+'</option>')
                    }
                    $('#svcname').val($('#package option:selected').text()); // nama service/layanan
                },
            });
        });
        
        $('#package').change(function(){
            
            var total = parseFloat( $('#total').val()),
            cost = parseFloat( $(this).val());

            $('#svcname').val($('#package option:selected').text()); // nama service/layanan
                            
            // hitung total ongkos kirim
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>checkout/hitung_ongkir/"+cost,
                success:function(json){
                    var data = json.data;
                    
                    $('#shipcost').val(data.shipcost);
                    $('#spanship').text(data.shipcost.toLocaleString());

                    // add shipping cost
                    total += data.shipcost;
                    $('#gtotal').val(total);
                    $('#spangt').text(total.toLocaleString());
                }
            });
        });
    });
	</script>
