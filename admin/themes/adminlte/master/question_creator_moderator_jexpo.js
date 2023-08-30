$(document).ready(function () {
    
    $('.select2').select2();
    
    $(document).on('click', '.changeStatus', function(){
        
        var tr_id  = $(this).closest('tr').prop('id'),
        buttonName = $(this).attr('data-name'),
        self = this;
        
        var updateStatus = successText = buttonText = $td_action = $td_status = '';

        if(buttonName == 'Activate')
        {
            updateStatus  = 1;
            successText   = 'Activated';
            buttonText    = 'Yes, Activate it!';
        } 
        else 
        {
            updateStatus  = 2;
            successText   = 'Suspended';
            buttonText    = 'Yes, Suspend it!';
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to "+buttonName+" this Creator/Moderator!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: buttonText
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: "master/question_creator_moderator_jexpo/change_creator_moderator_status/"+tr_id,
                    type: 'GET',
                    dataType: "json",
                    data: {updateStatus: updateStatus}
                })
                .done(function(response) {
                    
                    if(buttonName == 'Activate')
                    {
                        $("#"+tr_id).find("td:last").prev().find("small").removeClass('label-danger').addClass('label-success').text('Active');
                        $(self).removeClass('btn-success').addClass('btn-danger').attr("data-name", "Suspend");
                    } 
                    else 
                    {
                        $("#"+tr_id).find("td:last").prev().find("small").removeClass('label-success').addClass('label-danger').text('Suspended');
                        $(self).removeClass('btn-danger').addClass('btn-success').attr("data-name", "Activate");
                    }
                    
                    Swal.fire(successText+'!', 'Creator/Moderator has been '+successText+'.', 'success');
                })
                .fail(function(res) {
                    Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
                });
            }
        });

    });


    $("#exam_type").change(function(){
		var exam_type = $("#exam_type").val();
		var url = 'master/question_creator_moderator_jexpo/get_subject/'+ exam_type;
		$.ajax({
			url: url,
			success: function(result){
				$("#subject_id").html(result);
			}
		});
	});
    
});