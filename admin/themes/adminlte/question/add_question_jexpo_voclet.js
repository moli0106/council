$(document).ready(function () {
    $('.select2').select2();
    


    $("#exam_type").change(function(){
		var exam_type = $("#exam_type").val();
		var url = 'question/add_question_jexpo_voclet/get_subject/'+ exam_type;
		$.ajax({
			url: url,
			success: function(result){
				$("#subject_id").html(result);
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


});