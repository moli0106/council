$(document).ready(function () {
    
    $('.select2').select2();

	$('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        orientation: "top",
        startDate:'+0d' 
  });

  $('.timepicker').timepicker({
	showInputs: false,
	showMeridian: false
});

    $("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//alert(discipline_id);
		var url = 'question_set_master/upload_all_hs_question/get_subject/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#subject_id").html(result);
			}
		});
	});

	/***********File upload********************/
	$(document).on('change', ':file', function () {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	});

	// We can watch for our custom `fileselect` event like this
	$(document).ready(function () {
		$(':file').on('fileselect', function (event, numFiles, label) {

			var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;

			if (input.length) {
				input.val(log);
			} else {
				if (log) alert(log);
			}

		});
	});
	/***********End File upload********************/



	$(document).on('click', '.changeStatus', function(){
        
        var tr_row  = $(this).closest('tr')
        tr_id=tr_row.prop('id'),
        self = this;

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Approved/Reject this question.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, Approve it!",
            cancelButtonText: "Yes, Reject it!",
        }).then((result) => {
            if (result.isConfirmed) {
                questionApproveReject(5,tr_id);
            }
            else if (result.dismiss === Swal.DismissReason.cancel) {
                questionApproveReject(6,tr_id);
            }
        });

        function questionApproveReject(status,tr_id){
            $.ajax({
                url: "question_set_master/upload_all_hs_question/changeQuestion_status",
                type: 'GET',
                dataType: "json",
                data: {status: status,id_hash: tr_id}
            })
            .done(function(response) {
                if(status==5)
                {
                    tr_row.remove();
                    Swal.fire('Approved!', 'Question has been Approved', 'success');
                }
                else if(status==6)
                {
                    //tr_row.remove();
                    $("#"+tr_id).find("td:last").prev().find("small").removeClass('label-warning').addClass('label-danger').text('Rejected');
                    $(self).remove();
                    Swal.fire('Rejected!', 'Question has been Rejected', 'success');
                }
            })
            .fail(function(res) {
                Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
            });
        }
    });

	$(document).on('click', '.delete-question', function(){
        var this_tr = $(this).closest('tr');
        var question_id = $(this).closest('tr').prop('id');
        
		//alert(question_id);

        Swal.fire({
            title: 'Are you sure? Delete this qiestion',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Deleted it!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: "question_set_master/upload_all_hs_question/delete_question/",
                    type: 'GET',
                    dataType: "json",
					data:{question_id:question_id}
                })
                .done(function(response) {
                    console.log(response);
                    this_tr.remove();
                    Swal.fire('Deleted!','Deleted the Question.','success');
                })
                .fail(function(res) {
                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
                });
            }
        });
        
    });

    
});