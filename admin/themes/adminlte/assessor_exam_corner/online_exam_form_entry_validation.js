

// var j = jQuery.noConflict();

$(document).ready(function(e) {
	
		

	$(document).on('submit', '#test_screen', function(e){
		Swal.fire({
			title: 'Are you sure?',
			text: "You want to exit the exam.!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, proceed!'
		}).then((result) => {
			if (result.isConfirmed) 
			{
				console.log('test completed');
			}
			else
			{
				e.preventDefault();
			}
		});
	});
	
	
	$("#degree_name").change(function(){
		var degree_code = $("#degree_name").val();
		var url = 'exam_corner/Online_exam/get_course/'+ degree_code;
		$.ajax({
			url: url,
			success: function(result){
				$("#course_name").html(result);
			}
		});
	});	
	
	

	$("#course_name").change(function(){
		var course_id = $("#course_name").val();
		var url = 'exam_corner/Online_exam/get_semester/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				//alert(result)
				$("#semester_name").html(result);
			}
		});
	});	
	
	
	
	$("#semester_name").change(function(){
		var semester_id = $("#semester_name").val();
		var url = 'exam_corner/Online_exam/get_subject/'+ semester_id;
		$.ajax({
			url: url,
			success: function(result){
				//alert(result)
				$("#subject_name").html(result);
			}
		});
	});	



	$("#subject_name").change(function(){
		var subject_id = $("#subject_name").val();
		var url = 'exam_corner/Online_exam/get_module/'+ subject_id;
		$.ajax({
			url: url,
			success: function(result){
				//alert(result)
				$("#module_name").html(result);
			}
		});
	});
	
	
	$("#module_name").change(function(){
		var module_id = $("#module_name").val();
		var url = 'exam_corner/Online_exam/get_level/'+ module_id;
		$.ajax({
			url: url,
			success: function(result){
				//alert(result)
				$("#level_name").html(result);
			}
		});
	});
	
		
	$("#online_exam_choice").submit(function(e) {
		
		var validation_flag = true;
		
		var degree_name = $("#degree_name").val();
				
		var course_name = $("#course_name").val();	
				
		var subject_name = $("#subject_name").val();	
		
		var level_name = $("#level_name").val();

		var semester_name = $("#semester_name").val();

		var module_name = $("#module_name").val();
	
		
		
		

		if(degree_name === "")
		{
			$("#degree_name_msg").html("Please Select Degree.");
			$("#degree_name_msg").show('slow');
			$("#degree_name").css("border-color","#F55");
			
			validation_flag = false;
		}
		else if(course_name === "")
		{
			$("#course_name_msg").html("Please select course.");
			$("#course_name_msg").show('slow');
			$("#course_name").css("border-color","#F55");
			
			validation_flag = false;
		}
		
		else if(semester_name === "")
		{
			$("#semester_name_msg").html("Please Select Semester.");
			$("#semester_name_msg").show('slow');
			$("#semester_name").css("border-color","#F55");
			
			validation_flag = false;
		}

		else if(subject_name === "")
		{
			$("#subject_name_msg").html("Please enter subject.");
			$("#subject_name_msg").show('slow');
			$("#subject_name").css("border-color","#F55");
			
			validation_flag = false;

		}

		else if(module_name === "")
		{
			$("#module_name_msg").html("Please Select Module.");
			$("#module_name_msg").show('slow');
			$("#module_name").css("border-color","#F55");
			
			validation_flag = false;
		}
		
		else if(level_name === "")
		{
			$("#level_name_msg").html("Please Select Level.");
			$("#level_name_msg").show('slow');
			$("#level_name").css("border-color","#F55");
			
			validation_flag = false;
		}

		

		
		
		
		
		
		
		if(validation_flag == false)
		{
			return false;
		}
		else
		{
			return true;
		}
		
		
    });
	
	
	$("#degree_name").focus(function(e) {
	
	   $("#degree_name_msg").hide();
	   $(this).css("border-color","");
    });
	
	$("#course_name").focus(function(e) {
	
	   $("#course_name_msg").hide();
	   $(this).css("border-color","");
    });
	$("#subject_name").focus(function(e) {
	
	   $("#subject_name_msg").hide();
	   $(this).css("border-color","");
    });
	$("#level_name").focus(function(e) {
	
	   $("#level_name_msg").hide();
	   $(this).css("border-color","");
	});
	$("#semester_name").focus(function(e) {
	
		$("#semester_name_msg").hide();
		$(this).css("border-color","");
	 });
	 $("#module_name").focus(function(e) {
	
		$("#module_name_msg").hide();
		$(this).css("border-color","");
	 });
	

	$("#question").focus(function(e) {
	
	   $("#question_msg").hide();
	   $(this).css("border-color","");
    });
	
	$("#online_exam_general_instructions").submit(function(e) {
		
		var validation_flag = true;
		
		$('input[type="checkbox"]').click(function(){
			//alert("enter");
			
           
		
			
        });
		
	});
	
	
	
});