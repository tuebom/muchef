$(document).ready(function(){
    
     // Loop all images in document
     $("img").each( function () {
		var _this = $(this);
		
		// Checking image exist or not
		$.ajax({
			url:$(this).attr('src'),
			type:'get',
			async: false,
			error:function(e){
				
				// Re-checking the default is exist or not
				// <?php echo base_url('js/brokenimage.js'); ?>
				var replace_src = <?php echo '"'.site_url('images/noimage.png').'";'; ?>
				$.ajax({
					url: replace_src,
					type:'get',
					async: false,
					success: function(){
						$(_this).attr('src',"<?php echo base_url('images/noimage.png'); ?>");
					},
					error:function(e){
						$(_this).hide();
					}
				});			
			}
		});
	});

});