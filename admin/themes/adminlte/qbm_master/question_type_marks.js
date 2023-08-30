$(document).ready(function () {
    $('.select2').select2();

    $(document).on('change', '#course_id', function () {
        var course_id = $(this).val();

        $.ajax({
            url: "qbm_master/question_type_mark/getSemesterAndSubjectList",
            dataType: "json",
            data: { course_id: course_id }
        })
            .done(function (res) {
                $('#sem_year_id').html(res.semester_html_view);
                $('#subject_id').html(res.subject_html_view);
            })
            .fail(function (res) {
                Swal.fire('Warning!', 'Oops! No data found....', 'warning');
            });
    });

});