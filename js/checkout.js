<?php $url = site_url("checkout/search");?>
$(document).ready(function() {
    $('#province').change(function(){
        // alert($(this).val())
        // $.ajax({
        //         type: 'POST',
        //         url: 'Change-status.php',
        //         data: {selectFieldValue: $('select.changeStatus').val(), projectId: $('input[name$="projectId"]').val()},
        //         dataType: 'html'
        //  });
        $.ajax({
            type: "POST",
            url: <?php echo $url;?>+$(this).val(),
            dataType: "json",
            success:function(data){
            //   alert(data);
              console.log(data)
              $('#kabupaten').html('');
              for (var i = 0; i < data.length; i++) {
                $$('#kabupaten').append('<option value="'+data[i].id+'">'+data[i].name+'</option>')
              }
              },
        });
    });
});