$(document).ready(function() {
    // alert("hiii");

    $(document).on('change', '#academic_year', function() {
        
        // alert("hiii");
        $('#vtc_search_form').submit();
        
    });

    var selected_year = $('#selected_year').val();
    // alert(selected_year);

    

        $('#editable-sample').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 50,
            "ajax": {
            "url": "affiliation/vtc/get_list",
            "dataType": "json",
            "type": "GET",
            "data": {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'selected_year':selected_year
            }
            },
    
            
    
            "columns": [{
                "data": "sl_no"
            },
            {
                "data": "vtc_code"
            },
            {
                "data": "vtc_name"
            },
            {
                "data": "email"
            },
            {
                "data": "academic_year"
            },
            
            {
                "data": "affiliated"
            },
            {
                "data": "active"
            },
            {
                "data": "part1_submit_status"
            },
            {
                "data": "submited_status"
            },
            {
                "data": "action"
            }
            ],
            // "preDrawCallback": function(settings) {
            //   $('#chk_all').prop('checked', false);
            // }
    
        });
    
    
    $('.select2').select2();

    /* $('#hs_equivalent_discipline').select2({
        maximumSelectionLength: 2
    }); */

    /* $('#stc_discipline').select2({
        maximumSelectionLength: 3
    }); */

    /* $('#coursesSelectionHsVoc, #coursesSelectionStc').select2({
        maximumSelectionLength: 3
    }); */

    $(document).on('change', '#vtc_type_id', function() {
        if ($(this).val() == 'Other') {
            $('.other-type-div').show();
        } else {
            $('.other-type-div').hide();
        }
    });

    $(document).on('change', '#medium_of_instruction', function() {
        if ($(this).val() == 'Other') {
            $('.other-medium-div').show();
        } else {
            $('.other-medium-div').hide();
        }
    });

    $('input:radio[name="hs_equivalent"]').change(function() {
        if ($(this).val() == 1) {
            $('.hse-div').show();
        } else {
            $('.hse-div').hide();
        }
    });

    $(document).on('change', '#district', function() {
        var district = $(this).val();

        $.ajax({
                url: "affiliation/details/getSubDivision/" + district,
                dataType: "JSON",
            })
            .done(function(res) {
                $('#subDivision').html(res.subDivisionHtml);
                $('#nodal_id_fk').html(res.nodalOfficerHtml);
                $('#municipality').html('<option value="" hidden="true">Select Municipality</option><option value="" disabled="true">Select Sub Division first...</option>');
            })
            .fail(function() {
                console.log('error');
            });
    });

    $(document).on('change', '#subDivision', function() {
        var subDivision = $(this).val();

        $.ajax({
                url: "affiliation/details/getMunicipality/" + subDivision,
                dataType: "JSON",
            })
            .done(function(res) {
                $('#municipality').html(res);
            })
            .fail(function() {
                console.log('error');
            });
    })

    $(document).on('change', '#hs_equivalent_discipline', function() {

        var discipline = $(this).val();

        Swal.fire({
            title: 'Please wait a moment!',
            html: 'We\'ll collecting the data.',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();

                setTimeout(function() {

                    $.ajax({
                            url: "affiliation/courses/getHsEquivalentDisciplineCourse",
                            type: 'GET',
                            dataType: "json",
                            data: { discipline: discipline },
                        })
                        .done(function(res) {
                            $('#coursesSelectionHsVoc').html(res);
                            Swal.close()
                        })
                        .fail(function(res) {
                            Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                        });
                }, 100);
            }
        });

    });

    $(document).on('change', '#stc_discipline', function() {

        var discipline = $(this).val();

        Swal.fire({
            title: 'Please wait a moment!',
            html: 'We\'ll collecting the data.',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();

                setTimeout(function() {

                    $.ajax({
                            url: "affiliation/courses/getNqrNsqfDisciplineCourse",
                            type: 'GET',
                            dataType: "json",
                            data: { discipline: discipline },
                        })
                        .done(function(res) {
                            $('#coursesSelectionStc').html(res);
                            Swal.close()
                        })
                        .fail(function(res) {
                            Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                        });
                }, 100);
            }
        });

    });

    $(document).on('click', '.teacher-type-radio', function() {

        var tType = $('input[name=teacher_type]:checked').val();
        var vtc_id = $('#vtc_id').val();

        if (tType == 1 || tType == 3) {

            $('.course-id-div').show();
            $('.course-name-div').hide();

            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {

                        $.ajax({
                                url: "affiliation/teachers/getVtcCourseForTeacher",
                                type: 'GET',
                                dataType: "json",
                                data: { tType: tType, vtc_id: vtc_id },
                            })
                            .done(function(response) {
                                if (response == 0) {
                                    $('#course_id').html('<option value="" hidden="true">Select Course</option><option value="" disabled="true">No Course found.</option>');
                                    Swal.fire('Warning!', 'No Course found.', 'warning');
                                } else {
                                    $('#course_id').html(response);

                                    Swal.close()
                                }
                            })
                            .fail(function(res) {
                                Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                            });

                    }, 100);
                }

            });

        } else if (tType == 2) {

            $('.course-id-div').hide();
            $('.course-name-div').show();

        } else {
            Swal.fire('Warning!', 'Oops! Unable to get the data.', 'warning');
        }
    });

    $(document).on('change', '#designation', function() {
        if ($(this).val() == 'Other') {
            $('.other-designation-div').show();
        } else {
            $('.other-designation-div').hide();
        }
    });

    $(document).on('change', '#highest_qualification', function() {
        if ($(this).val() == 'Other') {
            $('.other-qualification-div').show();
        } else {
            $('.other-qualification-div').hide();
        }
    });

    $(document).on('change', '#engagement_type', function() {
        if ($(this).val() == 'Other') {
            $('.other-engagement-div').show();
        } else {
            $('.other-engagement-div').hide();
        }
    });

    $(document).on('click', '#finalSubmitBtn', function() {
        Swal.fire({
            title: 'Are you sure to confirm Part I and move to Part II?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Saving the data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "affiliation/finalsubmit/submit_final_data",
                                    type: 'GET',
                                    dataType: "json",
                                })
                                .done(function(response) {
                                    Swal.fire('Success!', 'Final submit successfully.', 'success');
                                    $('#finalSubmitBtn').remove();
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Unable to save data.', 'warning');
                                });
                        }, 100);
                    }
                })
            }
        });
    });

    $(document).on('click', '#course-selection-btn', function() {
        Swal.fire({
            title: 'Warning!<br>Once submitted, You can not make any change in course selection.',
            text: "Please verify Group/Trade code and then submit.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Saving the data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $('#course-selection-form').submit();
                        }, 100);
                    }
                })
            }
        });
    });

    $(document).on('click', '#resetCourseSelection', function() {
        Swal.fire({
            title: 'Warning!<br>Once Reset, Your Course, Teacher & Student data will be erased.',
            text: "You will not able to revert it back.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Erase it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Erasing the data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "affiliation/courses/resetCourseTeacherStudent",
                                    type: 'GET',
                                    dataType: "json",
                                })
                                .done(function(response) {
                                    location.reload();
                                    // console.log(response);
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                });
                        }, 100);
                    }
                })
            }
        });
    });

    $(document).on('click', '#btnVtcAction', function() {
        var id_hash = $(this).attr('data-id');
        var this_tr = $(this).closest('tr');

        Swal.fire({
            title: 'Confirm!<br>Once Reset, VTC Course, Teacher & Student data will be erased.',
            text: "You will not able to revert it back.",
            icon: 'question',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#00a65a',
            denyButtonColor: '#f39c12',
            confirmButtonText: 'Reset Course, Teacher & Student Details',
            denyButtonText: 'Unblocking Final Submit',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            },
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Erasing the data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "affiliation/vtc/resetVtcData",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { id_hash: id_hash, action: 1 }
                                })
                                .done(function(response) {
                                    this_tr.remove();
                                    Swal.fire('Success!', 'VTC reset successfully.', 'success');
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                });
                        }, 100);
                    }
                });
            } else if (result.isDenied) {
                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Unblocking Final Submit...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "affiliation/vtc/unblockingVtcData",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { id_hash: id_hash, action: 2 }
                                })
                                .done(function(response) {
                                    this_tr.remove();
                                    Swal.fire('Success!', 'VTC unblocked successfully.', 'success');
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                });
                        }, 100);
                    }
                });
            }
        });
    });

    $(document).on('click', '.deletteVtcTeacher', function() {

        var this_tr = $(this).closest('tr');
        var id_hash = this_tr.prop('id');

        Swal.fire({
            title: 'Warning!<br>Are You Sure? Delete it.',
            text: "You will not able to revert it back.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#00a65a',
            confirmButtonText: 'Yes! Delete it.',
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Removing Teacher...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "affiliation/teachers/removeTeacher",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { id_hash: id_hash }
                                })
                                .done(function(response) {
                                    this_tr.remove();
                                    Swal.fire('Success!', 'Teacher removed successfully.', 'success');
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                });
                        }, 100);
                    }
                });
            }
        });
    });

    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready(function() {
        $(':file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });
    });

    $(document).on('click', '#updateVtcEmailBtn', function() {
        Swal.fire({
            title: 'Are you sure? Update VTC Email.',
            text: "Login credentials will be update and send to VTC Email.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Updating login credentials...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        $('form#updateVtcEmail').submit();
                    }
                })
            }
        });
    });


    //Added by Waseem

    $(document).on('click', '#send_password', function() {
        var vtc_id_hash = $(this).attr('rel');
        //var path = <?php echo $this->config->item('theme_uri'); ?>
        //alert(qcm_id_hash);
        if (vtc_id_hash != "") {
            var url = 'affiliation/vtc/password_mail/' + vtc_id_hash;
            $.ajax({
                url: url,
                dataType: "text",
                success: function(result) {
                    var check_result = JSON.parse(result);
                    if (check_result.status == 'true') {
                        alert('MAIL SENT');
                    } else {
                        alert(check_result.status);
                    }
                },
                beforeSend: function() {
                    $('#send_password_div').hide();
                    $('#send_password').attr('src', 'themes/adminlte/assets/image/loading_bar.gif');
                }
            });

        }
    });

    // Added by Moli on 27-05-2022

    $(document).on('click', '.approve-reject-modal', function() {


        // var id_hash = $(this).closest('tr').prop('id');
        var id_hash = $(this).attr('data-id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.approve-reject-data').html(loader);

        $.ajax({
                url: "affiliation/vtc/showApproveRejectModal/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.approve-reject-data').html(response);
            })
            .fail(function(res) {
                $('#approve-reject-modal').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get vtc data.', 'error');
            });


    });
    $(document).on('click', '.reject-btn', function(e) {

        var id_hash = $(this).closest('tr').prop('id');
        e.preventDefault();
        var error = 0;
        var remarksVal = $('textarea#remarks').val();
        $('#status').val(0);
        if (remarksVal != '') {

            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to reject this VTC.',
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
                    $("#approve_reject_form").submit();

                }
            })
        } else {
            Swal.fire('Remarks field is the required');
        }

    });

    $(document).on('click', '.approve-btn', function(e) {

        var id_hash = $(this).closest('tr').prop('id');
        e.preventDefault();
        var error = 0;

        $('#status').val(1);

        Swal.fire({
            title: 'Warning!<br>Are you sure? You want to approve this VTC.',
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
                $("#approve_reject_form").submit();

            }
        })

    })

    $(document).on('click', '.modal-reject-note', function() {


        // var id_hash = $(this).closest('tr').prop('id');
        var id_hash = $(this).attr('data-id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.reject-note-data').html(loader);

        $.ajax({
                url: "affiliation/vtc/getRejectNote/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.reject-note-data').html(response);
            })
            .fail(function(res) {
                $('#modal-reject-note').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get vtc data.', 'error');
            });


    });
    // Added by Moli on 27-05-2022


    

    $("#teacher-datepicker").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });

   

    // Added by Moli on 15-06-2022

    $(document).on('click', '.modal-teacher-subject-map', function(e) {

        var id_hash = $(this).closest('tr').prop('id');
        // alert($(this).attr("data-id"));
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.teacher-subject-data').html(loader);

        $.ajax({
                url: "affiliation/teachers/openTeacherSubjectModal/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.teacher-subject-data').html(response);
            })
            .fail(function(res) {
                $('#modal-teacher-subject-map').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get teacher data.', 'error');
            });
    });

    $(document).on('change', '#subject_group_name', function(){
        var subject_group_id = $(this).val();

        // alert(subject_group_id);

        if(subject_group_id !=''){

            $.ajax({
                url: "affiliation/teachers/checkSubjectTeacherExist/",
                type: 'GET',
                dataType: "json",
                data: {subject_group_id : subject_group_id}
            })
            .done(function(response) {

                if (response != 'done') {
                    Swal.fire('Warning!', response.msg, 'warning');
                }
            })
            .fail(function(res) {
                Swal.fire('Error!', 'Oops! Unable to get subject data.', 'error');
            });
        }
    });

    $(document).on('click', '#assign-subject-teacher', function(e){

        e.preventDefault();
        var error = 0;

        var subject_id = $('#subject_name').val();

        if(subject_id !=''){

            var action_page = $("#assign_teacher").attr("action");

            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to assign this Subject.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                allowEscapeKey: false,
                allowOutsideClick: false
            }).then((result) => {

                if (result.isConfirmed) {
                    // $("#assign_teacher").submit();
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: action_page,
                        data: $("#assign_teacher").serialize(),
                    })
                    .done(function(response) {
                        
                        $('#modal-teacher-subject-map').modal('toggle');
                        Swal.fire('Success!', 'Subject/Group has been successfully assigned.!', 'success'); 

                       
                    })
                    .fail(function(res) {
                        Swal.fire('Warning!', 'Oops! Unable to assigned Subject/Group, Please try again later.', 'warning');
                    });

                }
            })

        }else{

            Swal.fire('Subject field is the required');
        }

    });

    // 20-07-2022

    $(document).on('click', '.move_teacher_data', function(e) {

        
       
           
                Swal.fire({
                    title: 'Warning!<br>Are you sure? You want to fetch previous Teacher Data',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    allowEscapeKey: false,
                    allowOutsideClick: false
                }).then((result) => {

                    if (result.isConfirmed) {

                        Swal.fire({
                            title: 'Please wait a moment!',
                            html: 'Saving the data...',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
        
                                setTimeout(function() {
                                    $.ajax({
                                        url: "affiliation/teachers/moveTeacherToNextYear",
                                        
                                        type: 'GET',
                                        dataType: "json",
                                    })
                                    .done(function(response) {
                                        Swal.fire('Success', 'Teacher Successfully moved for next year');
                                        location.reload();
                                    })
                                    .fail(function(res) {
                                        
                                        Swal.fire('Error!', 'Oops! Unable to moved for next year.', 'error');
                                    });
                                }, 1000);
                            }
                        })

                        

                    }
                })

        
    });

    
    
   
    // 20-07-2022

    

});