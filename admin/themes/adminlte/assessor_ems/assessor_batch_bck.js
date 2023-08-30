$(document).ready(function () {
    
    $('.select2').select2();

    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });

    $('.timepicker').timepicker({
        showInputs: false,
        showMeridian: false
    });

    $(document).on('change', '#batch_type', function(){
        var batch_type = $(this).val();

        if(batch_type == 2)
        {
            $(".jobrole-div, .sector-div").hide('slow');
            $(".assessor-list-row").slideUp();
            $('#assessor-list-tbody').html('');
            $('#trainer_id, #job_role_id, #sector-id').val('');
            
            $.ajax({
                url: "assessor_ems/assessor_batch/getTrainerByJobRole",
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('#trainer_id').html(response);
                $('.select2').select2();

                $.ajax({
                    url: "assessor_ems/assessor_batch/getAssessorByJobRole",
                    type: 'GET',
                    dataType: "json",
                })
                .done(function(response) {
                    $('#assessor-list-tbody').html(response);
                })
                .fail(function(res) {
                    Swal.fire('Error!', 'Oops! Unable to get Assessor List', 'error'); 
                });

            })
            .fail(function(res) {
                Swal.fire('Error!', 'Oops! Unable to get Trainer List', 'error'); 
            });
        }
        else
        {
            $(".jobrole-div, .sector-div").show('slow');
            $(".assessor-list-row").slideUp();
            $('#assessor-list-tbody').html('');
            $('#trainer_id').val('');
        }
        
    });

    $(document).on('change', '#sector-id', function(){
        var sector_id = $(this).val();
        
        $(".assessor-list-row").slideUp();
        $('#assessor-list-tbody').html('');

        $('#trainer_id').val('').html('<option value="" disabled="true">Select Job Role First...</option>');

        $.ajax({
            url: "assessor_ems/assessor_batch/getJobRole",
            type: 'GET',
            dataType: "json",
            data: {sector_id: sector_id},
        })
        .done(function(response) {
            $('#job_role_id').html(response);
            $('.select2').select2();
        })
        .fail(function(res) {
            Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
        });
    });

    $(document).on('change', '#job_role_id', function(){

        var sector_id = $('#sector-id').val(),
        job_role_id   = $(this).val();

        $.ajax({
            url: "assessor_ems/assessor_batch/getTrainerByJobRole",
            type: 'GET',
            dataType: "json",
            data: {sector_id: sector_id, job_role_id: job_role_id},
        })
        .done(function(response) {
            $('#trainer_id').html(response)
            $('.select2').select2();

            $.ajax({
                url: "assessor_ems/assessor_batch/getAssessorByJobRole",
                type: 'GET',
                dataType: "json",
                data: {sector_id: sector_id, job_role_id: job_role_id},
            })
            .done(function(response) {
                $('#assessor-list-tbody').html(response)
            })
            .fail(function(res) {
                Swal.fire('Error!', 'Oops! Unable to get Assessor List', 'error'); 
            });

        })
        .fail(function(res) {
            Swal.fire('Error!', 'Oops! Unable to get Trainer List', 'error'); 
        });

    });

    $(document).on('change', '#trainer_id', function(){
        if($(this).val()) {
            $(".assessor-list-row").slideDown();
        } else {
            $(".assessor-list-row").slideUp();
        }
    });

    $(document).on('change', '#assment_mode', function(e){
        
        if($(this).val() == 2)
        {
            $(".venue-div").show('slow');
        }
        else
        {
            $(".venue-div").hide('slow');
        }
    });
    
    $(document).on('submit', '#assessor-batch-form', function(e){
        e.preventDefault();
        var flag = 1;
        
        if($('#batch_type').val()) 
        {
            if($('#batch_type').val() == 1) 
            {
                if($('#sector-id').val()) 
                {
                    if(!$('#job_role_id').val()) 
                    {
                        Swal.fire('Please select Job Role.');
                        flag = 0;
                        return false;
                    }
                } else {
                    Swal.fire('Please select Sector.');
                    flag = 0;
                    return false;
                }
            }
        } else {
            Swal.fire('Please select Batch Type.');
            flag = 0;
            return false;
        }
     
        if(!$('#trainer_id').val()) 
        {
            Swal.fire('Please select Master Trainer.');
            flag = 0;
            return false;
        }

        var assessorLength = ($('#assessor-list-tbody').find('input[type="checkbox"]:checked').length);
        if(assessorLength <= 0) 
        {
            Swal.fire('Please select Assessor fron the list.');
            flag = 0;
            return false;
        } 
        else
        {
            /* if($('#batch_type').val() == 1) 
            {
                if((assessorLength < 4) || (assessorLength > 40)) 
                {
                    Swal.fire('You have to select minimum 4 or maximum 40 Assessor.');
                    flag = 0;
                    return false;
                }
            }
            else
            {
                if((assessorLength < 10) || (assessorLength > 40)) 
                {
                    Swal.fire('You have to select minimum 10 or maximum 40 Assessor.');
                    flag = 0;
                    return false;
                }
            } */
        }

        $(".schedule-div").find("input").each(function(i, e) { 
            if(!$(this).val()) 
            {
                Swal.fire('Please fill '+$(this).closest(".col-md-3").find("label").text());
                flag = 0;
                return false;
            }
        });

        if(!$("#assment_mode").val()) 
        {
            Swal.fire('Please select Assessment Mode');
            flag = 0;
            return false;
        }
        else if($("#assment_mode").val() == 2) 
        {
            if(!$("#venue").val()) 
            {
                Swal.fire('Please select Venue');
                flag = 0;
                return false;
            }
        }
        else
        {
            $("#venue").val('');
        }

        if(flag)
        {
            var csrfHash = $("input[name=csrf_council]").val(),
            submitBtnDiv = $('.submitBtn-div').html();
            
            $('.submitBtn-div').html('<button type="button" class="btn btn-info btn-block form-batch-btn disabled">\
                <span>Please wait a moment...</span>\
                <i class="fa fa-spinner fa-pulse"></i>\
                </button>');

            $.ajax({
                url: "assessor_ems/assessor_batch/createBatch",
                type: 'POST',
                dataType: "json",
                data: {csrf_council: csrfHash, form_data: $('#assessor-batch-form').serialize()},
            })
            .done(function(response) {
                console.log(response);
                $("input[name=csrf_council]").val(response.csrf_token);
                $('.submitBtn-div').html(submitBtnDiv);
                Swal.fire('Created!', 'Batch successfully created.', 'success');
                //window.location.replace(response.redirect);
            })
            .fail(function(res) {
                $('.submitBtn-div').html(submitBtnDiv);
                Swal.fire('Error!', 'Oops! Something went wrong, please try again', 'error'); 
                //location.reload();
            });
        }
    });

    $(document).on('click', '.getBatchAssessorList', function(){
        var rowId = $(this).closest("tr").prop("id");

        $("#batchAssessorList").html('<tr><td colspan="4" align="center">Please wait a moment...</td></tr>');

        $.ajax({
            url: "assessor_ems/assessor_batch/getBatchAssessorList",
            type: 'GET',
            dataType: "json",
            data: {rowId: rowId},
        })
        .done(function(response) {
            $("#batchAssessorList").html(response);
        })
        .fail(function(res) {
            $('#myModalList').modal('toggle');
            Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
        });

    });

});