<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    Edit Order
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                        <h2 class="page-header">
                            ASKITCHEN
                            <small class="pull-right">Date: <?=$order->tglinput?></small>
                        </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                        Billing
                        <address>
                            <strong><?=$order->name?></strong><br>
                            <?=$order->address?><br>
                            <?=$order->district?>, <?=$order->regency?><br>
                            <?=$order->province?>, <?=$order->post_code?><br><br>
                            Phone: <?=$order->phone?><br>
                            Email: <?=$order->email?>
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        Shipping
                        <address>
                            <strong><?=$order->name?></strong><br>
                            <?=$order->address?><br>
                            <?=$order->district?>, <?=$order->regency?><br>
                            <?=$order->province?>, <?=$order->post_code?><br><br>
                            Phone: <?=$order->phone?><br>
                            Email: <?=$order->email?>
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <form id="frmOrder" action="<?= current_url(); ?>" method="post">
                            <input type="hidden" name="id" value="<?=$order->id?>">
                            <b>Order ID:</b> <?=$order->id?><br>
                            <b>Payment Due:</b> -<br>
                            <div class="form-group">
                                <label>Status:</label>
                                <select class="form-control" name="status">
                                    <option value="PND"<?php if( $order->status == 'PND' ): ?> selected="selected"<?php endif; ?>>Pending</option>
                                    <option value="PAID"<?php if( $order->status == 'PAID' ): ?> selected="selected"<?php endif; ?>>Processing</option>
                                    <option value="SHIP"<?php if( $order->status == 'SHIP' ): ?> selected="selected"<?php endif; ?>>Shipped</option>
                                    <option value="DLV"<?php if( $order->status == 'DLV' ): ?> selected="selected"<?php endif; ?>>Delivered</option>
                                </select>
                            </div>
                            <!-- <b>Account:</b> 968-34567 -->
                            </form>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-right">#</th>
                                <th>Item Code</th>
                                <th>Description</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($order_detail as $item) { ?>
                                <tr>
                                    <td class="text-right"><?=$item->urut;?></td>
                                    <td><?=$item->kdbar;?></td>
                                    <td><?=$item->nama;?></td>
                                    <td class="text-right"><?=$item->qty;?></td>
                                    <td class="text-right">Rp<?=number_format($item->hjual, 0, '.', ',');?></td>
                                    <td class="text-right">Rp<?=number_format($item->jumlah, 0, '.', ',');?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="invoice-info">Delivery Method:</p>
                            <?php if ($order->delivery == 'DOM') :?>
                            <i class="fa fa-truck">&nbsp;Domestic</i>
                            <?php else :?>
                            <img src="<?=base_url('images/'.strtolower($order->delivery).'.png') ?>" alt="<?=$order->delivery?>">
                            <?php endif; ?>

                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                <?= $order->note ?>
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <!-- <p class="lead">Amount Due -</p> -->

                            <div class="table-responsive">
                                <table class="table">
                                <tbody><tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td class="text-right">Rp<?=number_format($order->total, 0, '.', ',');?></td>
                                </tr>
                                <tr>
                                    <th>Tax:</th>
                                    <td class="text-right">Rp<?=number_format($order->tax, 0, '.', ',');?></td>
                                </tr>
                                <tr>
                                    <th>Shipping:</th>
                                    <td class="text-right">Rp<?=number_format($order->shipcost, 0, '.', ',');?></td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td class="text-right">Rp<?=number_format($order->gtotal, 0, '.', ',');?></td>
                                </tr>
                                </tbody></table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                        <a href="#" class="btn btn-default btn-update"><i class="fa fa-save"></i> Update</a>&nbsp;
                        <?php echo anchor('admin/orders', lang('actions_cancel'), array('class' => 'btn btn-default')); ?>
                        </div>
                    </div>
                </section>
            </div>

    
<script type="text/javascript">
$(document).ready(function() {
    
    $('.btn-update').click(function(event) {
        event.preventDefault();
        $('#frmOrder').submit();
    });
});
</script>
