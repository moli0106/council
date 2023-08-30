$(function () {
    $('.select2').select2();
    
    $(document).on('click','.action_buttons a.edit_course', function (e) {
        //e.preventDefault();
        var course_id_hash = $(this).attr("alt");
        $("#myModal .modal-title").html("Edit course");

        $.ajax({
            type: "GET",
            url: "master/new_domain/edit_course/"+course_id_hash,
            beforeSend: function(){

                $("#myModal .modal-body").html("Loading...");
            },
            success: function (response) {
                $("#myModal .modal-body").html(response);
                $('.select2').select2();
            }
        });
        
        alert(course_id_hash);
    });
    $(document).on('click','.course_edit_submit .submit_edit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $("#course_edit_form").attr("action"),
            data:  $("#course_edit_form").serialize(),
            success: function (response) {
                $("#myModal .modal-body").html(response);
                $('.select2').select2();
            }
        });
       //alert(post_url);
    });
    $(document).on('click','.action_buttons a.delete_domain', function (e) {
        //e.preventDefault();
        var course_id_hash = $(this).attr("alt");
        $("#myModal .modal-title").html("Delete Qualification domain Map");
        $("#myModal .modal-body").html("Loading...");

        $.ajax({
            type: "GET",
            url: "master/qualification_domain_map/delete_qualification_domain_map_details/"+course_id_hash,
            beforeSend: function(){

                $("#myModal .modal-body").html("Loading...");
            },
            success: function (response) {
                $("#myModal .modal-body").html(response);
                //$('.select2').select2();
            }
        });

        //alert(course_id_hash);
    });
    $(document).on("click",".domain_delete_submit", function () {
        //delete_domain_form
        var course_id_hash = $("#input_domain_id").val();

        //alert(course_id_hash);
        $.ajax({
            type: "GET",
            url: "master/qualification_domain_map/delete_qualification_domain_map_details/"+course_id_hash+"/delete",
            success: function (response) {
                $("#myModal .modal-body").html(response);
               setTimeout(function(){ window.location.href="master/qualification_domain_map"; }, 2000);
               
            }
        });
    });


    // $(document).on('change','.qualification', function (e) {
    //     var quali_id = $(this).val();
    //     //$("#myModal .modal-title").html("Course Details");

    //     //alert(quali_id);
        
    //     $.ajax({
    //         type: "GET",
    //         url: "master/qualification_domain_map/ajax_get_domain/" + quali_id,
    //         beforeSend: function(){

    //             $(".domain").html('<option value="">-- Select Domain --</option>');
    //         },
    //         success: function (response) {
    //             $(".domain").html(response);
    //             $('.select2').select2();
    //         }
    //     });
    // });
})