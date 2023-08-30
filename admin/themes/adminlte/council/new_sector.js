$(function () {

    // $(document).on("click",".action_buttons a.view_sector", function () {
    //     alert(11);
    // });
    //alert(111111111);
    // $('.select2').select2();
    $(document).on("click",".action_buttons a.view_sector", function () {
    //alert(222)
    //     //e.preventDefault();
    var course_id_hash = $(this).attr("alt");
    //alert(course_id_hash);
        $("#myModal .modal-title").html("Sector Details");
        
        $.ajax({
            type: "GET",
            url: "council/new_sector/view_sector_details/" + course_id_hash,
            beforeSend: function(){

                $("#myModal .modal-body").html("Loading...");
            },
            success: function (response) {
                $("#myModal .modal-body").html(response);
                $('.select2').select2();
            }
        });

    //     //alert(course_id_hash);
    });
    // $(document).on('click','.action_buttons a.edit_course', function (e) {
    //     //e.preventDefault();
    //     var course_id_hash = $(this).attr("alt");
    //     $("#myModal .modal-title").html("Edit course");

    //     $.ajax({
    //         type: "GET",
    //         url: "council/new_course/edit_course/"+course_id_hash,
    //         beforeSend: function(){

    //             $("#myModal .modal-body").html("Loading...");
    //         },
    //         success: function (response) {
    //             $("#myModal .modal-body").html(response);
    //             $('.select2').select2();
    //         }
    //     });
        
    //     alert(course_id_hash);
    // });
    // $(document).on('click','.course_edit_submit .submit_edit', function (e) {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "POST",
    //         url: $("#course_edit_form").attr("action"),
    //         data:  $("#course_edit_form").serialize(),
    //         success: function (response) {
    //             $("#myModal .modal-body").html(response);
    //             $('.select2').select2();
    //         }
    //     });
    //    //alert(post_url);
    // });
    // $(document).on('click','.action_buttons a.delete_course', function (e) {
    //     //e.preventDefault();
    //     var course_id_hash = $(this).attr("alt");
    //     $("#myModal .modal-title").html("Delete Course");
    //     $("#myModal .modal-body").html("Loading...");

    //     $.ajax({
    //         type: "GET",
    //         url: "council/new_course/delete_course_details/"+course_id_hash,
    //         beforeSend: function(){

    //             $("#myModal .modal-body").html("Loading...");
    //         },
    //         success: function (response) {
    //             $("#myModal .modal-body").html(response);
    //             //$('.select2').select2();
    //         }
    //     });

    //     //alert(course_id_hash);
    // });
    // $(document).on("click",".course_delete_submit", function () {
    //     //delete_course_form
    //     var course_id_hash = $("#input_course_id").val();

    //     //alert(course_id_hash);
    //     $.ajax({
    //         type: "GET",
    //         url: "council/new_course/delete_course_details/"+course_id_hash+"/delete",
    //         success: function (response) {
    //             $("#myModal .modal-body").html(response);
    //            setTimeout(function(){ location.reload(); }, 2000);
               
    //         }
    //     });
    // });
})