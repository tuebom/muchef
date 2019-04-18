	<!--content-->
		<div class="content">
			<div class="cart-items">
				<div class="container">
                    <form id="frmDelivery" method="post">

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
                                    <li class="list-group-item deli">
                                        <div class="col-sm-1">
                                            <div><input type="radio" class="delivery" name="delivery" value="JNE"<?php if(isset($_SESSION['delivery'])){ if($_SESSION['delivery'] == 'JNE') echo 'checked="checked"'; }?>></div>
                                        </div>
                                        <div class="col-sm-5">
                                            <img src="<?=base_url('images/jne.png');?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="list-group list-group-unbordered">
                                            <?php foreach($cost_jne as $item_jne) { ?>
                                            <li class="list-group-item">
                                                <div>
                                                    <input type="hidden" id="cost" value="<?=$item_jne->cost[0]->value?>">
                                                    <input type="radio" class="delivery svc-jne" id="svc-jne-<?=$item_jne->service?>" name="svc-jne" value="<?=$item_jne->service?>"<?php if(isset($_SESSION['svc-jne'])){ if($_SESSION['svc-jne'] == 'OKE') echo 'checked="checked"'; }?>>
                                                    <label for="svc-jne-<?=$item_jne->service?>" class="service"><?=$item_jne->service . ' : Rp'. number_format($item_jne->cost[0]->value, 0, ',', '.') . '&nbsp;&nbsp;&nbsp;(' . $item_jne->cost[0]->etd . ' hari)'?></label>
                                                </div>
                                            </li>
                                            <?php } ?>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="list-group-item deli">
                                        <div class="col-sm-1">
                                            <div><input type="radio" class="delivery" name="delivery" value="LION"<?php if(isset($_SESSION['delivery'])){ if($_SESSION['delivery'] == 'LION') echo 'checked="checked"'; }?>></div>
                                        </div>
                                        <div class="col-sm-5">
                                            <img src="<?=base_url('images/lion.png');?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <div>
                                                    <input type="hidden" id="cost" value="5000">
                                                    <input type="radio" class="delivery svc-lion" name="svc-lion" value="REGPACK"<?php if(isset($_SESSION['svc-lion'])){ if($_SESSION['svc-lion'] == 'REGPACK') echo 'checked="checked"'; }?>>
                                                    <label class="service">REGPACK</label>
                                                </div>
                                            </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="list-group-item deli">
                                        <div class="col-sm-1">
                                            <div><input type="radio" class="delivery" name="delivery" value="WAHANA"<?php if(isset($_SESSION['delivery'])){ if($_SESSION['delivery'] == 'WAHANA') echo 'checked="checked"'; }?>></div>
                                        </div>
                                        <div class="col-sm-5">
                                            <img src="<?=base_url('images/wahana.png');?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <div>
                                                    <input type="hidden" id="cost" value="7000">
                                                    <input type="radio" class="delivery svc-wahana" name="svc-wahana" value="REGULER"<?php if(isset($_SESSION['svc-wahana'])){ if($_SESSION['svc-wahana'] == 'REGULER') echo 'checked="checked"'; }?>>
                                                    <label class="service">REGULER</label>
                                                </div>
                                            </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <!-- <li class="list-group-item deli">
                                        <div><input type="radio" class="delivery" name="delivery" value="J&T"<?php if(isset($_SESSION['delivery'])){ if($_SESSION['delivery'] == 'JNT') echo 'checked="checked"'; }?>></div>
                                        <img src="<?=base_url('images/jnt.png');?>">
                                    </li> -->
                                    </ul>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-4 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="<?= site_url('checkout'); ?>">Back to Address</a></div>
                        <div class="col-md-6 col-sm-8 col-xs-6 checkout-right-basket2"><a class="checkout-right-basket2" href="javascript:void(0);" id="pay-button">Pay</a></div>
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
                                    <td class="text-right">Rp<?= number_format($item_price, 0, ',', '.') ?></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><b>Subtotal</b></td>
                                    <td class="text-right"><b>Rp<?= number_format($total_price, 0, ',', '.') ?></b></td>
                                </tr>
                                <tr>
                                    <td><b>Shipping</b></td>
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

                    </div>
                    <input type="hidden" id="total" name="total" value="<?=$total_price?>">
                    <input type="hidden" id="shipcost" name="shipcost" value="0">
                    <input type="hidden" id="tax" name="tax" value="0">
                    <input type="hidden" id="gtotal" name="gtotal" value="<?=$total_price?>">
                    </form>
				</div>
			</div>
		</div>
	<!-- content -->

    <input type="hidden" id="context" value="<?=$context?>">

    <form id="payment-form" method="post" action="<?=site_url()?>snap/finish">
      <input type="hidden" name="result_type" id="result-type" value=""></div>
      <input type="hidden" name="result_data" id="result-data" value=""></div>
    </form>

    <script type="text/javascript">
    $(document).ready(function() {
        
        $('#pay-button').click(function(event) {
            event.preventDefault();
            var context = $('#context');

            $(this).attr("disabled", "disabled");
            
            // submit form for equipment order
            if (context == 1) {
                
                $('#frmDelivery').attr("action", "<?= site_url('checkout?action=submit'); ?>");
                $('#frmDelivery').submit();
            } else {

                var form = $('#frmDelivery');
        
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
            }
        });
        
        $('input[type=radio][name=delivery]').on('change', function () {
            
            var courier = $(this).val();
            
            switch (courier) {
                case 'JNE':
                    var cmp = $(this).parents().find('.svc-jne')[0];
                    $(cmp).prop('checked', true);
                    break;
                case 'LION':
                    var cmp = $(this).parents().find('.svc-lion')[0];
                    $(cmp).prop('checked', true);
                    break;
                case 'WAHANA':
                    var cmp = $(this).parents().find('.svc-wahana')[0];
                    $(cmp).prop('checked', true);
                    break;
            }
            
            var total = parseFloat( $('#total').val()),
            cost = parseFloat( $(cmp).parent().find('#cost')[0].value);
            
            $('#shipcost').val(cost);
            $('#spanship').text(cost.toLocaleString());

            // add shipping cost
            total += cost;
            $('#gtotal').val(total);
            $('#spangt').text(total.toLocaleString());
        });
        
        $('input[type=radio][name=svc-jne]').on('change', function () {
            var total = parseFloat( $('#total').val()),
            cost = parseFloat( $(this).parent().find('#cost')[0].value);

            $('#shipcost').val(cost);
            $('#spanship').text(cost.toLocaleString());

            // add shipping cost
            total += cost;
            $('#gtotal').val(total);
            $('#spangt').text(total.toLocaleString());
        });
    });
	</script>
