    <!--content-->
	<div class="content" style="background: lightgrey;">
		<div class="container">
			<div class="product-agileinfo-grids w3l">
				<div class="col-md-3">
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

                        <a href="#" class="btn btn-primary btn-block"><b>Update Profile</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
				<div class="col-md-9">
                    <div class="row">
                        <ul class="nav nav-page nav-fill">
                            <li class="nav-item"><a href="<?php echo site_url('akun?p=bb'); ?>" class="nav-link">Belum Bayar</a></li>
                            <li class="nav-item"><a href="<?php echo site_url('akun?p=bk'); ?>" class="nav-link">Belum Dikirimkan</a></li>
                            <li class="nav-item"><a href="<?php echo site_url('akun?p=bt'); ?>" class="nav-link">Belum Diterima</a></li>
                            <li class="nav-item"><a href="#" class="nav-link active">Selesai</a></li>
                        </ul>
                    </div>
                    <div class="row">
                        <?php ?>
                        <?php ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!--content-->
