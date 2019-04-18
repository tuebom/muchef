		<!--content-->
		<div class="content">
			<!--login-->
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<a href="#" class="active" id="reset-form-link"><?=$status_message?></a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="row text-center">
									<h4 style="padding: 15px 0px">Order # <?=$order_id?></h4>
									<h4 style="padding: 15px 0px">Total Amount: Rp<?=$gross_amount?></h4>
									<h4 style="padding: 15px 0px">Payment Type: <?=$payment_type?></h4>
									<?php if(isset($bank)):?><h4 style="padding: 15px 0px">Bank: <?=$bank ?></h4><?php endif;?>
								</div>
								<div class="row">
									<div class="col-md-6 col-md-offset-3">
										<?php if (isset($_SESSION['guest'])): ?>
										<a class="btn btn-primary btn-block btn-flat" href="<?=$_SESSION['context'] == 1 ? site_url('equipment'):site_url('utensil') ?>">CONTINUE SHOPPING</a>
										<?php else: ?>
										<a class="btn btn-primary btn-block btn-flat" href="<?=site_url('akun?p=pending') ?>">VIEW MY ORDER</a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--login-->
		</div>
		<!--content-->