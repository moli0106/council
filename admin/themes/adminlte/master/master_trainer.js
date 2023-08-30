$(document).ready(function () {
    
    $('.select2').select2();

    $(document).on('click', '.getSectorJobRole', function(){
        var rowId = $(this).closest("tr").prop("id");

        $.ajax({
            url: "master/master_trainer/getSectorJobRole",
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
    
    $(document).on('change', '.sector-id', function(){
        var sector_id = $(this).val()
        roeDiv = $(this).closest(".row")
        option = '<option value="" hidden="true">Select Job Role</option><option value="" disabled="true">Please wait a moment...</option>';
        roeDiv.find(".job_role_id").html(option);

        $.ajax({
            url: "master/master_trainer/getJobRole",
            type: 'GET',
            dataType: "json",
            data: {sector_id: sector_id},
        })
        .done(function(response) {
            // $('#job_role_id').html(response);
            roeDiv.find(".job_role_id").html(response);
        })
        .fail(function(res) {
            Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
        });
    });
    
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
            text: "You want to "+buttonName+" this trainer.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: buttonText
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: "master/master_trainer/changeTrainerStatus/"+tr_id,
                    type: 'GET',
                    dataType: "json",
                    data: {updateStatus: updateStatus}
                })
                .done(function(response) {
                    
                    if(buttonName == 'Activate')
                    {
                        $("#"+tr_id).find("td:last").prev().find("small").removeClass('label-danger').addClass('label-success').text('Activate');
                        $(self).removeClass('btn-success').addClass('btn-danger').attr("data-name", "Suspend");
                    } 
                    else 
                    {
                        $("#"+tr_id).find("td:last").prev().find("small").removeClass('label-success').addClass('label-danger').text('Suspended');
                        $(self).removeClass('btn-danger').addClass('btn-success').attr("data-name", "Activate");
                    }
                    
                    Swal.fire(successText+'!', 'Trainer has been '+successText+'.', 'success');
                })
                .fail(function(res) {
                    Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
                });
            }
        });

    });

    $(document).on('click', '.btn-add', function () {
        var rawHtml = $(this).closest(".row").html();
        var btn = '\
            <div class="form-group" style="text-align: center;">\
                <label class="" for="">&nbsp;</label><br>\
                <button type="button" class="btn btn-danger btn-sm btn-remove"><i class="fa fa-times" aria-hidden="true"></i></button>\
            </div>';
        $("#dynamicForm").append('<div class="row">'+rawHtml+'</div>');
        $("#dynamicForm .row:last").find('.col-md-2').html(btn);

    });

    $(document).on('click', '.btn-remove', function () {
        $(this).closest(".row").remove();
    });

    $("#masterTrainerForm").submit(function (e) { 
        var sectorId = new Array();
        var jobRole  = new Array();

        $('.sector-id').each(function (i, v) { 
            if(!$(this).val()){
                e.preventDefault(); 
                Swal.fire('Please select Sector.'); 
                return false;
            } else {
                sectorId.push($(this).val());
            }
        });
        $('.job_role_id').each(function (i, v) { 
            if(!$(this).val()){
                e.preventDefault(); 
                Swal.fire('Please select Job Role.'); 
                return false;
            } else {
                jobRole.push($(this).val());
            }
        });

        if((jobRole.length) > ((Array.from(new Set(jobRole))).length)) {
            e.preventDefault(); 
            Swal.fire('Job Role should not be duplicate.'); 
            return false;
        }

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
            successText = 'Suspended';
            buttonText = 'Yes, Deactivate it!';
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to " + buttonName + " this Job Role.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: buttonText
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "master/master_trainer/changeJobRoleStatus/" + tr_id,
                    type: 'GET',
                    dataType: "json",
                    data: { updateStatus: updateStatus }
                })
                    .done(function (response) {

                        if (buttonName == 'Activate') {
                            $("#" + tr_id).find("td:last").prev().find("small").removeClass('label-danger').addClass('label-success').text('Activate');
                            $(self).removeClass('btn-success').addClass('btn-danger').attr("data-name", "Suspend");
                        }
                        else {
                            $("#" + tr_id).find("td:last").prev().find("small").removeClass('label-success').addClass('label-danger').text('Suspended');
                            $(self).removeClass('btn-danger').addClass('btn-success').attr("data-name", "Activate");
                        }

                        Swal.fire(successText + '!', 'Trainer has been ' + successText + '.', 'success');
                    })
                    .fail(function (res) {
                        Swal.fire('Error!', 'Oops! Something went wrong', 'error');
                    });
            }
        });

    });
	
	
	$(document).on('change', '.update-sector-id', function () {
        var sector_id = $(this).val()
        roeDiv = $(this).closest(".row")
        option = '<option value="" hidden="true">Select Job Role</option><option value="" disabled="true">Please wait a moment...</option>';
        roeDiv.find(".job_role_id").html(option);

        var id_hash = $('#master_trainer_id_hash').val();

        $.ajax({
            url: "master/master_trainer/getJobRoleToUpdate",
            type: 'GET',
            dataType: "json",
            data: { id_hash: id_hash, sector_id: sector_id },
        })
            .done(function (response) {
                // $('#job_role_id').html(response);
                roeDiv.find(".job_role_id").html(response);
            })
            .fail(function (res) {
                option = '<option value="" hidden="true">Select Job Role</option><option value="" disabled="true">Select Sector First...</option>';
                Swal.fire('Error!', 'Oops! Something went wrong', 'error');
            });
    });
    
});