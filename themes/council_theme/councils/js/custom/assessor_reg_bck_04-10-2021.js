$(document).ready(function () {

    //default
    //$(".agency_block").hide();
    //$(".expart_type_industrial").prop("disabled", true);
    //$(".expart_type_academic").prop("disabled", true);

    //assessor_certified_status
    $(document).on('click','.assessor_certified_status', function () {
        if($('.assessor_certified_status:checked').val() == 1){
            $(".agency_block").show();
        } else if($('.assessor_certified_status:checked').val() == 0){
            $(".agency_block").hide();
        }
       
    });

    //course sector block add
    $(document).on("click",".course_sector_block_add", function () {

        var course_sector_block_count = Number($("#course_sector_block_count").val());
        var quali = $(".apply_highest_quali :selected").val();
        var domain_exp = $(".domain_exp :selected").val();
        var domain = $(".domain :selected").val();

        if(quali != "" && domain_exp != "" && domain != ""){
        
            $.ajax({
                type: "GET",
                url: "assessor/assessor_reg/ajax_jobrole_course/"+course_sector_block_count+"/"+quali+"/"+domain_exp+"/"+domain,
                success: function (response) {
                    $(".course_sector").append(response);
                    $("#course_sector_block_count").val(course_sector_block_count + 1);
                }
            });
        } else {
            //alert("Please select Domain Qualification, Domain Experiance and Domain");
        }
        
    });

    // Course sector block remove
    $(document).on("click",".course_sector_block_remove", function () {
        //$("#course_sector_block_count").val( Number($("#course_sector_block_count").val() - 1);
      $(this).parents().eq(2).remove();
    });

    //job role change
    $(document).on("change",".job_role", function () {
        var obj_this = $(this);
        
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/get_sector_and_other/" + $(this).val(),
            beforeSend: function() {
                $(obj_this).parents().eq(2).find('.sector_name').val("");
                $(obj_this).parents().eq(2).find('.text_here').html("");
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj.success == 1){
                  $(obj_this).parents().eq(2).find('.sector_name').val(obj.data.sector_name + " ("+ obj.data.sector_code +")");

                  $(obj_this).parents().eq(2).find('.text_here').html(
                    '<div class="panel panel-primary">'+
                    '<div class="panel-body">'+
                    '<b>1. Minimum educationl qualification: </b>'+ obj.data.minimum_educationl_qualification +
                    '<br><b>2. Domain specific working experience: </b>' + obj.data.domain_specific_working_experience + 
                    '<br><b>3. Assessment Experience : </b>' + obj.data.assessment_experience +
                    //'<br><b>4. Trainer eligibility_criteria: </b>' + obj.data.trainer_eligibility_criteria +
                    '</div>'+
                  '</div>'
                  
                  );
                } else {
                    $(obj_this).parents().eq(2).find('.sector_name').val("Sector not found");
                    $(obj_this).parents().eq(2).find('.text_here').html("");
                }
            }
        });
    });
    
    //add certified section
    $(document).on('click','.certificate_number_add', function () {
        var assessing_body_count = Number($("#assessing_body_count").val());

        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_assessor_certified/"+ (assessing_body_count + 1),
            success: function (response) {
                $(".agency_block").append(response);
                $("#assessing_body_count").val(assessing_body_count + 1);
            }
        });
        
    });

    //add certified section
    $(document).on('click','.certificate_number_remove', function () {
       
        $(this).parents().eq(2).remove();
        
    });

    //hide / view certified section
    $(document).on('click','.certified_select', function () {
        //alert ($(this).val());
        if($(this).val() == 1){
            $(".agency_block").show();
        } else {
            $(".agency_block").hide();
        }
    });

    //add work experiance
    $(document).on('click','.add_work_experiance', function () {
        var count_work_experience = Number($("#count_work_experience").val());
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_work_experiance/"+ (count_work_experience + 1),
            success: function (response) {
                $(".work_block").append(response);
                $("#count_work_experience").val(count_work_experience + 1)
            }
        });
    });

     //add certified section
     $(document).on('click','.work_experiance_remove', function () {
       
        $(this).parents().eq(4).remove();
        
    });

    //add experiance as assessor
    $(document).on('click','.add_experiance_as_assessor', function () {
        var count_experience_section = Number($("#count_experience_section").val());
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_experiance_as_assessor/"+(count_experience_section +1),
            success: function (response) {
                $(".experience_block").append(response);
                $("#count_experience_section").val(count_experience_section +1);
            }
        });
    });

     //add experiance as assessor
     $(document).on('click','.remove_experiance_as_assessor', function () {
       
        $(this).parents().eq(4).remove();
        
    });

    //get fomain experiances
    $(document).on('change','.apply_highest_quali', function () {
        //alert($(".domain_exp :selected").val());
        var apply_highest_quali = $(this).val();
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_get_domain_experiance/"+apply_highest_quali,
            success: function (response) {
                $(".domain_exp").html(response);
            }
        });
    });
    
    $(document).on("change",".domain_exp", function () {
        var domain_exp = $(".domain_exp :selected").val();
        var domain = $(".domain :selected").val();
        var quali = $(".apply_highest_quali :selected").val();
        //alert(domain);

        if(domain == ""){
            alert("Please select domain");
        } else {

            $.ajax({
                type: "GET",
                url: "assessor/assessor_reg/ajax_jobrole_select/"+quali+"/"+domain_exp+"/"+domain,
                success: function (response) {
                    $(".job_role").html(response);
                    $(".sector_name").val("");
                    $(".text_here").html("");
                }
            });
        }
    });

    $(document).on("change",".domain", function () {
        var domain_exp = $(".domain_exp :selected").val();
        var domain = $(".domain :selected").val();
        var quali = $(".apply_highest_quali :selected").val();

        if(domain_exp == ""){
            alert("Please select domain experience");
        } else {
            $.ajax({
                type: "GET",
                url: "assessor/assessor_reg/ajax_jobrole_select/"+quali+"/"+domain_exp+"/"+domain,
                success: function (response) {
                    $(".job_role").html(response);
                    $(".sector_name").val("");
                    $(".text_here").html("");
                }
            });
        }

        //alert(domain);
        
    });


    //apply_for_expert
    $(document).on('click','.apply_for_expert', function () {
        if($(this).is(":checked") == true){
            $(".expart_type_industrial").prop("disabled", false);
            $(".expart_type_academic").prop("disabled", false);
        } else {
            $(".expart_type_industrial").prop("disabled", true);
            $(".expart_type_academic").prop("disabled", true);
        }
    });

    var  myVar = setInterval(count_function, 1000);

    function count_function() {
        if($("span").hasClass("sms_time")){
            var sec = Number($(".sms_time").text());
            sec = sec - 1;
            if(sec < 0) {
                $(".sms_time").addClass("sms_alert");
                $(".sms_alert").removeClass("sms_time");
                $(".sms_remaining").html("");
                $(".sms_alert").text("OTP Expitrd. Please send OTP again");
                $(".send_otp_button").attr("disabled", false);
                $(".send_otp_text").attr("disabled", true);
                $(".submit_oto_button").remove();
            }
            $(".sms_time").text(sec);
            //alert(sec);
            //$(".sms_time").text(sec);
        }
    }

    //
    $(document).on('change','#district', function () {
        //alert($(".domain_exp :selected").val());
        var dist_id = $(this).val();

        //alert(dist_id);
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_block/"+dist_id,
            success: function (response) {
                $("#block").html(response);
            }
        });
    });

    $(document).on('change','#permanent_district', function () {
        //alert($(".domain_exp :selected").val());
        var dist_id = $(this).val();

        //alert(dist_id);
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_block/"+dist_id,
            success: function (response) {
                $("#permanent_block").html(response);
            }
        });
    });
    $(document).on("click", "#permanent_same_present_addr", function (e) {
        //alert($(this).val());
        if ($(this).prop('checked')==true){ 
            $("#permanent_house_flat_building").val($("#house_flat_building").val());
            $("#permanent_street").val($("#street").val());
            $("#permanent_district").val($("#district").val());
            $("#permanent_post_office").val($("#post_opffice").val());
            $("#permanent_police").val($("#police").val());
            $("#permanent_pin").val($("#pin").val());

            $("#permanent_state").html($("#state").html());
            $("#permanent_district").html($("#district").html());
            $("#permanent_block").html($("#block").html());

            $('#permanent_state').val($('#state :selected').val());
            $('#permanent_district').val($('#district :selected').val());
            $('#permanent_block').val($('#block :selected').val());

        } else {
            $("#permanent_house_flat_building").val("");
            $("#permanent_street").val("");
            $("#permanent_district").val("");
            $("#permanent_post_office").val("");
            $("#permanent_police").val("");
            $("#permanent_pin").val("");

            $("#permanent_state").html($("#state").html());
            $("#permanent_district").html($("#district").html());
            $("#permanent_block").html('<option value="">-- Select Block / Municipality --</option>');
        }
    });

    $(document).on("dblclick",".working_in", function () {
        if(this.checked){
            $(this).prop('checked', false);
        }
    });
});