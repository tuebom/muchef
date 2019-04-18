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
                        <div class="col-md-6">
                            <div class="box">
                                    
                                <div class="box-body table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?= lang('category_group'); ?></th>
                                                <th><?= lang('category_name'); ?></th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
<?php 
    $index = 0;
    foreach ($categories as $item):?>
                                            <tr>
                                                <td><?php echo anchor('admin/subcategories/'.$item->kdgol, htmlspecialchars($item->kdgol, ENT_QUOTES, 'UTF-8')); ?></td>
                                                <td><?php echo anchor('admin/subcategories/'.$item->kdgol, htmlspecialchars($item->nama, ENT_QUOTES, 'UTF-8')); ?></td>
                                                <!-- <td>
                                                    <?php echo anchor('admin/subcategories/'.$item->kdgol, 'Edit'); ?>
                                                </td> -->
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
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
            url: <?php echo '"'.site_url().'admin/subcategory/setpaging/"' ?> + $('.dataTables_length option:selected').val(),
            success:function(json){
                // var data = json.data;
                location.reload();
            }
        });
    });
});
</script>