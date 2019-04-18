<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

            <div class="content-wrapper">

                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Sub Category 2 - Delete</h3>
                                </div>
                                <div class="box-body">

									<h3 class="box-title">Are you sure you want to delete sub category <span class="label label-primary"><?=$kode['kode']?></span></h3>
									<?php echo form_open("admin/subcategories2/delete/".$kode['kode']);?>

									  <div class="col-sm-offset-2 col-sm-10"><label class="radio-inline"><input type="radio" name="confirm" id="confirm1" value="yes" checked="checked"> <label for="CONFIRM">YES</label></label><label class="radio-inline"><input type="radio" name="confirm" id="confirm0" value="no"> <label for="CONFIRM">NO</label></label></div>

									  <?php echo form_hidden($kode); ?>

									  <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="btn-group">
                                                <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                <?php echo anchor('admin/subcategories2/detail/'.$_SESSION['kdgol2'], lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
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
