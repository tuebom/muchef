<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <!-- <h3 class="box-title"><?php echo anchor('admin/orders/create', '<i class="fa fa-plus"></i> Create New Order', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3> -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_length" id="example1_length">
                                                <label style="display: flex; align-items: center;">Show&nbsp;<select name="example1_length" aria-controls="example1" class="form-control input-sm" style="width: 60px;">
                                                    <option value="10"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='10') ? ' selected="selected"':''; ?>>10</option>
                                                    <option value="25"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='25') ? ' selected="selected"':''; ?>>25</option>
                                                    <option value="50"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='50') ? ' selected="selected"':''; ?>>50</option>
                                                    <option value="100"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='100') ? ' selected="selected"':''; ?>>100</option>
                                                </select>&nbsp;entries</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <form class="frmfilter" action="<?= site_url('admin/orders'); ?>" method="get">
                                            <div class="box-tools pull-right">
                                                <div class="has-feedback">
                                                    <div id="search_filter" class="dataTables_filter">
                                                        <!-- <label>Search: -->
                                                        <input type="search" name="q" value="<?=isset($_SESSION['q'])?$_SESSION['q']:''; ?>" class="form-control input-sm" placeholder="" aria-controls="example1">
                                                        <!-- </label> -->
                                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Member Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Ship to</th>
                                                <th class="text-right">Sub Total</th>
                                                <!-- <th class="text-right">Tax</th> -->
                                                <th class="text-right">Ship Cost</th>
                                                <th class="text-right">Total</th>
                                                <th>Carrier</th>
                                                <th>Package</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($orders as $item):?>
                                            <tr>
                                            <td>#<?php echo htmlspecialchars($item->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->tglinput, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php 
                                                    switch ($item->status) {
                                                        case "Pending":    echo "<span class='label label-danger'>Pending</span>"; break;
                                                        case "Processing": echo "<span class='label label-warning'>Processing</span>"; break;
                                                        case "Shipped":    echo "<span class='label label-info'>Shipped</span>"; break;
                                                        case "Delivered":  echo "<span class='label label-success'>Delivered</span>"; break;
                                                    }
                                                    ?></td>
                                                <td><?php echo htmlspecialchars($item->address, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td class="text-right"><?php echo number_format(htmlspecialchars($item->total, ENT_QUOTES, 'UTF-8'),0,",","."); ?></td>
                                                <!-- <td class="text-right"><?php echo number_format(htmlspecialchars($item->tax, ENT_QUOTES, 'UTF-8'),0,",","."); ?></td>-->
                                                <td class="text-right"><?php echo number_format(htmlspecialchars($item->shipcost, ENT_QUOTES, 'UTF-8'),0,",","."); ?></td>
                                                <td class="text-right"><?php echo number_format(htmlspecialchars($item->gtotal, ENT_QUOTES, 'UTF-8'),0,",","."); ?></td>
                                                <td><?php echo strtoupper(htmlspecialchars($item->delivery, ENT_QUOTES, 'UTF-8')); ?></td>
                                                <td><?php echo strtoupper(htmlspecialchars($item->package, ENT_QUOTES, 'UTF-8')); ?></td>
                                                <td>
                                                    <?php if ($item->status !== 'Delivered') echo anchor('admin/orders/edit/'.$item->id, 'Edit'); ?>
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer" align="center">
									<?php echo $this->data['pagination']; ?>
								</div>

                            </div>
                         </div>
                    </div>
                </section>
            </div>

            <script type="text/javascript">
$(document).ready(function(){
        
    $('.dataTables_length').change(function(){
        $.ajax({
            type: "POST",
            url: <?php echo '"'.site_url().'admin/orders/setpaging/"' ?> + $('.dataTables_length option:selected').val(),
            success:function(json){
                // var data = json.data;
                location.reload();
            }
        });
    });
});
</script>