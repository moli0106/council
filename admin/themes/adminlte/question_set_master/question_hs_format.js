$(document).ready(function () {
    $('.select2').select2();

    $("#month_and_year").datepicker({
        format: 'mm/yyyy',
        autoclose: true,
        viewMode: "months",
        minViewMode: "months"
    });

    $(document).on('change', '#subject_id', function () {
        var subject_id = $(this).val();
        var sam_year_id = $("#sam_year_id").val();

        // var subName = $('option:selected', this).attr('data-subName');
        // $("#subject_name").val(subName);

        Swal.fire({
            title: 'Please wait a moment!',
            html: 'We are collecting data...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                $.ajax({
                    url: "question_set_master/question_hs_format/getQuestionTypeMarks/",
                    dataType: "json",
                    data: { subject_id: subject_id,sam_year_id: sam_year_id },
                })
                    .done(function (res) {
                        $(".question-category-type").html(res);
                        Swal.close();
                    })
                    .fail(function (res) {
                        Swal.fire('Warning!', 'Oops! No data found....', 'warning');
                        $('.question-category-type').val('');
                        //$(".question-category-type").html('<option value="">Select Question Category/Type</option>');
                    });
            }
        });
    });





    $(document).on('change', '#course_id', function () {
        var course_id = $("#course_id").val();
        if ((course_id != '')) {
            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We are collecting data...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: "question_set_master/question_hs_format/getSubject/",
                        dataType: "json",
                        data: { course_id: course_id },
                    })
                        .done(function (res) {
                            $("#subject_id").html(res);
                            Swal.close();
                        })
                        .fail(function (res) {
                            Swal.fire('Warning!', 'Oops! No data found....', 'warning');
                            $("#subject_id").html('<option value="">Select Question Code</option>');
                        });
                }
            });
        }
    });

    $(document).on('change', '#course_id', function () {
        var course_id = $("#course_id").val();

        Swal.fire({
            title: 'Please wait a moment!',
            html: 'We are collecting data...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                $.ajax({
                    url: "question_set_master/question_hs_format/getSemesterAndDiscipline/",
                    dataType: "json",
                    data: { course_id: course_id },
                })
                    .done(function (res) {
                        $("#sam_year_id").html(res.semester_html_view);
                        //$("#discipline_id").html(res.discipline_html_view);

                        Swal.close();
                    })
                    .fail(function (res) {
                        $("#sam_year_id").html('<option value="">Select Semester/Year</option>');
                        //$("#discipline_id").html('<option value=""Select Discipline</option>');

                        Swal.fire('Warning!', 'Oops! No data found....', 'warning');
                    });
            }
        })
    });

    $("#question_format_form").submit(function (e) {
        var error = 0;

        $("#question_format_form").find('input,select').each(function () {
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
        } else {
            if (!marksValidation()) {
                e.preventDefault();
            }
        }
    });

    function marksValidation() {

        var sum_of_marks = error = 0;
        var full_marks = parseInt($('option:selected', "#full_marks_id").text());

        if (full_marks) {

            var questions_to_be_attempt = [];
            var questions_to_be_set = [];
            var marks_of_each_questions = [];

            $("#question_format_form").find('.no-of-questions-to-be-attempt').each(function () {
                questions_to_be_attempt.push(parseInt($('option:selected', this).text()));
            });
            $("#question_format_form").find('.no-of-questions-to-be-set').each(function () {
                questions_to_be_set.push(parseInt($('option:selected', this).text()));
            });
            $("#question_format_form").find('.marks-of-each-questions').each(function () {
                marks_of_each_questions.push(parseInt($('option:selected', this).text()));
            });

            for (var i = 0; i < (questions_to_be_attempt.length); i++) {
                if (questions_to_be_attempt[i] && questions_to_be_set[i] && marks_of_each_questions[i]) {
                    if (questions_to_be_attempt[i] > questions_to_be_set[i]) {
                        ++error;
                        Swal.fire('Warning!', 'No of Questions to be Attempt should not be greater than No of Questions to be Set....', 'warning');
                        break;
                    } else {
                        sum_of_marks += (questions_to_be_attempt[i] * marks_of_each_questions[i]);
                    }
                } else {
                    ++error;
                    Swal.fire('Warning!', 'Marks did not matched, Please check....', 'warning');
                    break;
                }
            }

            if (error == 0) {
                if (full_marks != sum_of_marks) {
                    ++error;
                    Swal.fire('Warning!', 'Marks did not matched, Please check....', 'warning');
                }
            }
        } else {
            ++error;
            Swal.fire('Warning!', 'Please select Full Marks....', 'warning');
        }

        if (error > 0) {
            return false;
        } else {
            return true;
        }
    }

    $(document).on('click', '.assignQuestion', function (e) {

        var thisBtn = $(this);
        var id = $(this).attr("data-id");

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to assign question!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "question_set_master/question_hs_format/add_question/" + id,
                    dataType: "json",
                })
                    .done(function (res) {
                        console.log(res);
                        if (res == 1) {
                            thisBtn.remove();
                            $('#show_eligible_asseessement').show('slow');
                            Swal.fire('Assigned!', 'Question successfully assigned.', 'success');
                        }
                        else if (res == 2) {
                            Swal.fire('Oops!', 'There is not enough question in subject.', 'error');
                        }
                        else {
                            Swal.fire('Error!', 'Oops! Something went wrong, please try again', 'error');
                        }
                    })
                    .fail(function (res) {
                        Swal.fire('Error!', 'Oops! Something went wrong, please try again', 'error');
                    });

            }
        });
    })




    //Added by waseem on 03-03-2022

    $(document).on('keyup', '#numberOfQuestionType', function() {

        var numberOfQuestionType = parseInt($(this).val());
        //var course_id = $("#course_id").val();
        var sam_year_id = $("#sam_year_id").val();
        var subject_id = $("#subject_id").val();
        // alert(course_id)
        // alert(sam_year_id)
        // alert(subject_id)
        Swal.fire({
            title: 'Please wait a moment!',
            html: 'We\'ll collecting the data.',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();

                setTimeout(function() {

                    $.ajax({
                            url: "question_set_master/question_hs_format/getQuestionTypeBlock/",
                            type: 'GET',
                            dataType: "json",
                            data: { numberOfQuestionType: numberOfQuestionType, subject_id : subject_id, sam_year_id : sam_year_id},
                        })
                        .done(function(res) {
                            $('.question-set-block').html(res);
                            $('.select2').select2();
                            Swal.close();
                        })
                        .fail(function(res) {
                            $('.question-set-block').html('');
                            Swal.fire('Warning!', 'Oops! Not able to get Question set data.', 'warning');
                        });

                }, 100);
            }
        });

    });



    $(document).on('change', '#subject_id', function () {
        var subject_id = $("#subject_id").val();
        if ((subject_id != '')) {
            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We are collecting data...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: "question_set_master/question_hs_format/getQuestionCode/",
                        dataType: "json",
                        data: { subject_id: subject_id },
                    })
                        .done(function (res) {
                            $('#question_code').val(res);
                            //$("#question_code").html(res);
                            Swal.close();
                        })
                        .fail(function (res) {
                            Swal.fire('Warning!', 'Oops! No data found11....', 'warning');
                            $('#question_code').val('');
                            //$("#questioquestion_coden_code_id").html('<option value="">Select Question Code</option>');
                        });
                }
            });
        }
    });

});