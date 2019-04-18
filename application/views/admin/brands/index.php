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
                                <div class="box-header with-border">
                                    <h3 class="box-title"><?php echo anchor('admin/brands/create', '<i class="fa fa-plus"></i> '. lang('brands_create'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
                                    <!-- <form class="frmfilter" action="<?= site_url('admin/inventory'); ?>" method="get">
                                        <div class="box-tools pull-right">
                                            <div class="has-feedback">
                                                <div id="search_filter" class="dataTables_filter">
                                                    <input type="search" name="q" value="<?=isset($_SESSION['q'])?$_SESSION['q']:''; ?>" class="form-control input-sm" placeholder="" aria-controls="example1">
                                                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form> -->
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('brands_name');?></th>
                                                <th><?php echo lang('brands_action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($brands as $values):?>
                                            <tr>
                                                <td><?php echo anchor("admin/brands/edit/".urlencode($values->name), htmlspecialchars($values->name, ENT_QUOTES, 'UTF-8')); ?></td>
                                                <td><?php echo anchor("admin/brands/edit/".urlencode($values->name), lang('actions_edit')); ?>&nbsp;&nbsp;
                                                    <?php echo anchor('admin/brands/delete/'.urlencode($values->name), 'Delete'); ?>
                                                </td>
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
