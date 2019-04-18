<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?><?= $subtitle ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- <form class="frmpaging" action="<?= site_url('admin/inventory/setpaging'); ?>" method="post"> -->
                                            <div class="dataTables_length" id="example1_length">
                                            <label style="display: flex; align-items: center;">Show&nbsp;<select name="example1_length" aria-controls="example1" class="form-control input-sm" style="width: 60px;">
                                                <option value="10"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='10') ? ' selected="selected"':''; ?>>10</option>
                                                <option value="25"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='25') ? ' selected="selected"':''; ?>>25</option>
                                                <option value="50"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='50') ? ' selected="selected"':''; ?>>50</option>
                                                <option value="100"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='100') ? ' selected="selected"':''; ?>>100</option>
                                            </select>&nbsp;entries</label></div>
                                            <!--</form>-->
                                        </div>
                                        <div class="col-sm-6">
                                            <form class="frmfilter" action="<?= current_url() ?>" method="get">
                                            <div class="box-tools pull-right">
                                                
                                                <div class="has-feedback">
                                                    <div id="search_filter" class="dataTables_filter">
                                                        <!-- <label>Search: -->
                                                        <input type="search" name="q" value="<?=isset($_SESSION['q'])?$_SESSION['q']:''; ?>" class="form-control input-sm" placeholder="" aria-controls="example1">
                                                        <!-- </label> -->
                                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                    </div>
                                                </div></label>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body table-responsive inventory-list">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-right">No.</th>
                                                <th>Order Date</th>
                                                <th>Order ID</th>
                                                <th>Member Name</th>
                                                <th class="text-right">Qty</th>
                                                <th class="text-right">Price</th>
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php 
    $index = (int)$_SESSION['start'];
    foreach ($history as $item):?>
                                            <tr>
                                                <td class="text-right"><?= ++$index; ?></td>
                                                <td><?= $item->tglinput?></td>
                                                <td>#<?= $item->id?></td>
                                                <td><?=$item->nama?></a></td>
                                                <td class="text-right"><?= $item->qty?></td>
                                                <td class="text-right">Rp<?=number_format($item->hjual, 0, ',', '.')?></td>
                                                <td class="text-right">Rp<?=number_format($item->jumlah, 0, ',', '.')?></td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer">
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
            url: <?php echo '"'.site_url().'admin/inventory/setpaging/"' ?> + $('.dataTables_length option:selected').val(),
            success:function(json){
                // var data = json.data;
                location.reload();
            }
        });
    });

});
</script>