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
                    url: "master/question_creator_moderator/change_creator_moderator_status/"+tr_id,
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
	
	
	$(document).on('click', '.getSectorJobRole', function(){
        var rowId = $(this).closest("tr").prop("id");

        $.ajax({
            url: "master/question_creator_moderator/getSector",
            type: 'GET',
            dataType: "json",
            data: {rowId: rowId},
        })
        .done(function(response) {
            $("#sectorJobRoleList").html(response);
        })
        .fail(function(res) {
            $('#myModalList').modal('toggle');
            Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
        });
    });



    $(document).on('click', '.changeJobRoleStatus', function () {

        var tr_id = $(this).closest('tr').prop('id'),
            buttonName = $(this).attr('data-name'),
            self = this;

        var updateStatus = successText = buttonText = '';

        if (buttonName == 'Activate') {
            updateStatus = 1;
            successText = 'Activated';
            buttonText = 'Yes, Activate it!';
        }
        else {
            updateStatus = 2;
            successText = 'Deactivated';
            buttonText = 'Yes, Deactivate it!';
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to " + buttonName + " this Sector.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: buttonText
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "master/question_creator_moderator/changeJobRoleStatus/" + tr_id,
                    type: 'GET',
                    dataType: "json",
                    data: { updateStatus: updateStatus }
                })
                    .done(function (response) {

                        if (buttonName == 'Activate') {
                            $("#" + tr_id).find("td:last").prev().find("small").removeClass('label-danger').addClass('label-success').text('Active');
                            $(self).removeClass('btn-success').addClass('btn-danger').attr("data-name", "Deactive");
                        }
                        else {
                            $("#" + tr_id).find("td:last").prev().find("small").removeClass('label-success').addClass('label-danger').text('Deactive');
                            $(self).removeClass('btn-danger').addClass('btn-success').attr("data-name", "Active");
                        }

                        Swal.fire(successText + '!', 'Question Creator/Moderator has been ' + successText + '.', 'success');
                    })
                    .fail(function (res) {
                        Swal.fire('Error!', 'Oops! Something went wrong', 'error');
                    });
            }
        });

    });
    
});