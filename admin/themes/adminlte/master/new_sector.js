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
            url: "master/new_sector/view_sector_details/" + course_id_hash,
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
    
	
	$(document).on('click','.action_buttons a.edit_sector', function (e) {
        //e.preventDefault();
        var sector_id_hash = $(this).attr("alt");
        $("#myModal .modal-title").html("Edit Sector");

        $.ajax({
            type: "GET",
            url: "master/new_sector/edit_sector/"+sector_id_hash,
            beforeSend: function(){

                $("#myModal .modal-body").html("Loading...");
            },
            success: function (response) {
                $("#myModal .modal-body").html(response);
                $('.select2').select2();
            }
        });
        
        //alert(course_id_hash);
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
})