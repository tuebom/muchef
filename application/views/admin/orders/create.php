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
                                    <h3 class="box-title">Create Inventory</h3>
                                </div>
                                <div class="box-body">
                                    <?php echo $message;?>

                                    <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_inventory')); ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <?php echo lang('inventory_kdbar', 'kdbar', array('class' => 'col-sm-4 control-label')); ?>
                                                <div class="col-sm-8">
                                                    <?php echo form_input($kdbar);?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <?php echo lang('inventory_kdurl', 'kdurl', array('class' => 'col-sm-4 control-label')); ?>
                                                <div class="col-sm-8">
                                                    <?php echo form_input($kdurl);?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_description', 'nama', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($nama);?>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <?php echo lang('inventory_unit', 'satuan', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($satuan);?>
                                            </div>
                                        </div>

                                        <!-- merk & golongan level 1 -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <?php echo lang('inventory_brand', 'merk', array('class' => 'col-sm-2 control-label')); ?>
                                                <div class="col-sm-10">
                                                    <?php echo form_input($merk);?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="kdgol2"><?= lang('inventory_level2') ?></label>
                                                <select id="kdgol2" name="kdgol2" class="form-control">
                                                    <option value=""<?=isset($_SESSION['kdgol2'])?'': ' selected';?>>-</option>
                                                    <?php
                                                        foreach ($this->data['kdgol2'] as $itemx) {
                                                            if (isset($_SESSION['kdgol2']))
                                                            {
                                                    ?>
                                                    <option value="<?= $itemx->kdgol2 ?>"<?php if( $itemx->id == $_SESSION['kdgol2'] ): ?> selected="selected"<?php endif; ?>><?= $itemx->nama ?></option>
                                                    <?php   } else { ?>
                                                    <option value="<?= $itemx->kdgol2 ?>"><?= $itemx->nama ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- <div class="row"> -->
                                        <!-- golongan level 1 & 2 -->
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="kdgol2"><?= lang('inventory_level2') ?></label>
                                                    <select id="kdgol2" name="kdgol2" class="form-control">
                                                        <option value=""<?=isset($_SESSION['kdgol2'])?'': ' selected';?>>-</option>
                                                        <?php
                                                            foreach ($this->data['kdgol2'] as $itemx) {
                                                                if (isset($_SESSION['kdgol2']))
                                                                {
                                                        ?>
                                                        <option value="<?= $itemx->kdgol2 ?>"<?php if( $itemx->id == $_SESSION['kdgol2'] ): ?> selected="selected"<?php endif; ?>><?= $itemx->nama ?></option>
                                                        <?php   } else { ?>
                                                        <option value="<?= $itemx->kdgol2 ?>"><?= $itemx->nama ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">    
                                                <div class="form-group">
                                                    <label for="kdgol3"><?= lang('inventory_level3') ?></label>
                                                    <select id="kdgol3" name="kdgol3" class="form-control">
                                                    <?php
                                                        if (isset($this->data['kdgol3'])) :
                                                            foreach ($this->data['kdgol3'] as $item) {
                                                    ?>
                                                    <option value="<?= $item->kdgol3 ?>"<?php if( $_SESSION["kdgol3"] == $item->kdgol3 ): ?> selected="selected"<?php endif; ?>><?= $item->nama ?></option>
                                                    <?php   }
                                                        endif;
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <!-- </div> -->

                                        <!-- merk & golongan level 1 -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <?php echo lang('inventory_length', 'pnj', array('class' => 'col-sm-2 control-label')); ?>
                                                <div class="col-sm-10">
                                                    <?php echo form_input($pnj);?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <?php echo lang('inventory_width', 'lbr', array('class' => 'col-sm-2 control-label')); ?>
                                                <div class="col-sm-10">
                                                    <?php echo form_input($lbr);?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <?php echo lang('inventory_height', 'tgi', array('class' => 'col-sm-2 control-label')); ?>
                                                <div class="col-sm-10">
                                                    <?php echo form_input($tgi);?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/inventory', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                         </div>
                    </div>
                </section>
            </div>
