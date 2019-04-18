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
                                    <h3 class="box-title"><?php echo anchor('admin/users/create', '<i class="fa fa-plus"></i>&nbsp '. lang('users_create_user'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
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
                                            <form class="frmfilter" action="<?= site_url('admin/users'); ?>" method="get">
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
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-right">No.</th>
                                                <th><?php echo lang('users_firstname');?></th>
                                                <th><?php echo lang('users_lastname');?></th>
                                                <th><?php echo lang('users_email');?></th>
                                                <th><?php echo lang('users_groups');?></th>
                                                <th><?php echo lang('users_status');?></th>
                                                <th><?php echo lang('users_action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php 
    $index = (int)$_SESSION['start'];
    foreach ($users as $user):?>
                                            <tr>
                                                <td class="text-right"><?= ++$index; ?></td>
                                                <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
<?php

foreach ($user->groups as $group)
{

    // Disabled temporary !!!
    // echo anchor('admin/groups/edit/'.$group->id, '<span class="label" style="background:'.$group->bgcolor.';">'.htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8').'</span>');
    echo anchor('admin/groups/edit/'.$group->id, '<span class="label label-default">'.htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8').'</span>');
}

?>
                                                </td>
                                                <td><?php echo ($user->active) ? anchor('admin/users/deactivate/'.$user->id, '<span class="label label-success">'.lang('users_active').'</span>') : anchor('admin/users/activate/'. $user->id, '<span class="label label-default">'.lang('users_inactive').'</span>'); ?></td>
                                                <td>
                                                    <?php echo anchor('admin/users/edit/'.$user->id, lang('actions_edit')); ?>&nbsp;
                                                    <?php echo anchor('admin/users/profile/'.$user->id, lang('actions_see')); ?>&nbsp;
                                                    <?php echo anchor('admin/users/delete/'.$user->id, lang('actions_delete')); ?>
                                                </td>
                                            </tr>
<?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer">
                                    <h3 class="box-title"><?php echo anchor('admin/users/create', '<i class="fa fa-plus"></i>&nbsp '. lang('users_create_user'), array('class' => 'btn btn-primary btn-flat')); ?></h3>
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
        // alert('tes')
        $.ajax({
            type: "POST",
            url: <?php echo '"'.site_url().'admin/users/setpaging/"' ?> + $('.dataTables_length option:selected').val(),
            success:function(json){
                // var data = json.data;
                location.reload();
            }
        });
    });
});
</script>