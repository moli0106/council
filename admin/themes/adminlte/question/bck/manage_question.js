$(document).ready(function () {
    $('.select2').select2();
    
    $("#sector_id").change(function(){
		var sector_id = $("#sector_id").val();
        //alert(sector_id);
		var url = 'question/manage_question/get_course/'+ sector_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#course_id").html(result);
			}
		});
	});


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
                url: "question/manage_question/changeQuestion_status",
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





    $("#question_for_id").change(function(){
		var question_for_id = $("#question_for_id").val();
	    //alert(question_for_id);
		if(question_for_id=='1'){
			var url = 'question/manage_question/get_question_type_trainee';
			$.ajax({
				url: url,
				success: function(result){
					$("#question_type_id").html(result);
				}
			});
		} else if(question_for_id=='2'){
			var url = 'question/manage_question/get_question_type_assessor';
			$.ajax({
				url: url,
				success: function(result){
					$("#question_type_id").html(result);
				}
			});
		} 
	});

});