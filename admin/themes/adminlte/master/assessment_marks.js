$(document).ready(function () {
    
    $('.select2').select2();

    $('#example1').DataTable()

    $(document).on('change', '#sector_id', function(e){
        var sector_id = $(this).val();
        var raw_html = '<option value="" disabled="true">Please wait a moment</option>';
        $('#course_id').html(raw_html);
        
        $.ajax({
            url: "master/assessment_marks/get_courses/"+sector_id,
            type: 'GET',
            dataType: "json",
        })
        .done(function(response) {
            $('#course_id').html(response);
        })
        .fail(function(res) {
            Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
        });
    });

    $(document).on('keyup', '#nos_theory_marks, #nos_practical_marks, #nos_viva_marks', function(event){
        
        theory    = parseFloat($('#nos_theory_marks').val()) || 0;
        practical = parseFloat($('#nos_practical_marks').val()) || 0;
        viva      = parseFloat($('#nos_viva_marks').val()) || 0;
        nos_total = parseFloat($('#nos_total_marks').val()) || 0;

        var total = (nos_total + theory + practical + viva);
        $('#total_marks_for_job_role').val(total);
    });

    $(document).on('submit','form#addNos',function(event){
        
        theory    = parseFloat($('#nos_theory_marks').val()) || 0;
        no_of_que = parseFloat($('#nos_wise_no_of_theory_question').val()) || 0;
        marks     = parseFloat($('#no_of_marks_each_question_carries').val()) || 0;
        
        if((theory != 0) && (no_of_que != 0) && (marks != 0))
        {
            //if(theory != (no_of_que * marks))
			if(theory < (no_of_que * marks))
            {
                event.preventDefault();
                $('.marks-not-matched').show('slow');
            }
        }
        
    });

    $(document).on('click', '.details-nos', function(){
        
        var id_hash = $(this).closest('tr').prop('id');
        var loader  = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.nos-data').html(loader);

        $.ajax({
            url: "master/assessment_marks/getNosDetailsToUpdate/"+id_hash,
            type: 'GET',
            dataType: "json",
        })
        .done(function(response) {
            // console.log(response);
            $('.nos-data').html(response);
            $('.select2').select2();
        })
        .fail(function(res) {
            Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
        });
        
    });
    
    $(document).on('click', '.remove-nos', function(){
        
        var this_tr = $(this).closest('tr');
        var id_hash = this_tr.prop('id');

        var courseTotalMarks = $('#courseTotalMarks').text();
        var coursePassMarks  = $('#coursePassMarks').text();
        var nosTotalMarks    = this_tr.find('.nosTotalMarks').text();

        courseTotalMarks = courseTotalMarks - nosTotalMarks;

        $('#inputIdHash').val(id_hash);
        $('#inputCourseTotalMarks').val(courseTotalMarks);
        $('#inputCoursePassMarks').val(coursePassMarks);

    });

    $(document).on('click', '.confirmRemove', function(){

        var idHash       = $('#inputIdHash').val(),
        courseTotalMarks = $('#inputCourseTotalMarks').val(),
        coursePassMarks  = $('#inputCoursePassMarks').val();

        var formData = {
            'idHash': idHash,
            'courseTotalMarks': courseTotalMarks,
            'coursePassMarks': coursePassMarks,
        };

        if(coursePassMarks == '') {
            Swal.fire('Please enter correct value for pass marks.');    
        } else {
            Swal.fire({
                title: 'Are you sure? Delete the NoS',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    Swal.fire({
                        title: 'Please wait a moment!',
                        html: 'We\'ll delete the NoS.',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
    
                            setTimeout(function () {
                                $.ajax({
                                    url: "master/assessment_marks/remove_nos",
                                    type: 'GET',
                                    dataType: "json",
                                    data: formData,
                                })
                                .done(function(response) {
                                    // console.log(response);

                                    $('#courseTotalMarks').text(response.total_marks);
                                    $('#coursePassMarks').text(response.total_pass_marks);
                                    
                                    $('#' + response.idHash).remove();
                                    $('#modal-remove-nos').modal('toggle');

                                    Swal.fire('Deleted!','NoS has been deleted.','success');
									location.reload();

                                })
                                .fail(function(res) {
                                    $('#modal-remove-nos').modal('toggle');
                                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
                                });
                            }, 100);
                        }
                    });
                }
            });
        }
    });


    $(document).on('submit','form#updateNos',function(event){
        event.preventDefault();

        var formData = $('#updateNos').serialize();

        Swal.fire({
            title: 'Please wait a moment!',
            // html: 'We\'ll assigne assessor on this batch.',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();

                setTimeout(function () {

                    $.ajax({
                        url: "master/assessment_marks/update_nos_marks",
                        type: 'POST',
                        dataType: "json",
                        data: formData,
                    })
                    .done(function(response) {
                        console.log(response);

                        if(response.res_status == 1) {
                            $('#modal-update-nos').modal('toggle');
                            // Swal.fire('Updated!','NoS has been updated.','success');
                            location.reload();
                        } else {
							Swal.fire('Warning!', 'Oops! Enter correct value.', 'warning'); 
                            $('.nos-data').html(response.html_view);
                        }
                    })
                    .fail(function(res) {
                        $('#modal-update-nos').modal('toggle');
                        Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
                    });
                }, 100);

            }
        });
        
    });


    /* ----------------------------------------
    ||                                       ||
    ********** NoS Type Master JS *************
    ||                                      ||
    ---------------------------------------**/

    $(document).on('click', '#update_nos_type', function(){
        var this_tr = $(this).closest('tr');
        var id_hash = this_tr.prop('id');

        $('#update_nos_type_text').val(this_tr.find("td:eq(1)").text());
        $('#nos_type_id_hash').val(id_hash);
    });

    $(document).on('click', '#update_nos_type_btn', function(){

        var nos_type = $('#update_nos_type_text').val();
        var id_hash  = $('#nos_type_id_hash').val();

        Swal.fire({
            title: 'Please wait a moment!',
            // html: 'We\'ll assigne assessor on this batch.',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();

                setTimeout(function () {
                    $.ajax({
                        url: "master/nos_master/update_nos_type",
                        type: 'GET',
                        dataType: "json",
                        data: {'id_hash': id_hash, 'nos_type': nos_type},
                    })
                    .done(function(response) {
                        console.log(response);
                        $('#' + id_hash).find("td:eq(1)").text(nos_type);

                        $('#modal-update-nos-type').modal('toggle');

                        Swal.fire('Success!', 'NoS Type updated successfully', 'success');
                    })
                    .fail(function(res) {
                        $('#modal-update-nos-type').modal('toggle');
                        Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
                    });
                }, 100);

            }
        });
    });


    $(document).on('click', '.remove-nos-type', function(){

        var this_tr = $(this).closest('tr');
        var id_hash = this_tr.prop('id');

        Swal.fire({
            title: 'Are you sure? Delete the NoS Type',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: "master/nos_master/remove_nos_type/"+id_hash,
                    type: 'GET',
                    dataType: "json",
                })
                .done(function(response) {
                    console.log(response);
                    this_tr.remove();
                    Swal.fire('Deleted!','NoS has been deleted.','success');
                })
                .fail(function(res) {
                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
                });
            }
        });
        
    });

});