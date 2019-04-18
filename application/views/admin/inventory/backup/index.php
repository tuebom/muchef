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
                                    <h3 class="box-title"><?php echo anchor('admin/inventory/create', '<i class="fa fa-plus"></i> Create Inventory', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- <form class="frmpaging" action="<?= site_url('admin/inventory/setpaging'); ?>" method="post"> -->
                                            <div class="dataTables_length" id="example1_length">
                                            <label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                                <option value="10"<?php if(isset($_SESSION['paging'])) : ($_SESSION['paging']==='10') ? ' selected':''; endif; ?>>10</option>
                                                <option value="25"<?php if(isset($_SESSION['paging'])) : ($_SESSION['paging']==='25') ? ' selected':''; endif; ?>>25</option>
                                                <option value="50"<?php if(isset($_SESSION['paging'])) : ($_SESSION['paging']==='50') ? ' selected':''; endif; ?>>50</option>
                                                <option value="100"<?php if(isset($_SESSION['paging'])) : ($_SESSION['paging']==='100') ? ' selected':''; endif; ?>>100</option>
                                            </select> entries</label></div><!--</form>--></div>
                                        <div class="col-sm-6">
                                            <form class="frmfilter" action="<?= site_url('admin/inventory'); ?>" method="get"><div id="search_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></form></div></div>
                                </div>
                                <div class="box-body table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?= lang('inventory_kdbar'); ?></th>
                                                <th><?= lang('inventory_kdurl'); ?></th>
                                                <th><?= lang('inventory_name'); ?></th>
                                                <th><?= lang('inventory_group'); ?></th>
                                                <!-- <th>Gol. 2</th> -->
                                                <th><?= lang('inventory_unit'); ?></th>
                                                <th><?= lang('inventory_brand'); ?></th>
                                                <th><?= lang('inventory_size'); ?></th>
                                                <!-- <th class="text-right">Lebar</th>
                                                <th class="text-right">Tinggi</th> -->
                                                <th><?= lang('inventory_picture'); ?></th>
                                                <!-- <th>Listrik</th>
                                                <th>Kapasitas</th>
                                                <th>Gas</th>
                                                <th>Berat</th>
                                                <th>Tag</th>
                                                <th>Harga Jual</th>
                                                <th>Diskon</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($inventory as $item):?>
                                            <tr>
                                            <td><?php echo anchor('admin/inventory/edit/'.$item->kdurl, htmlspecialchars($item->kdbar, ENT_QUOTES, 'UTF-8')); ?></td>
                                                <td><?php echo htmlspecialchars($item->kdurl, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->nama, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->nmgol, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <!-- <td><?php echo htmlspecialchars($item->kdgol2, ENT_QUOTES, 'UTF-8'); ?></td> -->
                                                <td><?php echo htmlspecialchars($item->satuan, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->merk, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo $item->pnj.' cm<br>x<br>'.$item->lbr.' cm<br>x<br>'.$item->tgi.' cm'; ?></td>
                                                <!-- <td class="text-right"><?php echo htmlspecialchars($item->lbr, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td class="text-right"><?php echo htmlspecialchars($item->tgi, ENT_QUOTES, 'UTF-8'); ?></td> -->
                                                <td><div class="product-img"><img src="<?=site_url($this->data['products_dir'].'/'.$item->gambar)?>" alt="Image"></div></td>
                                                <!-- <td><?php echo htmlspecialchars($item->listrik, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->kapasitas, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->gas, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->berat, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->tag, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->hjual, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->disc, ENT_QUOTES, 'UTF-8'); ?></td> -->
                                                <td>
                                                    <?php echo anchor('admin/inventory/edit/'.$item->kdurl, 'Edit'); ?>
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
            url: <?php echo '"'.site_url().'admin/inventory/setpaging/"' ?> + $('.dataTables_length option:selected').val(),
            success:function(json){
                // var data = json.data;
                location.reload();
            }
        });
    });
    
    $(".dataTables_filter").on('keyup', function (e) {
        if (e.keyCode == 13) {
        alert('tes')
        }
    });
});
</script>