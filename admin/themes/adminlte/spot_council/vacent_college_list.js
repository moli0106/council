$(document).ready(function () {

    // $(document).on('click', '.application_search', function () {

    //     var application_id_hash = $("#search_application").val();
    //     var college_id_hash = $("#college_id_hash").val();
    //     var college_map_id = $("#college_map_id").val();
      
    //     // alert(college_map_id);
    //     if (application_id_hash != '') {
    //         $.ajax({
    //             type: "GET",
    //             url: "spot_council/vacent_college_list/get_application_no",
    //             data: { college_id_hash: college_id_hash,application_id_hash:application_id_hash,college_map_id:college_map_id },
    //             success: function (result) {
    //                   console.log(result);
    //                 if (result == "fail") {

    //                     $("#enrollment_id").html('');
    //                     swal.fire('Warning!', 'No data found with the respect of that Application No.', 'warning')
    //                 } else {
    //                     console.log('else');
    //                     $("#enrollment_id").html(result);
    //                 }



    //             }
    //         });
    //     } else {
    //         $("#enrollment_id").html('');
    //         swal.fire('Warning!', 'Please enter Valid Application form no.', 'warning')
    //     }
    //     // alert(search_enrollment);



    //     //alert(course_id_hash);
    // });


    $(document).on('click', '.application_search', function () {

        var application_id_hash = $("#search_application").val();
        var college_id_hash = $("#college_id_hash").val();
        var college_map_id = $("#college_map_id").val();
        
        // alert(college_map_id);

        if(application_id_hash !=''){

            $.ajax({
                url: "spot_council/vacent_college_list/get_application_no",
                type: 'GET',
                data: {college_id_hash: college_id_hash,application_id_hash:application_id_hash,college_map_id:college_map_id},
                dataType: "JSON",
            })
            .done(function(res) {
                $('#enrollment_id').html(res);
            })
            .fail(function() {
                console.log('error');
                $("#enrollment_id").html('');
                swal.fire('Warning!', 'No data found with the respect of that Application No.', 'warning')
            });

        }else{
           
            $("#enrollment_id").html('');
            swal.fire('Warning!', 'Please enter Application form no.', 'warning')
        }
    });


});