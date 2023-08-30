$(document).ready(function () {
    $('.select2').select2();

	$("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//alert(course_id);
		var url = 'question_set_master/question_code/get_discipline/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#discipline_id").html(result);
			}
		});
	});


	$("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//alert(course_id);
		var url = 'question_set_master/question_code/get_semester/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#sam_year_id").html(result);
			}
		});
	});

	$("#discipline_id").change(function(){
		var course_id = $("#course_id").val();
		var discipline_id = $("#discipline_id").val();
		//alert(discipline_id);
		var url = 'question_set_master/question_code/get_subject/'+ course_id+'/'+discipline_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#subject_id").html(result);
			}
		});
	});


	$(document).on('click', '.remove-question-code', function(){

        var this_tr = $(this).closest('tr');
        var id_hash = this_tr.prop('id');

        Swal.fire({
            title: 'Are you sure? Delete the Question Code',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: "question_set_master/question_code/remove_question_code/"+id_hash,
                    type: 'GET',
                    dataType: "json",
                })
                .done(function(response) {
                    console.log(response);
                    this_tr.remove();
                    Swal.fire('Deleted!','Question Code has been deleted.','success');
                })
                .fail(function(res) {
                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
                });
            }
        });
        
    });

});