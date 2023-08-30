$(document).ready(function () {
    $('.select2').select2();

    $(document).on('change', '#course_id', function () {
        var course_id = $("#course_id").val();

        $("#subject_id").html('<option value="">-- Select Subject --</option>');
        $("#subject_topics_id").html('<option value="">-- Select Topic/Chapter --</option>');
        $("#question_type_marks").html('<option value="">-- Select Question Category/Type --</option>');

        Swal.fire({
            title: 'Please wait a moment!',
            html: 'We are collecting data...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                $.ajax({
                    url: "qbm/questions_qt/get_semester_subject_list/",
                    dataType: "json",
                    data: { course_id: course_id },
                })
                    .done(function (res) {
                        $("#sam_year_id").html(res.semester_html_view);
                        $("#subject_id").html(res.subject_html_view);

                        Swal.close();
                    })
                    .fail(function (res) {
                        $("#subject_topics_id").html('<option value="">-- Select Semester/Year --</option>');
                        $("#discipline_id").html('<option value="">-- Select Discipline --</option>');

                        Swal.fire('Warning!', 'Oops! No data found....', 'warning');
                    });
            }
        })
    });

    $(document).on('change', '#sam_year_id', function () {
        var course_id = $("#course_id").val();

        if (course_id == 1 || course_id == 2) {
            $("#subject_topics_id").html('<option value="">-- Select Topic/Chapter --</option>');
        }
    });

    $(document).on('change', '#subject_id', function () {

        var subject_id = $("#subject_id").val();
        var course_id = $("#course_id").val();
        var sam_year_id = null;

        if ((course_id == 1) || (course_id == 2)) {
            var sam_year_id = $("#sam_year_id").val();
        }
        var ajax_url = "qbm/questions_qt/get_topic_chapter/";

        $("#subject_topics_id").html('<option value="">-- Select Topic/Chapter --</option>');
        $("#question_type_marks").html('<option value="">-- Select Question Category/Type --</option>');

        Swal.fire({
            title: 'Please wait a moment!',
            html: 'We are collecting data...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                $.ajax({
                    url: ajax_url,
                    dataType: "json",
                    data: { subject_id: subject_id, sam_year_id: sam_year_id },
                })
                    .done(function (res) {
                        $("#subject_topics_id").html(res.html_view_topic);
                        $("#question_type_marks").html(res.html_view_QuestionTypeMark);
                        Swal.close();
                    })
                    .fail(function (res) {
                        $("#subject_topics_id").html('<option value="">-- Select Topic/Chapter --</option>');
                        $("#question_type_marks").html('<option value="">-- Select Question Category/Type --</option>');

                        Swal.fire('Warning!', 'Oops! No data found....', 'warning');
                    });
            }
        })
    });

    $(document).on('change', '#question_type_marks', function () {

        var data_marks = $("option:selected", "#question_type_marks").attr('data-marks');

        $(".per-question-marks").val(data_marks);
    });

    $(document).on('click', '.btn-next', function () {

        var data_marks = $("option:selected", "#question_type_marks").attr('data-marks');
        var total_question_marks = 0;
        var error = 0;

        $(".per-question-marks").each(function (i, e) {
            total_question_marks = parseInt($(this).val()) + parseInt(total_question_marks);
        });

        $(".question-box").find('input,textarea').each(function () {
            if ($(this).hasClass('required')) {
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid state-valid').addClass('is-invalid state-invalid');
                    $(this).removeClass('green-border');
                    $(this).addClass('red-border');
                    ++error;
                } else {
                    $(this).removeClass('red-border');
                    $(this).addClass('green-border');
                }
            }
        });

        console.log(data_marks);

        if (error == 0) {
            if (data_marks != null) {
                if (data_marks < total_question_marks) {

                    Swal.fire('Warning!', 'Oops! Question marks should not be grater than ' + data_marks, 'warning');

                } else if (data_marks == total_question_marks) {

                    $('.next-question-div').hide('slow');
                    $('.save-question-div').show('slow');
                } else {

                    var question_html = '<div class="question-box"><div class="row question-box-row">' + $(".question-box-row:first").html() + '</div></div>'

                    $('.question-box:last').after(question_html);

                    $(".per-question-marks:last").val((data_marks - total_question_marks));
                }
            } else {
                Swal.fire('Warning!', 'Oops! Please select all mandetiory fields.');
            }
        }
    });

    $(document).on('click', '.view-question-details', function () {

        var id_hash = $(this).closest('tr').prop('id');

        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.question-details-data').html(loader);

        $.ajax({
            url: "qbm/questions_qt/question_details/" + id_hash,
            type: 'GET',
            dataType: "json",
        })
            .done(function (response) {
                $('.question-details-data').html(response);
            })
            .fail(function (res) {
                $('#modal-question-details').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get question details.', 'error');
            });
    });

    $(document).on('click', '.add-multi-lang-question', function () {

        var id_hash = $(this).closest('tr').prop('id');

        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.question-details-data').html(loader);

        $.ajax({
            url: "qbm/questions_qt/addMultiLangQuestion/" + id_hash,
            type: 'GET',
            dataType: "json",
        })
            .done(function (response) {
                $('.question-details-data').html(response);
            })
            .fail(function (res) {
                $('#modal-question-details').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get question details.', 'error');
            });
    });

    $(document).on('click', '.approve-question', function () {
        var this_tr = $(this).closest('tr');
        var id_hash = $(this).closest('tr').prop('id');

        Swal.fire({
            title: 'Are you sure? Approved Question from List.',
            //text: "You won't be able to revert this.!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approved it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Approving Question...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        $.ajax({
                            url: "qbm/questions_qt/approve_question/" + id_hash,
                            dataType: "json",
                        })
                            .done(function (res) {
                                this_tr.remove();
                                Swal.fire('Success!', 'Question has been successfully Approved.', 'success');
                            })
                            .fail(function (res) {
                                Swal.fire('Warning!', 'Oops! Unable to approve question.', 'warning');
                            });
                    }
                })
            }
        });
    });

    $(document).on('click', '#submit-multi-lang-question', function (e) {
        var error = 0;
        
        $(this).closest('form').find('input,textarea,select').each(function () {
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

    $(document).on('change', '#qb_list_semester_id', function (e) {
        var semester_id = $(this).val();
        var subject_id = $("#subject_id_hash").val();

        Swal.fire({
            title: 'Please wait a moment!',
            html: 'Collection data...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();

                $.ajax({
                    url: "qbm/questions_qt/getQuestionListBySemSubj/",
                    dataType: "json",
                    data: { semester_id: semester_id, subject_id: subject_id }
                })
                    .done(function (res) {
                        $("#tBody-questionList").html(res.questionList);
                        $("#forwardQuestionDiv").html(res.forwardQuestionBtn);
                        $("#questionCategoryList").html(res.questionCategoryList);

                        Swal.close();
                    })
                    .fail(function (res) {
                        Swal.fire('Warning!', 'Oops! Unable to get data.', 'warning');
                    });
            }
        })
    });

    $(document).on('click', '#forwardQuestionBtn', function (e) {
        var semester_id = $("#qb_list_semester_id").val();
        var subject_id = $("#subject_id_hash").val();

        Swal.fire({
            title: 'Are you sure? Approve All Questions .',
            text: "You won't be able to see this list again.!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Collection data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        $.ajax({
                            url: "qbm/questions_qt/getQuestionListBySemSubj/",
                            dataType: "json",
                            data: { semester_id: semester_id, subject_id: subject_id, forwardQuestionBtnStatus: 1 }
                        })
                            .done(function (res) {
                                $("#tBody-questionList").html(res.questionList);
                                $("#forwardQuestionDiv").html(res.forwardQuestionBtn);
                                $("#questionCategoryList").html(res.questionCategoryList);

                                Swal.fire('Success!', 'Questions has been successfully Approved.', 'success');
                            })
                            .fail(function (res) {
                                Swal.fire('Warning!', 'Oops! Unable to save question set...', 'warning');
                            });
                    }
                });
            }
        });
    });
	
	
	//Added By MOli
    
    $(document).on('click', '.download-pdf-btn', function () {
        // alert ("hii");
        var sub_id_hash = $(this).closest('tr').prop('id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.question-sem-data').html(loader);

        $.ajax({
            url: "qbm/questions_qt/getSemesterList/" + sub_id_hash,
            type: 'GET',
            dataType: "json",
        })
            .done(function (response) {
                $('.question-sem-data').html(response);
            })
            .fail(function (res) {
                $('#modal-download-pdf').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get semister list.', 'error');
            });

    });

    $(document).on('click', '#sem_pdf_dwn_btn', function (e) {
        var error = 0;

        $(this).closest('form').find('input,textarea,select').each(function () {
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
