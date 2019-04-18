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
                                    <h3 class="box-title"><?php echo anchor('admin/carrier/create', '<i class="fa fa-plus">&nbsp</i> Add New Carrier', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                    <!-- <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_length" id="example1_length">
                                            <label style="display: flex; align-items: center;">Show&nbsp;<select name="example1_length" aria-controls="example1" class="form-control input-sm" style="width: 60px;">
                                                <option value="10"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='10') ? ' selected="selected"':''; ?>>10</option>
                                                <option value="25"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='25') ? ' selected="selected"':''; ?>>25</option>
                                                <option value="50"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='50') ? ' selected="selected"':''; ?>>50</option>
                                                <option value="100"<?= (!isset($_SESSION['paging'])) ? '': ($_SESSION['paging']=='100') ? ' selected="selected"':''; ?>>100</option>
                                            </select>&nbsp;entries</label></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <form class="frmfilter" action="<?= site_url('admin/carrier'); ?>" method="get">
                                            <div class="box-tools pull-right">
                                                <div class="has-feedback">
                                                    <div id="search_filter" class="dataTables_filter">
                                                        <input type="search" name="q" value="<?=isset($_SESSION['q'])?$_SESSION['q']:''; ?>" class="form-control input-sm" placeholder="" aria-controls="example1">
                                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                    </div>
                                                </div></label>
                                            </div>
                                            </form>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="box-body table-responsive carrier-list">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                                    <button type="button" class="btn btn-default btn-sm activate-selection"><i class="fa fa-save"></i></button>
                                    <!-- <button type="button" class="btn btn-default btn-sm refresh"><i class="fa fa-refresh"></i></button> -->
                                </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-right">No.</th>
                                                <th>Carrier Code</th>
                                                <th>Carrier Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php 
    $index = 0; //(int)$_SESSION['start'];
    foreach ($carrier as $item):?>
                                            <tr>
                                                <td style="width: 20px"><input type="checkbox" class="checkbox-item" value="<?=$item->code?>"<?=($item->active=='Y')?' checked':'';?>></td><!--<?=$item->active?>-->
                                                <td style="width: 20px" class="text-right"><?= ++$index; ?></td>
                                                <td><?php echo anchor('admin/carrier/edit/'.$item->code, htmlspecialchars($item->code, ENT_QUOTES, 'UTF-8')); ?></td>
                                                <td><?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php echo anchor('admin/carrier/edit/'.$item->code, 'Edit'); ?>&nbsp;&nbsp;
                                                    <?php echo anchor('admin/carrier/delete/'.$item->code, 'Delete'); ?>
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="box-footer">
                                    <h3 class="box-title"><?php echo anchor('admin/carrier/create', '<i class="fa fa-plus">&nbsp</i> Add New Carrier', array('class' => 'btn btn-primary btn-flat')); ?></h3>
									<?php echo $this->data['pagination']; ?>
								</div> -->

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
            url: <?php echo '"'.site_url().'admin/carrier/setpaging/"' ?> + $('.dataTables_length option:selected').val(),
            success:function(json){
                // var data = json.data;
                location.reload();
            }
        });
    });
        
    $('.carrier-list input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".carrier-list input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".carrier-list input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    $(".activate-selection").click(function () {
        
        var dic = $(".checkbox-item:checked").map(function(){
            return $(this).val();
        }).toArray();

        if (dic.length == 0)
        {
            alert('Pilih daftar kurir yang aktif!');
            return;
        }

        $.ajax({
            type: "POST",
            url: <?php echo '"'.site_url().'admin/carrier/activate"' ?>,
            dataType: "json",
            data: JSON.stringify(dic),
            success:function(json){
                location.href = '<?=current_url()?>';
            }
        });
    });

    $(".refresh").click(function () {
        location.reload();
    });

});
</script>