$(document).ready(function () {


    $(document).on('click', '.stdPayment', function(){
        var group_id = $(this).closest('tr').prop('id');
        alert(group_id);

        if(group_id !=''){
            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to payment for this group.',
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
                                url: "vtc_student/student_payment/groupWiseStdPayment/" + group_id,
                                dataType: "json",
                            })
                                .done(function (res) {
                                    // $('#stdCourse').html(res);
                                    Swal.close();
                                })
                                .fail(function (res) {
                                    Swal.fire('Warning!', 'Oops! Unable to Payment, Please try later.', 'warning');
                                });
                        }
                    });

                }
            })
        }

        
    })

    $(document).on('click', '.createStdRegNo', function(){
        var group_id = $(this).closest('tr').prop('id');
        // alert(group_id);

        if(group_id !=''){
            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to create reg no.',
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
                                url: "vtc_student/student_payment/generateStdRegNo/" + group_id,
                                dataType: "json",
                            })
                                .done(function (res) {
                                    // $('#stdCourse').html(res);
                                    Swal.close();
                                })
                                .fail(function (res) {
                                    Swal.fire('Warning!', 'Oops! Unable to get Course list, Please try later.', 'warning');
                                });
                        }
                    });

                }
            })
        }

        
    })

    $(document).on('click','.requeststudentbtn', function(){

        var group_id = $(this).closest('tr').prop('id');
        var std_no = $(this).closest('tr').find(".totalStdCnt").val();
        // var std_no = stdCnt - 36;
        alert(std_no);
        if(group_id !=''){
            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to request for '+std_no+' student.',
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
                                url: "vtc_student/student_payment/groupWiseStdRequest/" + group_id,
                                data: {std_no : std_no},
                                dataType: "json",
                            })
                                .done(function (res) {
                                    // $('#stdCourse').html(res);
                                    Swal.close();
                                    Swal.fire('Success!', 'Request send to admin', 'Success');
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

    //added on 10-04-2023

    $(document).on('click', '.pay_vtc_exam_fee', function(e) {

       
        var isChecked = $('.checkStd').is(':checked');
        
        if (isChecked == false) {
            Swal.fire('Warning!', 'Oops! Please checked atleast one student.', 'warning');
        } else {

            var stdIdArray = [];
            $.each($("input[name='std_id_pk']:checked"), function() {
                stdIdArray.push($(this).val());
            });
            alert("My favourite std_id_pk are: " + stdIdArray);
            if(stdIdArray.length > 50){
                Swal.fire('Warning!', 'Oops! checked no of 20 students at a time.', 'warning');
            }else{
                if(stdIdArray){

                    Swal.fire({
                        title: 'Are you sure?You want to pay!',
                        text: "You will not able to revert it back.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, pay it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Please wait a moment!',
                                html: 'We\'ll saving your Data.',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                
                                    setTimeout(function() {

                                        $.ajax({
                                            url: "vtc_student/student_payment/change_duplicate_app_no",
                                            data: {
                                                stdIdArray: stdIdArray
                                                
                                            },
                                            type: 'GET',
                                            dataType: "json",
                                        })
                                        .done(function(response) {
											if(response == 'done'){
                                            Swal.fire('Success!', 'Successfully Eligible for examination.', 'success');
                                            location.reload();
											}else{
												Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
											}
                                        })
                                        .fail(function(res) {
                                            
                                            Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                                        });

                                    })
                                }
                            })
                        }
                    })
                }
            }

            

        }
    });



    
})