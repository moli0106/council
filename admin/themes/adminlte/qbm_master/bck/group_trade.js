$(document).ready(function () {
    $('.select2').select2();
    


    $("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//alert(course_id);
		var url = 'qbm_master/group_trade/get_discipline/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#discipline_id").html(result);
			}
		});
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	



	$("#question_for_id").change(function(){
		var question_for_id = $("#question_for_id").val();
	    //alert(question_for_id);
		if(question_for_id=='1'){
			var url = 'question/add_question/get_question_type_trainee';
			$.ajax({
				url: url,
				success: function(result){
					$("#question_type_id").html(result);
				}
			});
		} else if(question_for_id=='2'){
			var url = 'question/add_question/get_question_type_assessor';
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

	$("#course_id").change(function(){
		var course_id = $("#course_id").val();
		var url = 'question/add_question/get_nos/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#nos_id").html(result);
			}
		});
	});


});