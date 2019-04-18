<!-- <script src="<?=base_url('assets/plugins/jqueryform/jquery.form.js');?>"></script> -->
<script type="text/javascript">
      
    function upload_foto(){

        var userfile = $('#foto').val();
        
        // $('#uploadfoto').ajaxForm({
        $.ajax({
            url: '<?php echo base_url("akun/upload_file"); ?>',
            type: 'post',
            data: new FormData('#uploadfoto'),
            
            //  beforeSend: function() {
            //     var percentVal = 'Mengupload 0%';
            //     $('.msg').html(percentVal);
            //  },
            //  uploadProgress: function(event, position, total, percentComplete) {
            //     var percentVal = 'Mengupload ' + percentComplete + '%';
            //     $('.msg').html(percentVal);
            //  },
            //  beforeSubmit: function() {
            //   $('.hasil').html('Silahkan Tunggu ... ');
            //  },
            //  complete: function(xhr) {
            //     $('.msg').html('Mengupload file selesai!');
            //  }, 
            success: function(resp) {
                $('.hasil').html(resp);
                console.log(resp);
                // $(".propic").attr("src",resp['orig_name']);
            },
        });     
    }

    $('#btnUpdate').click(function(event) {
        event.preventDefault();
        $('#frmAkun').submit();
    });
</script>    

    <!--content-->
	<div class="content" style="background-color:lightgrey;">
		<div class="container">
			<div class="product-agileinfo-grids w3l">
				<div class="col-md-3 col-sm-3">
                    <div class="box box-primary profile">
                        <div class="box-body box-profile">
                            <img class="propic img-responsive img-circle" src="<?=site_url('upload/avatar/user'.$_SESSION['mbrid'].'.png'); ?>" alt="User profile picture">

                            <h4 class="profile-username text-center"><?=$this->data['anggota']->first_name ?> <?=$this->data['anggota']->last_name ?></h4>

                            <!-- <p class="text-muted text-center">xxx</p> -->

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item"><b><a class="profile" href="<?php echo site_url('akun'); ?>">Profil Saya</a></b></li>
                                <li class="list-group-item"><b><a class="profile" href="<?php echo site_url('akun?p=bb'); ?>">Belanjaan Saya</a></b></li>
                                <li class="list-group-item"><b><a class="profile" href="<?php echo site_url('akun?p=histori'); ?>">Histori</a></b></li>
                            </ul>

                            <!-- <a href="#" class="btn btn-primary btn-block btn-profile"><b>Update Profile</b></a> -->
                            <div class="form-group">
                            <a href="#" class="btn btn-sm btn-default btn-block btn-flat btn-profile">Update Profile</a>
                            <!-- <a href="#" class="btn btn-sm btn-default btn-block btn-flat btn-upload">Upload file</a> -->
                            </div>
                            <form role="form" name="uploadfoto" id="uploadfoto" action="<?=base_url("akun/upload_file")?>" method="post" enctype="multipart/form-data">
                                <input type="file" id="foto" name="userfile" style="display: none;">
                            </form>
              
                            <script type="text/javascript">

                            $(".btn-profile").click(function(e){
                                e.preventDefault();
                                $("#foto").trigger('click');
                            });

                            $(".btn-upload").click(function(e){
                                e.preventDefault();
                                $("#uploadfoto").submit();
                            });

                            $("#foto").on("change", function(){ //When a new file is selected
                                var file = $("#foto").prop("files")[0];
                                if (file) $("#uploadfoto").submit();
                            });
                            </script>
                            <div class="form-group">
                                <div class="hasil text-center"><?= isset($message) ? $message : ''?></div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
				</div>
