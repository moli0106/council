$(document).ready(function () {

    $(document).on('click', '.btn-search-bank-details', function () {
        var ifsc_code = $("#ifsc_code").val();
        if (ifsc_code.length == 11) {

            Swal.fire({
                title: 'Please wait a moment!',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    $.ajax({
                        url: "assessor_profile/add_bank_details/getBankDetails/" + ifsc_code,
                        type: 'GET',
                        dataType: "json"
                    })
                        .done(function (response) {
                            $(".bank-details").show('slow');

                            $("#bank_name").val(response.bank_name);
                            $("#branch_name").val(response.branch);

                            Swal.close();
                        })
                        .fail(function (res) {
                            $(".bank-details").hide('slow');
                            Swal.fire('Warning!', 'Oops! IFSC code does not exist.', 'warning');
                        });
                }
            });
        } else {
            Swal.fire('Warning!', 'Please Enter correct IFSC Code..', 'warning');
        }
    });
});