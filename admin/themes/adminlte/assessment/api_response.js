$(document).ready(function () {
    $(document).on('click', '.send-response', function (e) {

        var id_hash = $(this).closest('tr').prop('id');

        if (id_hash) {
            Swal.fire({
                title: 'Warning!<br>Are you sure?',
                text: "You want to send the response.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Send it!',
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
                                url: "api/assessment/response/sendResponse/" + id_hash,
                                type: 'GET',
                                dataType: "json"
                            })
                            .done(function (response) {
                                $('#errorTable').find('#'+id_hash).remove();
                                Swal.fire('Success!', 'Response has been successfully sent.!', 'success');
                            })
                            .fail(function (res) {
                                Swal.fire('Warning!', 'Oops! Unable to send the response, Please try again later.', 'warning');
                            });
                        }
                    })
                }
            });
        } else {
            Swal.fire('Warning!', 'Oops! Unable to process, Please try again later.', 'warning');
        }
    });
});