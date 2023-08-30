$(document).ready(function () {
    
    $('.select2').select2();


	// $("#course_id").change(function(){
	// 	var course_id = $("#course_id").val();
	// 	//alert(course_id);
	// 	var url = 'qbm_master/question_creator_moderator/get_discipline/'+ course_id;
	// 	$.ajax({
	// 		url: url,
	// 		success: function(result){
	// 			$("#discipline_id").html(result);
	// 		}
	// 	});
	// });


    $("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//alert(discipline_id);
		var url = 'qbm_master/question_creator_moderator/get_subject/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#subject_id").html(result);
			}
		});
	});
	
	$(document).on('click','#send_password',function(){
		var qcm_id_hash = $(this).attr('rel');
		//var path = <?php echo $this->config->item('theme_uri'); ?>
		//alert(qcm_id_hash);
		if(qcm_id_hash != "")
		{
			var url = 'qbm_master/question_creator_moderator/password_mail/'+qcm_id_hash;
			$.ajax({
				url: url,
				dataType: "text",
				success: function(result)
				{
					var check_result=JSON.parse(result);
					if(check_result.status=='true')
					{
						alert('MAIL SENT');
					}
					else
					{
						alert(check_result.status);
					}
				},
				beforeSend: function()
				{
					$('#send_password_div').hide();
					$('#send_password').attr('src','themes/adminlte/assets/image/loading_bar.gif');
				}
			});
			
		}
	});



    
});