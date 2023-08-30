$(document).ready(function() {

    $('.select2').select2();

    $(".date-picker").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });

    $(document).on('click', '.get-batch-details', function(e) {

        var id_hash = $(this).closest('tr').prop('id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.assessment-data').html(loader);

        $.ajax({
                url: "assessment/assessing/batch/details/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.assessment-data').html(response);
            })
            .fail(function(res) {
                $('#modal-batch-details').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get batch details.', 'error');
            });
    });

    $(document).on('click', '.assign-assessor-to-batch', function(e) {

        var id_hash = $(this).closest('tr').prop('id');

        Swal.fire({
            title: 'Assign Assessor to Batch?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Assign!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'We\'ll assigne assessor on this batch.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: $("#assign-assessor-form").prop('action'),
                                    type: 'GET',
                                    dataType: "json",
                                    data: { 'id_hash': id_hash },
                                })
                                .done(function(response) {
                                    if (!response.ok) {

                                        Swal.fire('Error!', response.msg, 'error');
                                    } else if (response.ok == 1) {

                                        $("#" + id_hash).find('.process-name').text('Assessor Assigned').removeClass('bg-orange').addClass('bg-aqua');
                                        $("#" + id_hash).find('.assign-assessor-to-batch').remove();

                                        Swal.fire('Success!', response.msg, 'success');
                                    } else {

                                        Swal.fire('Warning!', response.msg, 'warning');
                                    }
                                    console.log(response);
                                })
                                .fail(function(res) {
                                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                                });
                        }, 100);

                        /* setTimeout(function () {
                            Swal.close()
                        }, 1000); */

                    }
                })

            }
        })
    });

    $(document).on('change', '#sector_code', function(e) {

        var sector_code = $(this).val();

        $.ajax({
                url: "assessment/assessing/batch/getCourseBySector",
                type: 'GET',
                dataType: "json",
                data: { "sector_code": sector_code }
            })
            .done(function(response) {
                $('#course_code').html(response);
            })
            .fail(function(res) {
                Swal.fire('Warning!', 'Oops! Unable to get course.', 'warning');
            });
    });

    $(document).on('click', '.reassign-assessor-to-batch', function(e) {

        var id_hash = $(this).closest('tr').prop('id');

        Swal.fire({
            title: 'Re-Assign Assessor to Batch?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Assign!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'We\'ll assigne assessor on this batch.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: 'assessment/assessing/batch/reAssignAssessor',
                                    type: 'GET',
                                    dataType: "json",
                                    data: { 'id_hash': id_hash },
                                })
                                .done(function(response) {
                                    if (!response.ok) {

                                        Swal.fire('Error!', response.msg, 'error');
                                    } else if (response.ok == 1) {

                                        $("#" + id_hash).find('.process-name').text('Assessor Assigned').removeClass('bg-orange').addClass('bg-aqua');
                                        $("#" + id_hash).find('.assign-assessor-to-batch').remove();

                                        Swal.fire('Success!', response.msg, 'success');
                                    } else {

                                        Swal.fire('Warning!', response.msg, 'warning');
                                    }
                                    console.log(response);
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                });
                        }, 100);

                    }
                })

            }
        })
    });

    $(document).on('click', '.mark-trainee-present', function() {

        var this_tr = $(this).closest('tr');
        var this_td = $(this).closest('td');
        var trainee_id_hash = this_tr.prop('id');

        Swal.fire({
            title: 'Warning!<br>Mark Trainee as Present.',
            text: "You will not able to revert it back.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Do it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        $.ajax({
                                url: "assessment/assessing/batch/attendance_status/" + trainee_id_hash,
                                type: 'GET',
                                dataType: "json"
                            })
                            .done(function(response) {

                                $(this_td).html(response);

                                Swal.fire('Success!', 'Trainee marked as present.!', 'success');
                            })
                            .fail(function(res) {
                                Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                            });
                    }
                })
            }
        });
    });


    $(document).on('click', '.modal-change-assessor', function(e) {

        var id_hash = $(this).closest('tr').prop('id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.change-assessor-data').html(loader);

        $.ajax({
                url: "assessment/assessing/batch/getChangeAssessorList/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.change-assessor-data').html(response);
                $('.select2').select2();
            })
            .fail(function(res) {
                $('#modal-change-assessor').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get assessor list.', 'error');
            });
    });

    $(document).on('click', '#submit-change-assessor', function(e) {

        var id_hash = $('.change-assessor-data').find('#change-assessor-id-hash').val();
        var assessor_id = $('.change-assessor-data').find('#change-assessor-assessor-id').val();

        if (assessor_id) {
            Swal.fire({
                title: 'Warning!<br>Are you sure?',
                text: "You want to change the assessor.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Do it!',
                allowEscapeKey: false,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Please wait a moment!',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();

                            $.ajax({
                                    url: "assessment/assessing/batch/changeAssessorFromBatch",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { id_hash: id_hash, assessor_id: assessor_id }
                                })
                                .done(function(response) {
                                    Swal.fire('Success!', 'Assessor has been successfully changed.!', 'success');
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Unable to change the assessor, Please try again later.', 'warning');
                                });
                        }
                    })
                }
            });
        } else {
            Swal.fire('Warning!', 'Please select Assessor.', 'warning');
        }
    });

    $(document).on('click', '.modal-change-propose-date', function(e) {

        var id_hash = $(this).closest('tr').prop('id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.change-propose-data').html(loader);

        $.ajax({
                url: "assessment/assessing/batch/getProposeDate/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.change-propose-data').html(response);
            })
            .fail(function(res) {
                $('#modal-change-propose-date').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get propose date.', 'error');
            });
    });

    $(document).on('click', '#uptd-propose-date', function(e) {

        e.preventDefault();
        var error = 0;

        $(this).closest('form').find('input').each(function() {
            if ($(this).hasClass('required')) {
                if ($(this).val() == '') {
                    $(this).removeClass('green-border');
                    $(this).addClass('red-border');
                    ++error;
                } else {
                    $(this).removeClass('red-border');
                    $(this).addClass('green-border');
                }
            }
        });

        if (error == 0) {

            var action_page = $("#propose_date_form").attr("action");

            Swal.fire({
                title: 'Warning!<br>Are you sure?',
                text: "You want to change the Assessment Date.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Do it!',
                allowEscapeKey: false,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Please wait a moment!',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();

                            $.ajax({
                                    type: "POST",
                                    dataType: "json",
                                    url: action_page,
                                    data: $("#propose_date_form").serialize(),
                                })
                                .done(function(response) {
                                    /* $('#modal-change-propose-date').modal('toggle');
                                    Swal.fire('Success!', 'Propose Date has been successfully changed.!', 'success'); */

                                    if (response == 'done') {
                                        $('#modal-change-propose-date').modal('toggle');
                                        Swal.fire('Success!', 'Propose Date has been successfully changed.!', 'success');
                                    } else {
                                        $('.change-propose-data').html(response.html);
                                        Swal.fire('Warning!', response.msg, 'warning');
                                    }
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Unable to change the propose Date, Please try again later.', 'warning');
                                });
                        }
                    })
                }
            });
        }
    });

    /*  $(document).on('click', '.export-cssvse-student-marks', function () {
 
         Swal.fire({
             title: 'Please wait a moment!',
             html: 'Collecting student data.',
             allowEscapeKey: false,
             allowOutsideClick: false,
             didOpen: () => {
                 Swal.showLoading();
             }
         });
     }); */

    $(document).on('click', '.modal-delete-assessment-batch', function(e) {

        var id_hash = $(this).closest('tr').prop('id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.assessment-batch-data').html(loader);

        $.ajax({
                url: "assessment/assessing/batch/openBatchDeleteModal/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.assessment-batch-data').html(response);
            })
            .fail(function(res) {
                $('#modal-delete-assessment-batch').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get batch data.', 'error');
            });
    });

    $(document).on('click', '#delete-assessment-batch', function(e) {

        var id_hash = $(this).closest('tr').prop('id');
        e.preventDefault();
        var error = 0;

        $(this).closest('form').find('textarea').each(function() {
            if ($(this).hasClass('required')) {
                if ($(this).val() == '') {
                    $(this).removeClass('green-border');
                    $(this).addClass('red-border');
                    ++error;
                } else {
                    $(this).removeClass('red-border');
                    $(this).addClass('green-border');
                }
            }
        });
        if (error == 0) {

            var action_page = $("#batch_delete_form").attr("action");

            Swal.fire({
                title: 'Warning!<br>Are you sure?',
                text: "You want to delete this Assessment Batch.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Do it!',
                allowEscapeKey: false,
                allowOutsideClick: false
            }).then((result) => {

                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Please wait a moment!',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();

                            $("#batch_delete_form").submit();
                            // $.ajax({
                            //         type: "POST",
                            //         dataType: "json",
                            //         url: action_page,
                            //         data: $("#batch_delete_form").serialize(),
                            //     })
                            //     .done(function(response) {


                            //         if (response == 'done') {
                            //             $('#modal-delete-assessment-batch').modal('toggle');

                            //             $("#" + id_hash).find('.process-name').text('Assessment Batch Deleted').removeClass('bg-orange').addClass('bg-red');
                            //             $("#" + id_hash).find('.modal-delete-assessment-batch').remove();

                            //             Swal.fire('Success!', 'Assessment batch successfully deleted.!', 'success');
                            //         }
                            //     })
                            //     .fail(function(res) {
                            //         Swal.fire('Warning!', 'Oops! Unable to delete the assessment Batch, Please try again later.', 'warning');
                            //     });
                        }
                    })
                }
            });
        }

    });



    // $(document).on('click', '.modal-show-remarks', function() {

    //     var id_hash = $(this).closest('tr').prop('id');
    //     var batch_code = $("#" + id_hash).find('.batch-code').val();
    //     var remarks_val = $("#" + id_hash).find('.remarks_val').val();
    //     // alert(remarks_val);
    //     $('#delete_remarks_val').html(remarks_val);
    //     $('#batch-code-val').html(batch_code);
    // });
    $(document).on('click', '.modal-show-remarks', function() {

        var id_hash = $(this).closest('tr').prop('id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.delete-remarks-data').html(loader);

        $.ajax({
                url: "assessment/assessing/delete_batch_list/showDeleteRemarksModal/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.delete-remarks-data').html(response);
            })
            .fail(function(res) {
                $('#modal-show-remarks').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get remarks data.', 'error');
            });
    });

});