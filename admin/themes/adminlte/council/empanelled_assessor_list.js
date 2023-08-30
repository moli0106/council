$(document).ready(function () {
	$('.select2').select2();

    // added parag 12-01-2021
    $(document).on('click','.print', function () {
        //alert(1111);
        $(".print_details").print(/*options*/);
    });
	
	
    $(document).on('click', '.getSectorJobRole', function(){
        var rowId = $(this).closest("tr").prop("id");
		//alert(rowId);

        $.ajax({
            url: "council/empanelled_assessor_list/getSectorJobRole",
            type: 'GET',
            dataType: "json",
            data: {rowId: rowId},
        })
        .done(function(response) {
            $("#sectorJobRoleList").html(response);
        })
        .fail(function(res) {
            $('#myModalList').modal('toggle');
            Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
        });
    });


    //Added on 17-02-2022

    $(document).on('click', '.add_course_map', function(){
        var this_tr = $(this).closest('tr');
        var course_id = $(this).closest('tr').prop('id');
        var assessor_id_hash = $(this).prop('id');
        var course_emp_id_hash = $(this).data('empcourse');
		//alert(course_emp_id_hash);

        Swal.fire({
            title: 'Are you sure? Map this course for Assessor',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Course Mapped it!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: "council/empanelled_assessor_list/add_course_group/"+course_id+"/"+assessor_id_hash+"/"+course_emp_id_hash,
                    type: 'GET',
                    dataType: "json",
                })
                .done(function(response) {
                    console.log(response);
                    this_tr.remove();
                    Swal.fire('Mapped!','Map this course for Assessor.','success');
                })
                .fail(function(res) {
                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
                });
            }
        });
        
    });
});