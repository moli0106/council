$(document).ready(function () {

    $(document).on('blur', '#ins_code', function() {

        var ins_code = $(this).val();
        if (ins_code != '') {
            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {

                        $.ajax({
                                url: "polytechnic/affiliation/getINSName/" + ins_code,
                                type: 'GET',
                                dataType: "json",
                            })
                            .done(function(res) {
                                if (res != '') {
                                    $('#ins_name').val(res);
                                    Swal.close();
                                } else {
                                    $('#ins_code').val('');
                                    $('#ins_name').val('');
                                    Swal.fire('Warning!', 'You are not Affiliated, Please contact Council Administration.', 'warning');
                                }
                            })
                            .fail(function(res) {
                                $('#ins_name').val('');
                                $('#ins_code').val('');
                                Swal.fire('Warning!', 'Oops! Institute Code not found.', 'warning');
                            });

                    }, 100);
                }
            });
        }
    });
});