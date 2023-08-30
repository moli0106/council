$(document).ready(function () {
    $('.select2').select2();
    
    

    //Question Details View
	$(".question_view").click(function(){
		var file_hash = $(this).attr('href');
		$('#myModal .modal_title').text('View Question Details');
		//alert(file_hash);
		
		$('#modal_view').html(file_hash);
		var url = 'mis/question_list/ajax_view_question/'+file_hash;
		$.ajax({
			type: 'GET',
			url: url,
			success: function(result){
				$('#modal_view').html(result);
			},
			 beforeSend: function(){
				$('#modal_view').html('<div class="loader_con"><div class="loader"></div>Loading ...</div>');
			}
		});
	});
	
	
	
	
	
	// Added
	
	$("#sector_id").change(function(){
		var sector_id = $("#sector_id").val();
		var url = 'mis/question_list/get_course/'+ sector_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#course_id").html(result);
			}
		});
	});
	$("#question_for_id").change(function(){
		var question_for_id = $("#question_for_id").val();
	    //alert(question_for_id);
		if(question_for_id=='1'){
			var url = 'mis/question_list/get_question_type_trainee';
			$.ajax({
				url: url,
				success: function(result){
					$("#question_type_id").html(result);
				}
			});
		} else if(question_for_id=='2'){
			var url = 'mis/question_list/get_question_type_assessor';
			$.ajax({
				url: url,
				success: function(result){
					$("#question_type_id").html(result);
				}
			});
		} 
	});


	$("#question_pattern").change(function(){
		var question_pattern = $("#question_pattern").val();
        //alert(question_pattern);
        if(question_pattern=='1'){
            $(".que_pic_hide_show").hide();
            //$("#centre_code").val("");
        } else{
            $(".que_pic_hide_show").show();
            //$("#centre_code").val("");
        } 
    });
	$("#option_pattern").change(function(){
		var option_pattern = $("#option_pattern").val();
        //alert(question_pattern);
        if(option_pattern=='1'){
            $(".option_pic_hide_show").hide();
            $(".option_text_hide_show").show();
            //$("#centre_code").val("");
        } else{
            $(".option_pic_hide_show").show();
            $(".option_text_hide_show").hide();
            //$("#centre_code").val("");
        } 
    });

	$("#question_for_id").change(function(){
		var question_for_id = $("#question_for_id").val();
        //alert(question_pattern);
        if(question_for_id=='1'){
            $(".module_show_hide").hide();
            $(".nos_show_hide").show();
            $("#nos_id").val("");
        } else if(question_for_id=='2'){
            $(".module_show_hide").show();
            $(".nos_show_hide").hide();
            $("#module_id").val("");
        }else{
            $(".module_show_hide").hide();
            $(".nos_show_hide").hide();
            $("#module_id").val("");
            $("#nos_id").val("");
        }  
    });

});