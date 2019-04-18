		<!--content-->
		<div class="content-contact">
			<!--login-->
			<div class="col-md-6 col-md-offset-3">
			<div class="container-contact">
			<div class="row">

                <div class="col-xl-8 offset-xl-2 py-5">

                    <h1 style="color: red;">Quick Contact</h1>

                    <p class="lead">Contact us today, and get reply with in 24 hours!</p>

                    <!-- We're going to place the form here in the next step -->
                    <form id="contact-form" method="post" action="#" role="form">

							<div class="messages"></div>

							<div class="controls">

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="form_name">Firstname *</label>
										<input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="form_lastname">Lastname *</label>
										<input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
										<div class="help-block with-errors"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="form_email">Email *</label>
										<input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="form_need">Please specify your need *</label>
										<select id="form_need" name="need" class="form-control" required="required" data-error="Please specify your need.">
											<option value=""></option>
											<option value="Request quotation">Request quotation</option>
											<option value="Request order status">Request order status</option>
											<option value="Request copy of an invoice">Request copy of an invoice</option>
											<option value="Request for Service">Request for Service</option>
											<option value="Other">Other</option>
										</select>
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="form_phone">Phone *</label>
										<input id="form_phone" type="phone" name="phone" class="form-control" placeholder="Please enter your Phone Number *" required="required" data-error="Phone number is required.">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="form_emailto">Which Office you want to contact *</label>
										<select id="form_emailto" name="emailto" class="form-control" required="required" data-error="Please specify which office you wanna contact *">
											<option value="marketing@askitchen.com">Bali Head Office</option>
											<option value="retail@askitchen.com">Utensil Division</option>
											<option value="makassar@askitchen.com">Makassar Office</option>
										</select>
										<div class="help-block with-errors"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="form_message">Message *</label>
										<textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please, leave us a message."></textarea>
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-12">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6Le1AowUAAAAAF_pBHB401tykRs1buhibhqTC0uy" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                        <input class="form-control hidden" data-recaptcha="true" required data-error="Please complete the Captcha">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
								<div class="col-md-12">
									<input type="submit" class="btn btn-success btn-send" value="Send message">
									<input type="reset" id="reset" class="btn btn-reset" value="Reset">
								</div>
								<?php if (isset($this->data['message']))
								{
								  echo ' <div class="col-md-12">\n'.
								  $this->data['message'] .
								  '</div>';
								  } ?>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="text-muted">
										<strong>*</strong> These fields are required.</p>
								</div>
							</div>
						</div>
					</form> 

                </div>

            </div>

		</div>
			<!--login-->
	</div>
</div>
		<!--content-->
		
<script>
$(function () {

// init the validator
// validator files are included in the download package
// otherwise download from http://1000hz.github.io/bootstrap-validator

    window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change')
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change')
    }


$('#contact-form').validator();


// when the form is submitted
$('#contact-form').on('submit', function (e) {

	// if the validator does not prevent form submit
	if (!e.isDefaultPrevented()) {
		var url = "<?php echo site_url();?>emailsvc/contact-us/";

		// POST values in the background the the script URL
		$.ajax({
			type: "POST",
			url: url,
			data: $(this).serialize(),
			success: function (data)
			{
				// data = JSON object that contact.php returns
				var obj = JSON.parse(data);

				// we recieve the type of the message: success x danger and apply it to the 
				var messageAlert = 'alert-' + obj.type;
				var messageText = obj.message;

				// let's compose Bootstrap alert box HTML
				var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
				
				// If we have messageAlert and messageText
				if (messageAlert && messageText) {
					// inject the alert to .messages div in our form
					var el = $('#contact-form').find('.messages');
					el.html(alertBox);
					// empty the form
					$('#contact-form')[0].reset();
				}
			}
		});
		return false;
	}
})
});
</script>
<script>
$('#reset').on('click', function()
    {
        $('#contact-form').reset();
    });
</script>
