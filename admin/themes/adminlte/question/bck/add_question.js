$(document).ready(function () {
    $('.select2').select2();
    

    $("#sector_id").change(function(){
		var sector_id = $("#sector_id").val();
		var url = 'question/add_question/get_course/'+ sector_id;
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


});