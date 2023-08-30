$(document).ready(function() {

    $('.select2').select2();

    var aplicable_no = $('input[name=aplicable_no]:checked').val();
    showQuestionBlock(aplicable_no);

    $(document).on('click', '.present-aplicable', function() {

        var aplicable_no = $('input[name=aplicable_no]:checked').val();
        showQuestionBlock(aplicable_no);

    });

    function showQuestionBlock(aplicable_no) {
        if (aplicable_no == 1) {
            $('.lab-size-div').show();
        } else {
            $('.lab-size-div').hide();
        }
    }

    $(document).on('click', '.available-equipment', function() {

        var equipment_type = $('input[name=equipment]:checked').val();
        // alert(equipment_type);
        if (equipment_type == 1) {
            $('.sufficient-course-div').show();
        } else {
            $('.sufficient-course-div').hide();
        }
    });



    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        var log = numFiles > 1 ? numFiles + ' files selected' : label;
        $(this).parents('.input-group').find(':text').val(log);
    });





    var course_id = $('#course_id').val();
    var paper_lab_id = $('#paper_lab_id').val();
    // alert(paper_lab_id);
    getInfrastructureByCourseId(course_id, paper_lab_id);

    $('#course_id').on('change', function() {
        var courseId = $(this).val();
        var paper_lab_id = $('#paper_lab_id').val();
        getInfrastructureByCourseId(courseId, paper_lab_id);
    });

    function getInfrastructureByCourseId(course_id, paper_lab_id) {

        $.ajax({
                url: 'vtc_infrastructure/paper_laboratory/getInfrastructureItemList/' + course_id,
                data: { 'paper_lab_id': paper_lab_id },
                dataType: "json",
            })
            .done(function(response) {
                $('#item_id').html(response);
            })
    }

    $(document).on('click', '#secondFinalSubmitBtn', function() {

        Swal.fire({
            title: 'Are you sure? Final submit your data.',
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
                                    url: "vtc_infrastructure/final_submit/second_final_submit",
                                    type: 'GET',
                                    dataType: "json",
                                })
                                .done(function(response) {
                                    Swal.fire('Success!', 'Final submit successfully.', 'success');
                                    $('#secondFinalSubmitBtn').remove();
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
})