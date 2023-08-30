$(document).ready(function () {

    $(document).on('click', '.get-batch-details', function (e) {

        var map_id_hash = $(this).closest('tr').prop('id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.assessment-data').html(loader);

        $.ajax({
            url: "assessment/assessor/batch/details/" + map_id_hash,
            type: 'GET',
            dataType: "json",
        })
            .done(function (response) {
                $('.assessment-data').html(response);
            })
            .fail(function (res) {
                $('#modal-batch-details').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get batch details.', 'error');
            });
    });

    $(document).on('click', '.batch-confirmation', function (e) {

        var map_id_hash = $(this).closest('tr').prop('id');

        $.ajax({
            url: "assessment/assessor/batch/batch_approve_inability/" + map_id_hash,
            type: 'GET',
            dataType: "json",
        })
            .done(function (response) {
                $('.modal-body-batch-confirmation').html(response);
            })
            .fail(function (res) {
                Swal.fire('Error!', 'Oops! Unable to get batch details.', 'error');
            });

    });

    $(document).on('click', '#modal-batch-confirmation-close', function (e) {

        location.reload();

    });

    function traineeExamStatus(tr, theory, practical) {

        var status = 0, total = theory + practical;

        tr.find('.inputTotalMarks').val(total);

        var theoryMarks = $('#theoryMarks').val(),
            practicalMarks = $('#practicalMarks').val(),
            theoryPercentage = $('#theoryPercentage').val(),
            practicalPercentage = $('#practicalPercentage').val();

        theoryResult = (100 * theory) / theoryMarks;
        practicalResult = (100 * practical) / practicalMarks;

        if ((theoryResult >= theoryPercentage) && (practicalResult >= practicalPercentage)) {

            tr.find(".traineeStatus").html('<span class="badge bg-green">Pass</span>');
        } else {

            tr.find(".traineeStatus").html('<span class="badge bg-red">Fail</span>');
        }
    }


    $(document).on('keyup', '.inputTheoryMarks, .inputPracticalMarks, .inputVivaMarks', function (event) {

        var tr = $(this).closest('tr'),

            theory = parseFloat(tr.find('.inputTheoryMarks').val()) || 0;
        practical = parseFloat(tr.find('.inputPracticalMarks').val()) || 0;
        viva = parseFloat(tr.find('.inputVivaMarks').val()) || 0;

        var total = theory + practical + viva;
        tr.find('.inputTotalMarks').val(total);

    });

    $(document).on('click', '#final-submit-trainee-marks', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Submit Trainee Marks?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#traineeMarksUpload').append("<input type='hidden' name='saveUploadMarks' value='2'/>");
                $("#traineeMarksUpload").submit();
            }
        });
    });

    $(document).on('submit', '#batch-confirmation-form', function (event) {
        event.preventDefault();
        $('.submit-button').html();

        // var map_id_hash = $(this).closest('tr').prop('id');

        Swal.fire({
            title: 'Update batch status?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $('.submit-button').slideUp();

                $.ajax({
                    url: "assessment/assessor/batch/batchConfirmation",
                    type: 'GET',
                    dataType: "json",
                    data: $("#batch-confirmation-form").serialize()
                })
                    .done(function (response) {

                        if (response == 'status') {
                            $('.submit-button').slideDown();
                            Swal.fire('Warning!', 'Please select status.', 'warning');
                        } else if (response == 'notes') {
                            $('.submit-button').slideDown();
                            Swal.fire('Warning!', 'Please enter some text in comment.', 'warning');
                        } else if (response == 'notes100') {
                            $('.submit-button').slideDown();
                            Swal.fire('Warning!', 'Please enter minimum 100 characters in comment.', 'warning');
                        } else if (response == 'inability') {
                            Swal.fire('Updated!', 'Batch marked as inability successfully.', 'success');
                        } else if (response == 'unable') {
                            Swal.fire('Warning!', 'Unable to mark Batch as inability, at this time..', 'warning');
                        } else {

                            Swal.fire('Updated!', 'Assigned batch status has been updated.', 'success');

                            // $("#"+response.map_id_hash+" td:last-child").find('.batch-confirmation').remove();
                            // $("#"+response.map_id_hash+" td:last-child").append(response.status_html);
                        }
                    })
                    .fail(function (res) {
                        $('#modal-batch-confirmation').modal('toggle');
                        Swal.fire('Error!', 'Oops! Unable to update status.', 'error');
                    });
            }
        });
    });

    $(document).on('click', '.trainee-absent', function () {

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
                            url: "assessment/assessor/batch/attendance_status/" + trainee_id_hash,
                            type: 'GET',
                            dataType: "json"
                        })
                            .done(function (response) {

                                $(this_tr).find("td").eq(-2).html(response.n_a);
                                $(this_td).html(response.upload_marks);

                                console.log(response);
                                Swal.fire('Success!', 'Trainee marked as present.!', 'success');
                            })
                            .fail(function (res) {
                                Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                            });
                    }
                })
            }
        });
    });

    $(document).on('click', '.approved-batch-inability', function () {

        var batchInabilityReason = '';

        var this_tr = $(this).closest('tr');
        var batch_map_id_hash = this_tr.prop('id');

        Swal.fire({
            title: 'Are you sure? Mark Batch as Inability',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please enter your reason for Batch Inability.',
                    input: 'textarea',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Mark as Inability',
                    showLoaderOnConfirm: true,
                    preConfirm: (inabilityReason) => {

                        if (inabilityReason == '') {
                            Swal.showValidationMessage('Request failed: Please enter your reason.');
                        } else {
                            batchInabilityReason = inabilityReason;
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({
                            url: "assessment/assessor/batch/markApprovedBatchInability",
                            type: 'GET',
                            dataType: "json",
                            data: { 'batch_map_id_hash': batch_map_id_hash, 'batchInabilityReason': batchInabilityReason }
                        })
                            .done(function (response) {
                                this_tr.remove();
                                Swal.fire('Success!', 'Batch successfully marked as inability.', 'success')
                            })
                            .fail(function (res) {
                                Swal.fire('Warning!', 'Unable to mark Batch as inability, at this time.', 'warning');
                            });
                    }
                });
            }
        });
    });

    $(document).on('change', ':file', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        var log = numFiles > 1 ? numFiles + ' files selected' : label;
        $(this).parents('.input-group').find(':text').val(log);
    });

    $(".upload-trainee-image").click(function () {

        var id_hash = $(this).closest('tr').prop('id');

        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';
        $('.trainee-profile-data').html(loader);

        $.ajax({
            url: "assessment/assessor/batch/trainee_details/" + id_hash,
            type: 'GET',
            dataType: "json",
        })
            .done(function (response) {
                $('.trainee-profile-data').html(response);
            })
            .fail(function (res) {
                $('#modal-trainee-profile-image').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get trainee details.', 'error');
            });
    });

    $(document).on('click', '#submit-trainee-pic', function (e) {
        var error = 0;

        $(this).closest('form').find('input,textarea,select').each(function () {
            if ($(this).hasClass('required')) {
                if ($(this).val() == '') {

                    Swal.fire('Warning!', 'Oops! Please select trainr image.', 'warning');

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

    $(".complete-assessment").click(function () {

        var batch_id_hash = $(this).attr("data-id");
        var map_id_hash = $(this).closest('tr').prop('id');

        Swal.fire({
            title: 'Complete Assessment?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, complete it!',
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
                            url: "assessment/assessor/batch/complete_assessor_assessment/" + batch_id_hash,
                            type: 'GET',
                            data: { "map_id_hash": map_id_hash },
                            dataType: "json"
                        })
                            .done(function (response) {
                                window.location.reload();
                            })
                            .fail(function (res) {
                                Swal.fire('Error!', 'Oops! Unable to complete assessment.', 'error');
                            });
                    }
                });
            }
        });

    });


    $(document).on('keyup', '.no-of-pages', function () {

        var total_no_of_pages = $('#total-no-of-pages').val();
        if (!isNumeric(total_no_of_pages))
            total_no_of_pages = 0;

        var sum = 0;
        $('.no-of-pages').each(function (i, e) {
            var value = $(this).val();

            if (isNumeric(value)) {
                sum = (parseInt(value) + parseInt(sum));
            }
        });

        $('#total-no-of-pages').val(sum);
    });

    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    $(document).on('click', '#btn-printing-expenditure', function () {

        var error = 0;

        $(this).closest('form').find('input').each(function () {
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
            var amount_claimed = $("#input-amount-claimed").val();
            Swal.fire({
                title: 'Are you sure? Add Printing Expenditure',
                text: "You won't be able to update this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Add it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Please wait a moment!',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();

                            $('#printing-expenditure-form').submit();
                        }
                    });
                }
            });
        }
    });

    $(document).on('click', '.add-printing-expenditure', function () {
        var id = $(this).closest('tr').prop('id');
        $('#input-map-batch-id').val(id);
    });

    $(document).on('click', '.update-printing-expenditure', function () {
        var id = $(this).attr('data-expenditure-id-hash');
        $('#input-id-hash').val(id);
    });

    $(document).on('click', '#btn-update-printing-expenditure', function () {

        var error = 0;

        $(this).closest('form').find('input').each(function () {
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
            Swal.fire({
                title: 'Are you sure? Update Printing Expenditure Bill',
                // text: "You won't be able to update this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Please wait a moment!',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                            $('#update-printing-expenditure-form').submit();
                        }
                    });
                }
            });
        }
    });
});