$(document).on('click','.stu_centre_wise_seat_allocation',function(){
        
  var zone = $("#zone").val();
     // alert(zone);
    var course = $("#course").val();

    if(zone ==''|| course ==''){

        Swal.fire('Please select zone and course');

    }else{

        Swal.fire({
            title: 'Allocated Seat for the selected Zone?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Genarate!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'We\'ll Allocate the Student Seat For the selected zone.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                            // debugger;
                        setTimeout(function() {
                            $.ajax({
                               // url: "spot_council/student_data_list/zone_centre_wise_seat_allocation/"+zone,
                               url: "spot_council/student_data_list/zone_centre_wise_seat_allocation/"+zone+"/"+course,
                                    type: 'GET',
                                    dataType: "json",
                                    /// data: { 'zone': zone }
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
                                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                                });
                        }, 1000);

                        /* setTimeout(function () {
                            Swal.close()
                        }, 1000); */

                    }
                })

            }
        })
    }
})