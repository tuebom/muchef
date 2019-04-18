				<div class="col-md-6 col-sm-9">
					<div class="row profile">
                        <div class="col-md-12">
                            <h4>Profil Saya</h4>
                        </div>
                        <form id="frmAkun" action="<?= site_url('akun'); ?>" method="post">

                        <input type="hidden" name="mbrid" value="<?=isset($this->data['anggota']->id) ? $this->data['anggota']->id : '';?>">
                        <input type="hidden" name="submit1" value="submit">
                        <div class="col-md-12">
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
                                                if (isset($kecamatan)) :
                                                    foreach ($kecamatan as $item) {
                                            ?>
                                            <option value="<?= $item->subdistrict_id ?>"<?php if( $anggota->district == $item->subdistrict_id ): ?> selected="selected"<?php endif; ?>><?= $item->subdistrict_name ?></option>
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
                                <div class="col-md-9 col-sm-9"></div>
                                <div class="col-md-3 col-sm-3 col-xs-12"><a href="javascript:void(0);" id="btnUpdate" class="btn btn-primary btn-block">Update</a></div>
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
                success:function(json){
                    var data = json.data,
                        firstid = data[0].id;

                    $('#regency').html('');
                    for (var i = 0; i < data.length; i++) {
                        $('#regency').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
                    }
            
                    // get post code
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url();?>akun/post-code/"+$('#regency option:selected').val(),
                        success:function(json){
                            var data = json.data;
                            $('#post_code').val(data.postal_code);
                        },
                    });

                    // get current district data
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url();?>akun/districts/"+firstid,
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
            
            // get post code
            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>akun/post-code/"+$(this).val(),
                success:function(json){
                    var data = json.data;
                    $('#post_code').val(data.postal_code);
                },
            });
            
            // get district data
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
    });
	</script>
