		<!--content-->
		<div class="content">
			<!--login-->
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<a href="#" class="active" id="reset-form-link">Enter your email to reset your password</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="reset-form" action="<?= site_url('auth/forgot_password') ?>" method="post" role="form" style="display: block;">
									<div class="form-group has-feedback">
										<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="<?php echo lang('auth_your_email') ?>" autofocus>
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
										<button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
										</div>
									</div>
									<div class="form-group has-feedback">
										<div id="infoMessage"><h4 style="color: red; margin-top: 15px;"><?php echo $message;?></h4></div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--login-->
		</div>
		<!--content-->
