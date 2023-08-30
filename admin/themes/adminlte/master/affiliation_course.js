$(document).ready(function() {

    $('.select2').select2();

    var course_name_id = $('#course_name_id').val();
    showStreemClassDiv(course_name_id);

    $(document).on('change', '#course_name_id', function() {

       var course_name_id = $(this).val();
       showStreemClassDiv(course_name_id);
    });

    function showStreemClassDiv(course_name_id){
        if(course_name_id == 1){
            $('.class-div').show();
            $('.streem-name-div').show();
        }else{
            $('.class-div').hide();
            $('.streem-name-div').hide();
        }
    }


    $(document).on('click', '.deleteAffiSubjectMaster', function(){

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
                    html: 'Removing Subject...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "master/affiliation_subject/removeSubject",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { id_hash: id_hash }
                                })
                                .done(function(response) {
                                    this_tr.remove();
                                    Swal.fire('Success!', 'Subject removed successfully.', 'success');
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

    $(document).on('click', '.deleteAffiGroupMaster', function(){

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
                    html: 'Removing Group/Trade...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "master/affiliation_group/removeGroup",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { id_hash: id_hash }
                                })
                                .done(function(response) {
                                    this_tr.remove();
                                    Swal.fire('Success!', 'Group/Trade removed successfully.', 'success');
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

    $(document).on('click', '.remove-course-master', function(){

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
                    html: 'Removing Course Master...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "master/affiliation_course/removeCourseMaster",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { id_hash: id_hash }
                                })
                                .done(function(response) {
                                    this_tr.remove();
                                    Swal.fire('Success!', 'Course Master removed successfully.', 'success');
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

    // Added by Moli on 05-09-2022

    $(document).on('click', '.affiliation-group-details-btn', function () {

        var id_hash = $(this).closest('tr').prop('id');
        // alert(id_hash);
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.affi-group-data').html(loader);
        $.ajax({
                url: "master/affiliation_group/affiliation_group_details/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(res) {
                $('.affi-group-data').html(res);
                $('.select2').select2();
            })
            .fail(function(res) {
                $('#modal-infra-item-details').modal('toggle');
                Swal.fire('Warning!', 'Oops! Unable to get Infrastructure item details, Please try later.', 'warning');
            });
        
    })

    $(document).on('click', '#update-group-btn', function(e) {
        var error = 0;

        $(this).closest('form').find('input,select').each(function() {
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

        if (error) {
            e.preventDefault();
        }
    });


    //************* developed by abhijit 03-01-23 and 04-01-23 */

    $(document).on('click', '.assign-subject-type-btn', function () {

        var id_hash = $(this).closest('tr').prop('id');
        // alert(id_hash);
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.affi-subjecttype-data').html(loader);
        $.ajax({
            url: "master/affiliation_subject/affiliation_subject_type_details/" + id_hash,
            type: 'GET',
            dataType: "json",
        })
            .done(function (res) {
                $('.affi-subjecttype-data').html(res);
                $('.select2').select2();
            })
            .fail(function (res) {
                $('#modal-infra-item-details').modal('toggle');
                Swal.fire('Warning!', 'Oops! Unable to get Subject Type details, Please try later.', 'warning');
            });

    })
    

    $(document).on('click', '#update-subject-type-btn', function (e) {
        var error = 0;

        $(this).closest('form').find('input,select').each(function () {
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

        if (error) {
            e.preventDefault();
        }
    });

   


    $(document).on('click', '.createFullSubBtn', function () {

        var id_hash = $(this).closest('tr').prop('id');
        // alert(id_hash);
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.form_create_data').html(loader);
        $.ajax({
            url: "master/affiliation_subject/open_full_subject_create_form",
            type: 'GET',
            dataType: "json",
        })
            .done(function (res) {
                $('.form_create_data').html(res);
                $('.select2').select2();
            })
            .fail(function (res) {
                $('#modal_full_subject_create_form').modal('toggle');
                Swal.fire('Warning!', 'Oops! Unable to get Subject create form, Please try later.', 'warning');
            });

    })

    $(document).on('click', '#add_full_sub_btn', function (e) {
        // alert ("hii");
        var error = 0;

        $(this).closest('form').find('input,select').each(function () {
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

        if (error) {
            e.preventDefault();
        }
    });

    



});