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
	


});