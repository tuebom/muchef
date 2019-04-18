    <!--content-->
	<div class="content" style="background-color:lightgrey;">
		<div class="container">
			<div class="product-agileinfo-grids w3l">
				<div class="col-md-3">
					<!-- <div class="row">
						<img class="profile" src="<?= site_url('images/men3.jpg'); ?>" alt="profile"/>
						<span class="profile"style=""><b>Nama Member</b><br><i class="fa fa-pencil"></i>&nbsp;<a>Ubah Profil</a></span></a>
					</div>
					<div class="row">
                        <div class>
                            <ul class="tree-list-pad">
                            <li><input type="checkbox" id="item-01" /><label class="tree" for="item-01"><span></span>Profil Saya</label></li>
                            <li><input type="checkbox" id="item-02" /><a href="<?php echo site_url('akun?p=bb'); ?>">Belanjaan Saya</a></li>
                            </ul>
                        </div>
                    </div> -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                        <img class="propic img-responsive img-circle" src="<?= site_url('images/men3.jpg'); ?>" alt="User profile picture">

                        <h4 class="profile-username text-center"><?=$this->data['anggota']->first_name ?> <?=$this->data['anggota']->last_name ?></h4>

                        <!-- <p class="text-muted text-center">Software Engineer</p> -->

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item"><b><a class="profile" href="<?php echo site_url('akun'); ?>">Profil Saya</a></b></li>
                            <li class="list-group-item"><b><a class="profile" href="<?php echo site_url('akun?p=bb'); ?>">Belanjaan Saya</a></b></li>
                            <li class="list-group-item"><b><a class="profile" href="<?php echo site_url('akun?p=histori'); ?>">Histori</a></b></li>
                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block btn-profile"><b>Update Profile</b></a> -->
                        <a href="#" class="btn btn-sm btn-default btn-block btn-flat btn-profile">Update Profile</a>
                        <input id="userfile" name="userfile" type="file" style="display: none;">
                        </div>
                        <!-- /.box-body -->
                    </div>
				</div>
				<div class="col-md-9">
					<div class="row profile">
                        <div class="col-md-12">
                            <h4>Profil Saya</h4>
                        </div>
                        <form id="frmAkun" action="<?= site_url('akun'); ?>" method="post">

                        <input type="hidden" name="mbrid" value="<?=isset($this->data['anggota']->id) ? $this->data['anggota']->id : '';?>">
                        <input type="hidden" name="submit1" value="submit">
                        <div class="col-md-8">
                            <div class="profile">
                                <div class="row">
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="firstname"><?= lang('account_first_name') ?></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?=isset($this->data['anggota']->first_name) ? $this->data['anggota']->first_name : '';?>" placeholder="Enter first name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="lastname"><?= lang('account_last_name') ?></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?=isset($this->data['anggota']->last_name)? $this->data['anggota']->last_name : '';?>" placeholder="Enter last name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">    
                                        <div class="form-group">
                                            <label for="company"><?= lang('account_company') ?></label>
                                            <input type="text" class="form-control" id="company" name="company" value="<?=isset($this->data['anggota']->company)? $this->data['anggota']->company : '';?>" placeholder="Enter company name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">    
                                        <div class="form-group">
                                            <label for="address"><?= lang('account_address') ?></label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?=isset($this->data['anggota']->address)? $this->data['anggota']->address : '';?>" placeholder="Enter address" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="province"><?= lang('account_province') ?></label>
                                            <select id="province" name="province" class="form-control">
                                                <?php
                                                    foreach ($this->data['provinsi'] as $itemx) {
                                                ?>
                                                <option value="<?= $itemx->id ?>"<?php if( $this->data['anggota']->province == $itemx->id ): ?> selected="selected"<?php endif; ?>><?= $itemx->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="regency"><?= lang('account_regency') ?></label>
                                            <select id="regency" name="regency" class="form-control">
                                            <?php
                                                if (isset($this->data['kabupaten'])) :
                                                    foreach ($this->data['kabupaten'] as $item) {
                                            ?>
                                            <option value="<?= $item->id ?>"<?php if( $this->data['anggota']->regency == $item->id ): ?> selected="selected"<?php endif; ?>><?= $item->name ?></option>
                                            <?php   }
                                                endif;
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="district"><?= lang('account_district') ?></label>
                                            <select id="district" name="district" class="form-control">
                                            <?php
                                                if (isset($this->data['kecamatan'])) :
                                                    foreach ($this->data['kecamatan'] as $item) {
                                            ?>
                                            <option value="<?= $item->id ?>"<?php if( $this->data['anggota']->district == $item->id ): ?> selected="selected"<?php endif; ?>><?= $item->name ?></option>
                                            <?php   }
                                                endif;
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="zip"><?= lang('account_post_code') ?></label>
                                            <input type="text" class="form-control" id="post_code" name="post_code" value="<?=isset($this->data['anggota']->post_code)? $this->data['anggota']->post_code : '';?>" placeholder="Enter post code">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="phone"><?= lang('account_phone') ?></label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?=isset($this->data['anggota']->phone)? $this->data['anggota']->phone : '';?>" placeholder="Enter phone number">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">    
                                        <div class="form-group">
                                            <label for="email"><?= lang('account_email') ?></label>
                                            <input type="text" class="form-control" id="email" name="email" value="<?=isset($this->data['anggota']->email)? $this->data['anggota']->email : '';?>" placeholder="Enter email address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9"></div>
                                <div class="col-md-3"><a href="javascript:void(0);" id="btnUpdate" class="btn btn-primary btn-block">Update</a></div>
                            </div>
						</div>
                        </form>
						<!-- <div class="col-md-4">
							<div class="row profile-grid"><img class="propic img-responsive img-circle" src="<?= site_url('images/men3.jpg'); ?>"></div>
							<div class="row profile-grid"><a class="button-pic" href="#">Pilih Gambar</a></div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--content-->

	<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#btnUpdate').click(function(event) {
            event.preventDefault();
            $('#frmAkun').submit();
        });
        
        $('#province').change(function(){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>akun/regencies/"+$(this).val(),
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
                        url: "<?php echo site_url();?>akun/districts/"+firstid,
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
                url: "<?php echo site_url();?>akun/districts/"+$(this).val(),
                success:function(json){
                    var data = json.data;
                    $('#district').html('');
                    for (var i = 0; i < data.length; i++) {
                        $('#district').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                    }
                },
            });
        });

        // update profile
        $('.btn-profile').on('click', function (c) {
            $('#userfile').trigger("click");
        });
    });
	</script>
