$(document).ready(function () {

    $(document).on('click', '.assessor-empanelled', function(){

        var map_id = $(this).closest("tr").prop("id");
        var this_btn = $(this);
		
		var dataDate = $(this).attr("data-date");

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to assign Assessor as Empanelled!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Assign!',
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'We\'ll assigne or as Empanelled.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function () {
                            $.ajax({
                                url: "assessor_ems/assessor_result/assign_assessor_empanelled",
                                type: 'GET',
                                dataType: "json",
                                data: { map_id: map_id, dataDate: dataDate },
                            })
								.done(function(response) {
									this_btn.remove();
									Swal.fire('Assigned!','Assessor successfully assigned as Empanelled.','success')
								})
								.fail(function(res) {
									Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
								});
                        }, 100);
                    }
                });
            }
        });
    });

});