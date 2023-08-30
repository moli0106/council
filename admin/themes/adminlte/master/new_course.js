$(function () {
    $('.select2').select2();
    $(document).on('click','.action_buttons a.view_course', function (e) {
        //e.preventDefault();
        var course_id_hash = $(this).attr("alt");
        $("#myModal .modal-title").html("Course Details");
        
        $.ajax({
            type: "GET",
            url: "master/new_course/view_course_details/" + course_id_hash,
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

    //added parag 10-01-2021
    $(document).on('change','.qualification', function (e) {
        var quali_id = $(this).val();
        //$("#myModal .modal-title").html("Course Details");

        //alert(quali_id);
        
        $.ajax({
            type: "GET",
            url: "master/new_course/ajax_get_domain/" + quali_id,
            beforeSend: function(){

                $(".domain").html('<option value="">-- Select Domain --</option>');
            },
            success: function (response) {
                $(".domain").html(response);
                $('.select2').select2();
            }
        });
    });
    //added parag 10-01-2021
    $(document).on('click','.delete_quali_exp_domain_map', function (e) {
        var map_id = $(this).attr("href");
        var redirect = $(this).attr("alt");
        $("#map_id").val(map_id);
        $("#redirect").val(redirect);
    });
    //added parag 10-01-2021
    $(document).on("click",".delete_data", function () {
        var map_id = $("#map_id").val();
        var redirect = $("#redirect").val();
        $.ajax({
            type: "GET",
            url: "master/new_course/ajax_delete_map/"+map_id,
            data:  $("#course_edit_form").serialize(),
            success: function (response) {
               if(response == 'success'){
                $('.modal-body').html('<div class="alert alert-danger">'+
                'Successfully deleted'+
            '</div>');
               } else {
                $('.modal-body').html("Try again");
               }
            }
        });
    });

    $(document).on('click','.action_buttons a.edit_course', function (e) {
        //e.preventDefault();
        var course_id_hash = $(this).attr("alt");
        $("#myModal .modal-title").html("Edit course");

        $.ajax({
            type: "GET",
            url: "master/new_course/edit_course/"+course_id_hash,
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



    $(document).on('click','.action_buttons a.delete_course', function (e) {
        //e.preventDefault();
        var course_id_hash = $(this).attr("alt");
        $("#myModal .modal-title").html("Delete Course");
        $("#myModal .modal-body").html("Loading...");

        $.ajax({
            type: "GET",
            url: "master/new_course/delete_course_details/"+course_id_hash,
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
    $(document).on("click",".course_delete_submit", function () {
        //delete_course_form
        var course_id_hash = $("#input_course_id").val();

        //alert(course_id_hash);
        $.ajax({
            type: "GET",
            url: "master/new_course/delete_course_details/"+course_id_hash+"/delete",
            success: function (response) {
                $("#myModal .modal-body").html(response);
               setTimeout(function(){ window.location.href="master/new_course"; }, 2000);
               
            }
        });
    });

    $(document).on('click','a.editDomain', function (e) {
        
        var domain_id_hash = $(this).attr("alt");
        sessionStorage.setItem('rowID', $(this).closest('tr').attr('id'));

        $.ajax({
            type: "GET",
            url: "master/new_course/edit_domain/"+domain_id_hash,
            beforeSend: function()
            {
                $("#editDomainModal .modal-body").html("Loading...");
            },
            success: function (response) 
            {
                $("#editDomainModal .modal-body").html(response);
            }
        });
    });

    $(document).on('click', '.updateDomainForm', function(e){
        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url: $("#domain_edit_form").attr("action"),
            data:  $("#domain_edit_form").serialize(),
            success: function (response) 
            {
                $("#editDomainModal .modal-body").html(response);
                $('#'+sessionStorage.getItem('rowID')).find('td:eq(2)').text($('#updateDomainExperience').val());
            }
        });
    });
})