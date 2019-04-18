<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                    
                                <div class="box-header with-border">
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- <h3 class="box-title"><?php echo anchor('admin/reviews', '<i class="fa fa-reply">&nbsp</i> Up one level', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>&nbsp;
                                            <h3 class="box-title"><?php echo anchor('admin/reviews/create', '<i class="fa fa-plus">&nbsp</i> New Sub category', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3> -->
                                        </div>
                                        <div class="col-sm-6">
                                        </div>
                                    </div>
                                    <div class="row">
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
                                            <form class="frmfilter" action="<?= site_url('admin/reviews'); ?>" method="get">
                                            <div class="box-tools pull-right">
                                                <div class="has-feedback">
                                                    <div id="search_filter" class="dataTables_filter">
                                                        <input type="search" name="q" value="<?=isset($_SESSION['q'])?$_SESSION['q']:''; ?>" class="form-control input-sm" placeholder="" aria-controls="example1">
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
                                                <th class="text-right">No.</th>
                                                <th><?= lang('review_date'); ?></th>
                                                <th><?= lang('review_item_code'); ?></th>
                                                <th><?= lang('review_item_name'); ?></th>
                                                <th><?= lang('review_name'); ?></th>
                                                <th><?= lang('review_email'); ?></th>
                                                <th><?= lang('review_comment'); ?></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php 
    $index = 0;
    foreach ($reviews as $item):?>
                                            <tr>
                                                <td class="text-right"><?= ++$index; ?></td>
                                                <td><?php echo htmlspecialchars($item->timestamp, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->kdbar, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->nama, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($item->comment, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <!-- <?php echo anchor('admin/reviews/edit/'.$item->id, 'Edit'); ?>&nbsp; -->
                                                    <?php echo anchor('admin/reviews/delete/'.$item->id, 'Delete'); ?>
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer text-center">
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
            url: <?php echo '"'.site_url().'admin/subcategories/setpaging/"' ?> + $('.dataTables_length option:selected').val(),
            success:function(json){
                location.reload();
            }
        });
    });
});
</script>
