		<!--content-->
		<div class="content-contact">
			<!--login-->
			<div class="col-md-6 col-md-offset-3">
			<div class="container-contact">
			<div class="row">

                <div class="col-xl-8 offset-xl-2 py-5">

                    <h1 style="color: blue;">Thank you!</h1>

                    <p class="lead" style="margin-top: 20px;">Your order has been submitted successfully.</p>

					<div class="messages"></div>

                </div>

            </div>

		</div>
			<!--login-->
	</div>
</div>
		<!--content-->
		
<script>
$(function () {

	var url = "<?php echo site_url();?>emailsvc/mail-order/";

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
			}
		}
	});
	return false;
});
</script>
