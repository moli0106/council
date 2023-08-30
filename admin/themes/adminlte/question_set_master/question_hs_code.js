$(document).ready(function () {
    $('.select2').select2();

	$("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//var discipline_id = $("#discipline_id").val();
		//alert(discipline_id);
		var url = 'question_set_master/question_hs_code/get_subject/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#subject_id").html(result);
			}
		});
	});

	// $(document).on('change', '#course_id_update', function (e) {
	// 	var course_id = $("#course_id_update option:selected").val();
	// 	//var discipline_id = $("#discipline_id").val();
	// 	alert(course_id);
	// 	var url = 'question_set_master/question_hs_code/get_subject/'+ course_id;
	// 	$.ajax({
	// 		url: url,
	// 		success: function(result){
	// 			$("#subject_id").html(result);
	// 		}
	// 	});
	// });


	// $(document).on('change', '#course_id_update', function () {

	// 	var course_id = $(this).val();
	// 	Swal.fire({
	// 		title: 'Please wait a moment!',
	// 		html: 'loading data...',
	// 		allowEscapeKey: false,
	// 		allowOutsideClick: false,
	// 		didOpen: () => {
	// 			Swal.showLoading();

	// 			$.ajax({
	// 				url: "question_set_master/question_hs_code/get_subject_update/"+ course_id,
	// 				dataType: "json",
	// 			})
	// 				.done(function (res) {
	// 					$('#subject_id_update').html(res);
	// 					Swal.close();
	// 				})
	// 				.fail(function (res) {
	// 					Swal.fire('Warning!', 'Oops! Unable to get Course list, Please try later.', 'warning');
	// 				});
	// 		}
	// 	});
	// });

	// $(document).on('click', '.get-hs-question_code', function (e) {

	// 	var id_hash = $(this).prop('id');
	// 	var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

	// 	$('.student-data-div').html(loader);

	// 	$.ajax({
	// 		url: "question_set_master/question_hs_code/get_hs_question_code_details/" + id_hash,
	// 		type: 'GET',
	// 		dataType: "json",
	// 	})
	// 		.done(function (response) {
	// 			$('.student-data-div').html(response);
	// 		})
	// 		.fail(function (res) {
	// 			$('#modal-student-details').modal('toggle');
	// 			Swal.fire('Error!', 'Oops! Unable to get HS Question Code details.', 'error');
	// 		});
	// });


	// $(document).on('click', '#update-question-code', function () {
	// 	Swal.fire({
	// 		title: 'Warning!<br>Are you sure?',
	// 		text: "You want to update Question Code.",
	// 		icon: 'question',
	// 		showCancelButton: true,
	// 		confirmButtonColor: '#3085d6',
	// 		cancelButtonColor: '#d33',
	// 		confirmButtonText: 'Yes, Do it!',
	// 		allowEscapeKey: false,
	// 		allowOutsideClick: false
	// 	}).then((result) => {
	// 		if (result.isConfirmed) {

	// 			Swal.fire({
	// 				title: 'Please wait a moment!',
	// 				allowEscapeKey: false,
	// 				allowOutsideClick: false,
	// 				didOpen: () => {
	// 					Swal.showLoading();
	// 					$('#update-question-code-form').submit();
	// 				}
	// 			});
	// 		}
	// 	});
	// });

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
                    url: "question_set_master/question_hs_code/remove_question_code/"+id_hash,
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