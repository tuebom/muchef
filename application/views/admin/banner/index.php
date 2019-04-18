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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-solid">
                                <!-- <div class="box-header with-border">
                                    <h3 class="box-title">Banner</h3>
                                </div> -->
                                <!-- /.box-header -->
                                <div class="box-body">
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                    <?php 
                                        $index = 0;
                                        foreach ($banner as $item) { ?>
                                    <li data-target="#carousel-example-generic" data-slide-to="<?=$index?>" class="<?=$index == 0? 'active':''?>"></li>
                                    <?php $index++; } ?>
                                    </ol>
                                    <div class="carousel-inner">
                                    <?php 
                                        $index = 0;
                                        foreach ($banner as $item) { ?>
                                        <div class="item<?=$index == 0 ? ' active':''?>">
                                            <img src="<?=base_url($this->data['banner_dir'].'/'.$item->filename)?>" alt="Banner <?=(int)$index+1?>">

                                            <div class="carousel-caption">
                                                Banner <?=(int)$index+1?>
                                            </div>
                                        </div>
                                        <?php $index++; } ?>
                                    </div>
                                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                    </a>
                                </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>

                    <div id="files" class="files">
                    <?php 
                        $index = 0;
                        
                        foreach ($banner as $item) { ?>
                    <!-- banner file -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="box box-primary box-solid">
                                <!-- <div class="box-header with-border">
                                    <h3 class="box-title">Banner #<?=(int)$index+1?></h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool btn-remove" data-value="<?=$item->id?>" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div> -->
                                <!-- /.box-header -->
                                <div class="box-body banner">
                                    <img class="banner-img" style="display:block;width:auto;height:40px;" src="<?=base_url($this->data['banner_dir'].'/'.$item->filename)?>" alt="Banner <?=(int)$index+1?>">
                                    <div class="rem2">
                                        <a href="#" class="btn-remove" data-value="<?=$item->id?>"><span class="close3"></span></a>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                    <?php $index++; } ?>
                    </div>
                    <a id="btnUpload" href="#" class="btn btn-sm btn-default btn-flat fileinput-button">Tambah gambar
                    <input id="fileupload" type="file" name="files[]" multiple></a>

                </section>
            </div>

<script type="text/javascript">
$(document).ready(function() {

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

    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 109,
        previewMaxHeight: 40,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
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
                .prepend(file.preview);
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
                
                $.ajax({
                    type: "POST",
                    url: <?php echo '"'.site_url().'admin/banner/add"' ?>,
                    dataType: "json",
                    data: {"filename": file.name},
                    success:function(json){
                        location.reload();
                    }
                });

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

    $(".btn-remove").click(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: <?php echo '"'.site_url().'admin/banner/delete/'.'"' ?> + $(this).attr('data-value'),
            success:function(json){
                location.reload();
            }
        });
    });
        
});
</script>
