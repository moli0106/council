$(document).ready(function () {
    $('.select2').select2();

	$("#course_id").change(function(){
		var course_id = $("#course_id").val();
        //alert(question_pattern);
        if(course_id=='1' || course_id=='2'){
            $(".hsvoc_hide_show").show();
            $(".poly_hide_show").hide();
        } else{
            $(".hsvoc_hide_show").hide();
            $(".poly_hide_show").show();
        } 
    });

	$("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//alert(course_id);
		var url = 'qbm_master/subject/get_discipline/'+ course_id;
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
		var url = 'qbm_master/subject/get_group_trade/'+ discipline_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#group_trade_id").html(result);
			}
		});
	});

	$("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//alert(course_id);
		var url = 'qbm_master/subject/get_semester/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#sam_year_id").html(result);
			}
		});
	});


});