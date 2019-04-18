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
                                    <h3 class="box-title"><?php echo anchor('admin/inventory/create', '<i class="fa fa-plus">&nbsp</i> Add New Item', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
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
                                            <form class="frmfilter" action="<?= site_url('admin/inventory'); ?>" method="get">
                                            <div class="box-tools pull-right">
                                                <label style="display: flex; align-items: center;">
                                                    <!-- filter by category -->
                                                    Category&nbsp;&nbsp;
                                                    <select id="ctgry_filter" name="c" class="form-control input-sm" style="width: 150px;">
                                                    <option value=""<?=isset($_SESSION['catgry'])?'': ' selected';?>>-</option>
                                                    <?php foreach ($categories as $ctgry_item) { ?>
                                                        <option value="<?=$ctgry_item->kdgol2?>"<?= (!isset($_SESSION['catgry'])) ? '': ($_SESSION['catgry']==$ctgry_item->kdgol2) ? ' selected="selected"':''; ?>><?=$ctgry_item->nama?></option>
                                                    <?php } ?>
                                                    </select>&nbsp;&nbsp;
                                                    
                                                    <!-- filter by brand -->
                                                    Brand&nbsp;&nbsp;
                                                    <select id="brand_filter" name="b" aria-controls="example1" class="form-control input-sm" style="width: 150px;">
                                                    <option value=""<?=isset($_SESSION['brand'])?'': ' selected';?>>-</option>
                                                    <?php foreach ($brands as $brand_item) { ?>
                                                        <option value="<?=$brand_item->name?>"<?= (!isset($_SESSION['brand'])) ? '': ($_SESSION['brand']==$brand_item->name) ? ' selected="selected"':''; ?>><?=$brand_item->name?></option>
                                                    <?php } ?>
                                                    </select>&nbsp;&nbsp;
                                                    
                                                    <div class="has-feedback">
                                                        <div id="search_filter" class="dataTables_filter">
                                                            <!-- <label>Search: -->
                                                            <input type="search" name="q" value="<?=isset($_SESSION['q'])?$_SESSION['q']:''; ?>" class="form-control input-sm" placeholder="" aria-controls="example1">
                                                            <!-- </label> -->
                                                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body table-responsive inventory-list">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                                    <button type="button" class="btn btn-default btn-sm delete-selection"><i class="fa fa-trash-o"></i></button>
                                    <!-- <button type="button" class="btn btn-default btn-sm refresh"><i class="fa fa-refresh"></i></button> -->
                                </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-right">No.</th>
                                                <th><?= lang('inventory_kdbar'); ?></th>
                                                <th><?= lang('inventory_kdurl'); ?></th>
                                                <th><?= lang('inventory_name'); ?></th>
                                                <th><?= lang('inventory_group'); ?></th>
                                                <!-- <th>Gol. 2</th> -->
                                                <th><?= lang('inventory_unit'); ?></th>
                                                <th><?= lang('inventory_brand'); ?></th>
                                                <th><?= lang('inventory_size'); ?></th>
                                                <th class="text-right"><?= lang('inventory_price'); ?></th>
                                                <!-- <th class="text-right">Lebar</th>
                                                <th class="text-right">Tinggi</th> -->
                                                <th><?= lang('inventory_picture'); ?></th>
                                                <!-- <th>Listrik</th>
                                                <th>Kapasitas</th>
                                                <th>Gas</th>
                                                <th>Berat</th>
                                                <th>Tag</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php 
    $index = (int)$_SESSION['start'];
    foreach ($inventory as $item):?>
                                            <tr>
                                                <td><input type="checkbox" class="checkbox-item" value="<?=$item->kdbar?>"></td>
                                                <td class="text-right"><?= ++$index; ?></td>
                                                <td><?php echo anchor('admin/inventory/edit/'.$item->kdurl, htmlspecialchars($item->kdbar, ENT_QUOTES, 'UTF-8')); ?></td>
                                                <td><?php echo htmlspecialchars($item->kdurl, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->nama, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->nmgol, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <!-- <td><?php echo htmlspecialchars($item->kdgol2, ENT_QUOTES, 'UTF-8'); ?></td> -->
                                                <td><?php echo htmlspecialchars($item->satuan, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->merk, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if ($item->size): echo $item->size; elseif ($item->pnj): echo $item->pnj.'<br>x<br>'.$item->lbr; endif; if($item->tgi): echo '<br>x<br>'.$item->tgi; endif; ?></td>
                                                <td class="text-right"><?php echo htmlspecialchars($item->hjual, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <!-- <td class="text-right"><?php echo htmlspecialchars($item->lbr, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td class="text-right"><?php echo htmlspecialchars($item->tgi, ENT_QUOTES, 'UTF-8'); ?></td> -->
                                                <td><div class="product-img"><img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar)?>" alt="Image"></div></td>
                                                <td>
                                                    <?php echo anchor('admin/inventory/edit/'.$item->kdurl, 'Edit'); ?>&nbsp;
                                                    <?php echo anchor('admin/inventory/history/'.$item->kdurl, 'History'); ?>&nbsp;
                                                    <?php echo anchor('admin/inventory/delete/'.$item->kdurl, 'Delete'); ?>
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer">
                                    <h3 class="box-title"><?php echo anchor('admin/inventory/create', '<i class="fa fa-plus">&nbsp</i> Add New Item', array('class' => 'btn btn-primary btn-flat')); ?></h3>
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
        
    $('#ctgry_filter').change(function(){
        
        var str = window.location.href;
        var idx = str.indexOf("&q=");
        var catgry = $('#ctgry_filter option:selected').val();
        var url = <?php echo '"'.site_url().'admin/inventory?c="' ?> + catgry;
        if (idx > 0) url += str.substr(idx)
        window.location.href = url;
    });
        
    $('#brand_filter').change(function(){
        
        var str = window.location.href;
        
        var cidx = str.indexOf("c=");
        var idx = str.indexOf("&q=");
        
        var brand = $('#brand_filter option:selected').val();
        
        if (cidx > 0)
        {
            var url = <?php echo '"'.site_url().'admin/inventory?"' ?> + str.substr(cidx);
            url += '&b=' + brand.replace('&', '%26');
        }
        else
        {
            var url = <?php echo '"'.site_url().'admin/inventory?b="' ?> + brand.replace('&', '%26');
        }
        if (idx > 0) url += str.substr(idx)
        window.location.href = url;
    });

    $('.inventory-list input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".inventory-list input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".inventory-list input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    $(".delete-selection").click(function () {
        
        var dic = $(".checkbox-item:checked").map(function(){
            return $(this).val();
        }).toArray();

        if (dic.length == 0)
        {
            alert('Pilih item yang akan dihapus!');
            return;
        }

        $.ajax({
            type: "POST",
            url: <?php echo '"'.site_url().'admin/inventory/remove-item"' ?>,
            dataType: "json",
            data: JSON.stringify(dic),
            success:function(json){
                // console.log(json)
                location.href = '<?=current_url()?>';
            }
        });
    });

    $(".refresh").click(function () {
        location.reload();
    });

});
</script>