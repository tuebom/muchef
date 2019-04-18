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
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            
                                            <label for="kdbar" class="col-sm-3 control-label">Item Code *</label>
                                            <div class="col-sm-9">
                                                <?php echo form_input($kdbar);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- <?php echo lang('inventory_kdurl', 'kdurl', array('class' => 'col-sm-3 control-label')); ?> -->
                                            <label for="kdurl" class="col-sm-3 control-label">Item URL *</label>
                                            <div class="col-sm-9">
                                                <?php echo form_input($kdurl);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!-- <?php echo lang('inventory_name', 'nama', array('class' => 'col-sm-3 control-label')); ?> -->
                                            <label for="nama" class="col-sm-3 control-label">Name *</label>
                                            <div class="col-sm-9">
                                                <?php echo form_input($nama);?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- <?php echo lang('inventory_group', 'kdgol', array('class' => 'col-sm-3 control-label')); ?> -->
                                            <label for="kdgol" class="col-sm-3 control-label">Category *</label>
                                            <div class="col-sm-9">
                                            <select id="kdgol" name="kdgol" class="form-control">
                                                <option value=""<?=isset($_SESSION['kdgol'])?'': ' selected';?>>-</option>
                                                <?php
                                                    foreach ($this->data['golongan'] as $itemx) {
                                                        if (isset($_SESSION['kdgol']))
                                                        {
                                                ?>
                                                <option value="<?= $itemx->kdgol ?>"<?php if( $itemx->kdgol == $_SESSION['kdgol'] ): ?> selected="selected"<?php endif; ?>><?= $itemx->nama ?></option>
                                                <?php   } else { ?>
                                                <option value="<?= $itemx->kdgol ?>"><?= $itemx->nama ?></option>
                                                <?php } } ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- <?php echo lang('inventory_group_lv2', 'kdgol2', array('class' => 'col-sm-3 control-label')); ?> -->
                                            <label for="kdgol2" class="col-sm-3 control-label">Sub Category *</label>
                                            <div class="col-sm-9">
                                            <select id="kdgol2" name="kdgol2" class="form-control">
                                                <option value=""<?=isset($_SESSION['kdgol2'])?'': ' selected';?>>-</option>
                                                <?php
                                                    if (isset($this->data['golongan2'])) {
                                                    foreach ($this->data['golongan2'] as $itemx) {
                                                        if (isset($_SESSION['kdgol2']))
                                                        {
                                                ?>
                                                <option value="<?= $itemx->kdgol2 ?>"<?php if( $itemx->kdgol2 == $_SESSION['kdgol2'] ): ?> selected="selected"<?php endif; ?>><?= $itemx->nama ?></option>
                                                <?php   } else { ?>
                                                <option value="<?= $itemx->kdgol2 ?>"><?= $itemx->nama ?></option>
                                                <?php } } } ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- <?php echo lang('inventory_group_lv3', 'kdgol3', array('class' => 'col-sm-3 control-label')); ?> -->
                                            <label for="kdgol3" class="col-sm-3 control-label">Sub Category 2 *</label>
                                            <div class="col-sm-9">
                                            <select id="kdgol3" name="kdgol3" class="form-control">
                                            <option value=""<?=isset($_SESSION['kdgol2'])?'': ' selected';?>>-</option>
                                            <?php
                                                if (isset($this->data['golongan3'])) :
                                                    foreach ($this->data['golongan3'] as $item) {
                                                        if (isset($_SESSION['kdgol3']))
                                                        {
                                            ?>
                                            <option value="<?= $item->kdgol3 ?>"<?php if( $item->kdgol3 == $_SESSION['kdgol3'] ): ?> selected="selected"<?php endif; ?>><?= $item->nama ?></option>
                                                <?php   } else { ?>
                                            <option value="<?= $item->kdgol3 ?>"><?= $item->nama ?></option>
                                            <?php   }   }
                                                endif;
                                            ?>
                                            </select>
                                            </div>
                                        </div>

                                        <!-- info -->
                                        <div class="form-group">
                                            <?php echo lang('inventory_description', 'deskripsi', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <!-- <?php echo form_textarea($deskripsi);?> -->
                                                <textarea name="deskripsi" cols="40" rows="3" id="deskripsi" class="form-control" value=""></textarea>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#deskripsi').richText({
                                                        heading:false,
                                                        imageUpload:false,
                                                        fileUpload:false,
                                                        urls:false,
                                                        table:false,
                                                        video:false,
                                                        title:false,
                                                        fonts:false,
                                                        fontColor:false,
                                                        fontSize:false,
                                                        videoEmbed:false,
                                                        removeStyles:false    
                                                        })});
                                                
                                                </script>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- <?php echo lang('inventory_unit', 'satuan', array('class' => 'col-sm-3 control-label')); ?> -->
                                            <label for="satuan" class="col-sm-3 control-label">Unit *</label>
                                            <div class="col-sm-9">
                                                <?php echo form_input($satuan);?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo lang('inventory_brand', 'merk', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <select id="merk" name="merk" class="form-control">
                                                    <option value=""<?=isset($_SESSION['merk'])?'': ' selected';?>>-</option>
                                                    <?php
                                                        foreach ($this->data['brands'] as $itemx) {
                                                            if (isset($_SESSION['merk']))
                                                            {
                                                    ?>
                                                    <option value="<?= $itemx->name ?>"<?php if( $itemx->name == $_SESSION['merk'] ): ?> selected="selected"<?php endif; ?>><?= $itemx->name ?></option>
                                                    <?php   } else { ?>
                                                    <option value="<?= $itemx->name ?>"><?= $itemx->name ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <?php echo lang('inventory_size', 'size', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($size);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_parent', 'parent', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <select id="parent" name="parent" class="form-control">
                                                    <option value="" selected>-</option>
                                                    <?php
                                                        foreach ($parents as $itemx) {
                                                    ?>
                                                    <option value="<?= $itemx->kdbar ?>"><?= $itemx->nama ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo lang('inventory_length', 'pnj', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($pnj);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_width', 'lbr', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($lbr);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_height', 'tgi', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($tgi);?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo lang('inventory_electricity', 'listrik', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($listrik);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_capacity', 'kapasitas', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($kapasitas);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_gas', 'gas', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($gas);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_weight', 'berat', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($berat);?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo lang('inventory_feature', 'fitur', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_textarea($fitur);?>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <?php echo lang('inventory_criteria', 'criteria', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <select id="kriteria" name="kriteria" class="form-control">
                                                    <option value="" selected>-</option>
                                                    <option value="N">New Products</option>
                                                    <option value="P">Promotion</option>
                                                    <option value="B">Best Seller</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_tag', 'tag', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($tag);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_price', 'hjual', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($hjual);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_promo', 'hpromo', array('class' => 'col-sm-3 control-label')); ?>
                                            <div class="col-sm-9">
                                                <?php echo form_input($hpromo);?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10">
                                                <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="publish" value="Y"<?=$publish['value'] == 'Y'? ' checked':''?>> Publish
                                                </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-10">
                                                <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="master" name="master" value="Y"<?=$master['value'] == 'Y'? ' checked':''?>> Master
                                                </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <div class="btn-group">
                                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => lang('actions_submit'))); ?>
                                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => lang('actions_reset'))); ?>
                                                    <?php echo anchor('admin/inventory', lang('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                    <div class="form-group">
                                            <?php echo lang('inventory_picture', 'gambar', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($gambar);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_picture2', 'gambar2', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($gambar2);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo lang('inventory_picture3', 'gambar3', array('class' => 'col-sm-2 control-label')); ?>
                                            <div class="col-sm-10">
                                                <?php echo form_input($gambar3);?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <!-- The container for the uploaded files -->
                                                <!-- <div id="files" class="files"></div>
                                                <a id="btnUpload" href="#" class="btn btn-sm btn-default btn-flat fileinput-button">Choose image
                                                <input id="fileupload" type="file" name="files[]"></a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo form_close();?>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <!-- The container for the uploaded files -->
                                                <div id="files" class="files"></div>
                                                <a id="btnUpload" href="#" class="btn btn-sm btn-default btn-flat fileinput-button">Choose image
                                                <input id="fileupload" type="file" name="files[]" multiple></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

<script type="text/javascript">
$(document).ready(function(){

    var idx = 1;

    // Change this to the location of your server-side upload handler:
    var url = <?php echo '"'.base_url('admin/fileupload').'"' ?>,
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });

    $('#kdbar').on('blur', function () {
        $.ajax({
            type: "POST",
            url: <?php echo '"'.site_url().'admin/inventory/isexists/"' ?>+$(this).val(),
            success:function(json){
                var status = json.status;
                if (status){
                    alert('Kode item sudah ada!');
                    $(this).val('');
                    $('#kdbar').val('');
                }
            }
        });
    });

    $('#fileupload').fileupload({
        url: url, // NOTE: tidak boleh ada karakter dot/titik
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        
        // maxNumberOfFiles: 1,
        
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 120,
        previewMaxHeight: 120,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            
            if (idx == 1)
            {
                $('#gambar').val(file.name);
            }
            else
            {
                $('#gambar'+idx).val(file.name);
            }
            
            idx++;
            if (idx == 4)
            {
                $('#btnUpload').css('display', 'none');
            }
            
            var node = $('<p/>');
                    // .append($('<span/>').text(file.name));
            if (!index) {
                node
                    // .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview)
                .prepend('<br>');
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
        
    
    $('#kdgol').change(function(){
        $.ajax({
            type: "POST",
            url: <?php echo '"'.site_url().'admin/inventory/level2/"' ?>+$(this).val(),
            success:function(json){
                var data = json.data,
                firstid = data[0].kdgol2;

                $('#kdgol2').html('');
                for (var i = 0; i < data.length; i++) {
                    $('#kdgol2').append('<option value="'+data[i].kdgol2+'">'+data[i].nama+'</option>')
                }
                
                $.ajax({
                    type: "POST",
                    url: <?php echo '"'.site_url().'admin/inventory/level3/"' ?>+firstid,
                    success:function(json){
                        var data = json.data;
                        
                        $('#kdgol3').html('');
                        for (var i = 0; i < data.length; i++) {
                            $('#kdgol3').append('<option value="'+data[i].kdgol3+'">'+data[i].nama+'</option>')
                        }
                    }
                });

            },
        });
    });

    $('#kdgol2').change(function(){
        $.ajax({
            type: "POST",
            url: <?php echo '"'.site_url().'admin/inventory/level3/"' ?>+$(this).val(),
            success:function(json){
                var data = json.data;

                $('#kdgol3').html('');
                for (var i = 0; i < data.length; i++) {
                    $('#kdgol3').append('<option value="'+data[i].kdgol3+'">'+data[i].nama+'</option>')
                }
            }
        });
    });
});
</script>