		<!--content-->
		<div class="content">
			<!--login-->
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<a href="#" class="active" id="reset-form-link">Reset Password</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="reset-form" action="<?= site_url('auth/reset_password/'. $code) ?>" method="post" role="form" style="display: block;">
									<div class="form-group has-feedback">
										<?php echo form_input($new_password);?>
										<span class="glyphicon glyphicon-lock form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<?php echo form_input($new_password_confirm);?>
										<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
									</div>
									<?php echo form_input($user_id);?>
									<?php echo form_hidden($csrf); ?>
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
