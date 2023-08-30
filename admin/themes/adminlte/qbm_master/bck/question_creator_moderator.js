$(document).ready(function () {
    
    $('.select2').select2();


	$("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//alert(course_id);
		var url = 'qbm_master/question_creator_moderator/get_discipline/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#discipline_id").html(result);
			}
		});
	});


    $("#discipline_id").change(function(){
		var discipline_id = $("#discipline_id").val();
		//alert(discipline_id);
		var url = 'qbm_master/question_creator_moderator/get_subject/'+ discipline_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#subject_id").html(result);
			}
		});
	});



    
});