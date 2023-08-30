$(document).ready(function () {

    $(".calender_date").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $(document).on('click', '#create-batch', function () {
        var error = 0;
        $('#create-batch-form').find('input').each(function (i, e) {
            if (!$(this).val()) { ++error; }
        });

        if ($('#confirmation').length) {
            if (!$('#confirmation').is(':checked')) {
                ++error;
            }
        }

        if (error) {
            Swal.fire('Warning!', 'Oops! Please enter all data and date.', 'warning');
        } else {
            Swal.fire({
                title: 'Warning!<br>Are you sure?',
                text: "You want to creat batch.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Create!',
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
                            $('#create-batch-form').submit();
                        }
                    });
                }
            });
        }
    });

    $(document).on('click', '.get-batch-puch-details', function (e) {

        var id_hash = $(this).closest('tr').prop('id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.assessment-data').html(loader);

        $.ajax({
            url: "cssvsebatch/batch/getPushBatchDetails/" + id_hash,
            type: 'GET',
            dataType: "json",
        })
            .done(function (response) {
                $('.assessment-data').html(response);

                var date = new Date();
                date.setDate(date.getDate());
                $(".prefered-assessment-date-1").datepicker({
                    startDate: date,
                    todayBtn: 1,
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                }).on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                    $('.prefered-assessment-date-2').datepicker('setStartDate', minDate);
                });

                $(".prefered-assessment-date-2").datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                }).on('changeDate', function (selected) {
                    var maxDate = new Date(selected.date.valueOf());
                    $('.prefered-assessment-date-1').datepicker('setEndDate', maxDate);
                });

            })
            .fail(function (res) {
                $('#modal-batch-details').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get batch details.', 'error');
            });

    });

    $(document).on('click', '#btn-batch-push', function (e) {
        Swal.fire({
            title: 'Warning!<br>Are you sure?',
            text: "You want to push batch to council.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Push!',
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
                        $('#form-batch-push').submit();
                    }
                });
            }
        });
    });

    $(document).on('click', '#add-internal-marks-btn', function (e) {
        var error = 0;

        $('#tbody').find('input').each(function () {
            if ($(this).hasClass('required')) {
                if ($(this).val() == '') {
                    $(this).removeClass('green-border');
                    $(this).addClass('red-border');
                    ++error;
                } else if ($(this).val() > 20) {
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
            Swal.fire({
                title: 'Warning!<br>Are you sure?',
                text: "You won't be able to update the student marks.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Save it!',
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
                            $('#internal-marks-form').submit();
                        }
                    });
                }
            });
        }
    });
});