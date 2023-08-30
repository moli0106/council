$(document).ready(function () {

    $('.select2').select2();

    $(".date-picker").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });

    $(document).on('change', '#sector_code', function (e) {

        var sector_code = $(this).val();

        $.ajax({
            url: "assessment/awarding/batch/getCourseBySector",
            type: 'GET',
            dataType: "json",
            data: { "sector_code": sector_code }
        })
            .done(function (response) {
                $('#course_code').html(response);
            })
            .fail(function (res) {
                Swal.fire('Warning!', 'Oops! Unable to get course.', 'warning');
            });
    });

    $(document).on('click', '.accept-marks, .decline-marks', function (e) {

        var id_hash = $(this).attr('data-id');

        if ($(this).hasClass('accept-marks')) {
            var marksStatus = 1;
        } else {
            var marksStatus = 2;
        }

        $.ajax({
            url: "assessment/awarding/batch/acceptdeclinemarks/" + id_hash,
            type: 'GET',
            dataType: "json",
            data: { "marksStatus": marksStatus },
        })
            .done(function (response) {
                console.log(response);
                if (response.status == 1) {

                    $('.trainee-marks-data').html(response.msg);
                } else {

                    $('#modal-trainee-marks').modal('toggle');
                    Swal.fire('Error!', response.msg, 'error');
                }
            })
            .fail(function (res) {
                $('#modal-trainee-marks').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get data.', 'error');
            });
    });

    /* $(document).on('submit', '#accept-decline-marks-form', function (event) {
        event.preventDefault();
        var formData = $("#accept-decline-marks-form").serialize();

        $.ajax({
            url: $("#accept-decline-marks-form").prop('action') + "/" + $('.accept-marks').attr('data-id'),
            type: 'POST',
            dataType: "json",
            data: formData,
        })
            .done(function (response) {
                console.log(response);
                if (response.status == 1) {

                    $('.trainee-marks-data').html(response.msg);

                    location.reload();
                } else {

                    $('#modal-trainee-marks').modal('toggle');
                    Swal.fire('Error!', response.msg, 'error');
                }
            })
            .fail(function (res) {
                $('#modal-trainee-marks').modal('toggle');
                Swal.fire('Error!', 'Oops! Something went wrong.js', 'error');
            });
    }); */

    $(document).on('submit', '#accept-decline-marks-form', function (event) {
        event.preventDefault();
        var formData = $("#accept-decline-marks-form").serialize();

        Swal.fire({
            title: 'Please wait a moment!',
            html: 'We\'ll updating the information.',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();

                $.ajax({
                    url: $("#accept-decline-marks-form").prop('action') + "/" + $('.accept-marks').attr('data-id'),
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                })
                    .done(function (response) {
                        console.log(response);
                        if (response.status == 1) {

                            $('.trainee-marks-data').html(response.msg);

                            location.reload();
                        } else {

                            $('#modal-trainee-marks').modal('toggle');
                            Swal.fire('Error!', response.msg, 'error');
                        }
                    })
                    .fail(function (res) {
                        $('#modal-trainee-marks').modal('toggle');
                        Swal.fire('Error!', 'Oops! Something went wrong.js', 'error');
                    });
            }
        });
    });

});