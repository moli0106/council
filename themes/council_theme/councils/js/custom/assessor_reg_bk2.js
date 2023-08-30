$(document).ready(function () {

    //default
    $(".agency_block").hide();
    $(".expart_type_industrial").prop("disabled", true);
    $(".expart_type_academic").prop("disabled", true);

    //course sector block add
    $(document).on("click",".course_sector_block_add", function () {
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_jobrole_course",
            success: function (response) {
                $(".course_sector").append(response);
            }
        });
    });

    // Course sector block remove
    $(document).on("click",".course_sector_block_remove", function () {
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
                    '<br><b>4. Trainer eligibility_criteria: </b>' + obj.data.trainer_eligibility_criteria +
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
       
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_assessor_certified",
            success: function (response) {
                $(".agency_block").append(response);
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
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_work_experiance",
            success: function (response) {
                $(".work_block").append(response);
            }
        });
    });

     //add certified section
     $(document).on('click','.work_experiance_remove', function () {
       
        $(this).parents().eq(2).remove();
        
    });

    //add experiance as assessor
    $(document).on('click','.add_experiance_as_assessor', function () {
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_experiance_as_assessor",
            success: function (response) {
                $(".experience_block").append(response);
            }
        });
    });

     //add experiance as assessor
     $(document).on('click','.remove_experiance_as_assessor', function () {
       
        $(this).parents().eq(2).remove();
        
    });

    //get fomain experiances
    $(document).on('change','.apply_highest_quali', function () {
        var apply_highest_quali = $(this).val();
        $.ajax({
            type: "GET",
            url: "assessor/assessor_reg/ajax_get_domain_experiance/"+apply_highest_quali,
            success: function (response) {
                $(".domain_exp").html(response);
            }
        });
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
});