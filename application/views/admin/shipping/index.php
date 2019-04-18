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
                        
                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_inventory')); ?>
                        
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">General</h3>
                                </div>
                                <div class="box-body">

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <?php echo lang('shipping_origin_province', 'province', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-8">
                                            <select id="province" name="province" class="form-control" data-error="Please enter province." required>
                                                <option value=""<?=isset($_SESSION['province'])?'': ' selected';?>>-</option>
                                                <?php
                                                    foreach ($this->data['provinsi'] as $itemx) {
                                                        if (isset($_SESSION['province']))
                                                        {
                                                ?>
                                                <option value="<?= $itemx->id ?>"<?php if( $itemx->id == $_SESSION['province'] ): ?> selected="selected"<?php endif; ?>><?= $itemx->name ?></option>
                                                <?php   } else { ?>
                                                <option value="<?= $itemx->id ?>"><?= $itemx->name ?></option>
                                                <?php } } ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo lang('shipping_origin_city', 'regency', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-8">
                                            <select id="regency" name="regency" class="form-control" data-error="Please enter regency." required>
                                            <?php
                                                if (isset($this->data['kabupaten'])) :
                                                    foreach ($this->data['kabupaten'] as $item) {
                                            ?>
                                            <option value="<?= $item->id ?>"<?php if( $_SESSION['regency'] == $item->id ): ?> selected="selected"<?php endif; ?>><?= $item->name ?></option>
                                            <?php   }
                                                endif;
                                            ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo lang('shipping_origin_distirct', 'kdgol3', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-8">
                                            <select id="district" name="district" class="form-control" data-error="Please enter district." required>
                                            <?php
                                                if (isset($this->data['kecamatan'])) :
                                                    foreach ($this->data['kecamatan'] as $item) {
                                            ?>
                                            <option value="<?= $item->id ?>"<?php if( $_SESSION['district'] == $item->id ): ?> selected="selected"<?php endif; ?>><?= $item->name ?></option>
                                            <?php   }
                                                endif;
                                            ?>
                                            </select>
                                            </div>
                                        </div>

                                   <?php echo form_close();?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="box">
                                <div class="box-header with-border">
                                    <button type="button" class="btn btn-default btn-sm lion-toggle"><i class="fa fa-square-o"></i></button>&nbsp;&nbsp;&nbsp;<h3 class="box-title">LION</h3>
                                </div>
                                <div class="box-body lion-list">

                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="OKE"></td><td>OKE</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="REG"></td><td>REG</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="YES"></td><td>YES</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="box">
                                <div class="box-header with-border">
                                    <button type="button" class="btn btn-default btn-sm jne-toggle"><i class="fa fa-square-o"></i></button>&nbsp;&nbsp;&nbsp;
                                    <h3 class="box-title">JNE</h3>
                                </div>
                                <div class="box-body jne-list">

                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="ECO"></td><td>ECO</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="REG"></td><td>REG</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="ONS"></td><td>ONS</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="HDS"></td><td>HDS</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="box">
                                <div class="box-header with-border">
                                    <button type="button" class="btn btn-default btn-sm jnt-toggle"><i class="fa fa-square-o"></i></button>&nbsp;&nbsp;&nbsp;
                                    <h3 class="box-title">J&amp;T</h3>
                                </div>
                                <div class="box-body jnt-list">

                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="ECO"></td><td>ECO</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="REG"></td><td>REG</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="ONS"></td><td>ONS</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="HDS"></td><td>HDS</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="box">
                                <div class="box-header with-border">
                                    <button type="button" class="btn btn-default btn-sm tiki-toggle"><i class="fa fa-square-o"></i></button>&nbsp;&nbsp;&nbsp;
                                    <h3 class="box-title">TIKI</h3>
                                </div>
                                <div class="box-body tiki-list">

                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="kilat"></td><td>Paket Kilat Khusus</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="express"></td><td>Express Next Day Barang</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="box">
                                <div class="box-header with-border">
                                    <button type="button" class="btn btn-default btn-sm pos-toggle"><i class="fa fa-square-o"></i></button>&nbsp;&nbsp;&nbsp;
                                    <h3 class="box-title">POS</h3>
                                </div>
                                <div class="box-body pos-list">

                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="kilat"></td><td>Paket Kilat Khusus</td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" class="checkbox-item" value="express"></td><td>Express Next Day Barang</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h3 class="box-title pull-right"><?php echo anchor('admin/shipping/update', 'Save changes', array('class' => 'btn btn-primary btn-flat')); ?></h3>
                        </div>
                    </div>
                </section>
            </div>

<script type="text/javascript">
$(document).ready(function(){

    //  Lion parcel checkbox
    $('.lion-list input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".lion-toggle").click(function () {
      var clicks = $(this).data('clicks');
      
      if (clicks) {
        //Uncheck all checkboxes
        $(".lion-list input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".lion-list input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    
    //  JNE checkbox
    $('.jne-list input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".jne-toggle").click(function () {
      var clicks = $(this).data('clicks');
      
      if (clicks) {
        //Uncheck all checkboxes
        $(".jne-list input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".jne-list input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    
    //  JNT checkbox
    $('.jnt-list input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".jnt-toggle").click(function () {
      var clicks = $(this).data('clicks');
      
      if (clicks) {
        //Uncheck all checkboxes
        $(".jnt-list input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".jnt-list input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    
    //  TIKI checkbox
    $('.tiki-list input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".tiki-toggle").click(function () {
      var clicks = $(this).data('clicks');
      
      if (clicks) {
        //Uncheck all checkboxes
        $(".tiki-list input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".tiki-list input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    
    //  POS checkbox
    $('.pos-list input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".pos-toggle").click(function () {
      var clicks = $(this).data('clicks');
      
      if (clicks) {
        //Uncheck all checkboxes
        $(".pos-list input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".pos-list input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });


    $('#btnSubmit').click(function(event) {
        event.preventDefault();
        $('#frmAddress').submit();
    });
        
    $('#province').change(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>admin/shipping/regencies/"+$(this).val(),
            // dataType: "json",
            // data: {"id":$(this).val()},
            success:function(json){
                var data = json.data,
                    firstid = data[0].id;

                $('#regency').html('');
                for (var i = 0; i < data.length; i++) {
                    $('#regency').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                }

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url();?>admin/shipping/districts/"+firstid,
                    // dataType: "json",
                    // data: {"id":$(this).val()},
                    success:function(json){
                        var data = json.data;
                        $('#district').html('');
                        for (var i = 0; i < data.length; i++) {
                            $('#district').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                        }
                    },
                });
            },
        });
    });
    
    $('#regency').change(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>admin/shipping/districts/"+$(this).val(),
            success:function(json){
                var data = json.data;
                $('#district').html('');
                for (var i = 0; i < data.length; i++) {
                    $('#district').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                }
            },
        });
    });
});
</script>
