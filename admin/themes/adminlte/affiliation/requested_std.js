$(document).ready(function() {

    $(document).on('click', '.vtc_rquest_approve', function() {
        
        var request_id = $(this).closest('tr').prop('id');
        alert(request_id);

        if(request_id != ''){
            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to approve.',
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
                        html: 'loading data...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
            
                            $.ajax({
                                url: "affiliation/requested_std/approveStudentRequest/" + request_id,
                                dataType: "json",
                            })
                                .done(function (res) {
                                    // $('#stdCourse').html(res);
                                    Swal.close();
                                    Swal.fire('Success!', 'Request Approved', 'Success');
                                    location.reload();
                                })
                                .fail(function (res) {
                                    Swal.fire('Warning!', 'Oops! Unable to Request, Please try later.', 'warning');
                                });
                        }
                    });

                }
            })
        }
        
        
    });
});