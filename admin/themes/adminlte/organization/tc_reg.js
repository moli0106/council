$(document).ready(function () {

    $(document).on('click', '.self_tc_btn', function () {

        var org_id = $(this).data('id');
		//alert(org_id);
        Swal.fire({
            title: 'Are you sure,you want to add you as a TC?',
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
                                    url: "organization/tc_reg/add_self_tc/"+ org_id,
                                    type: 'GET',
                                    dataType: "json",
                                })
                                .done(function(response) {
                                    if (!response.ok) {

                                        Swal.fire('Error!', response.msg, 'error');
                                    } else if (response.ok == 1) {

                                        
                                        Swal.fire('Success!', response.msg, 'success');
                                    } else {

                                        Swal.fire('Warning!', response.msg, 'warning');
                                    }
                                    console.log(response);
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Unable to save data.', 'warning');
                                });
                        }, 100);
                    }
                })
            }
        })
	});
});