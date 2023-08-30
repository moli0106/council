$(document).ready(function () {

// added parag 12-01-2021
$(document).on('click','.print', function () {
    //alert(1111);
    $(".print_details").print(/*options*/);
});
$('.select2').select2();

$('#TermsCond').modal({
        backdrop: 'static',
        keyboard: false
    });

$('.datepicker').datepicker({
		autoclose: true,
		format: 'dd-mm-yyyy',
		
	});

$('a.confirm_next').click(function(){return confirm('Please save your data before going to the next tab');});
$('a.confirm_pre').click(function(){return confirm('Please save your data before going to the Previous tab');});

	
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
                url: "assessor_profile/assessor_registration/ajax_jobrole_course/"+course_sector_block_count+"/"+quali+"/"+domain_exp+"/"+domain,
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
            url: "assessor_profile/assessor_registration/get_sector_and_other/" + $(this).val(),
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
        //alert(assessing_body_count);
        $.ajax({
            type: "GET",
            url: "assessor_profile/assessor_registration/ajax_assessor_certified/"+ (assessing_body_count + 1),
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
            url: "assessor_profile/assessor_registration/ajax_work_experiance/"+ (count_work_experience + 1),
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
            url: "assessor_profile/assessor_registration/ajax_experiance_as_assessor/"+(count_experience_section +1),
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

    //get domain experiances
    $(document).on('change','.apply_highest_quali', function () {
        //alert($(".domain_exp :selected").val());
        var apply_highest_quali = $(this).val();
        $.ajax({
            type: "GET",
            url: "assessor_profile/assessor_registration/ajax_get_domain_experiance/"+apply_highest_quali,
            success: function (response) {
                $(".domain_exp").html(response);
				$(".domain").html("<option value=''>-- Select Domain --</option>");
            }
        });
        //added parag 03-01-2021
        /*$.ajax({
            type: "GET",
            url: "assessor_profile/assessor_registration/get_quali_domain/"+apply_highest_quali,
            success: function (response) {
                $(".domain").html(response);
            }
        });*/

    });
	
	
	
    //Added by Waseem on 25-01-2021
    $(document).on('change','.domain_exp', function () {
        //alert($(".domain_exp :selected").val());
        //var apply_highest_quali = $(this).val();

        var domain_exp = $(".domain_exp :selected").val();
        //var domain = $(".domain :selected").val();
        var apply_highest_quali = $(".apply_highest_quali :selected").val();
        $.ajax({
            type: "GET",
            url: "assessor_profile/assessor_registration/get_quali_domain/"+apply_highest_quali+"/"+domain_exp,
            success: function (response) {
                $(".domain").html(response);
            }
        });

    });
    //Added by Waseem on 25-01-2021
	
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
                url: "assessor_profile/assessor_registration/ajax_jobrole_select/"+quali+"/"+domain_exp+"/"+domain,
                success: function (response) {
                    $(".job_role").html(response);
                    $(".sector_name").val("");
                    $(".text_here").html("");
                }
            });
        }
    });

    $(document).on("change",".domain", function () { // change parag 03-01-2021
        var domain_exp = $(".domain_exp :selected").val();
        var domain = $(".domain :selected").val();
        var quali = $(".apply_highest_quali :selected").val();

        if(domain_exp == ""){
            alert("Please select domain experience");
        } else {
            $.ajax({
                type: "GET",
                url: "assessor_profile/assessor_registration/ajax_jobrole_select/"+quali+"/"+domain_exp+"/"+domain,
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


    $("#state").change(function(){
		var state_id = $("#state").val();
		var url = 'assessor_profile/assessor_registration/ajax_district/'+ state_id;
		if(state_id != "") {
			$.ajax({
				url: url,
				success: function(result){
					//alert(result);
					$("#district").html(result);
				}
			});
		} else {
			$("#district").html('<option value="">-- Select District --</option>');
		}
    });

    $("#state").change(function(){
		var state_id = $("#state").val();
        //alert(state_id);
        if(state_id!=19){
            $(".other_block_hide").hide();
            $("#block").val("");
        } else{
            $(".other_block_hide").show();
        } 
    });

    $("#permanent_state").change(function(){
		var state_id = $("#permanent_state").val();
        //alert(state_id);
        if(state_id!=19){
            $(".other_permanent_block_hide").hide();
        } else{
            $(".other_permanent_block_hide").show();
        } 
    });


    
    //
    $(document).on('change','#district', function () {
        //alert($(".domain_exp :selected").val());
        var dist_id = $(this).val();

        //alert(dist_id);
        $.ajax({
            type: "GET",
            url: "assessor_profile/assessor_registration/ajax_block/"+dist_id,
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
            url: "assessor_profile/assessor_registration/ajax_block/"+dist_id,
            success: function (response) {
                $("#permanent_block").html(response);
            }
        });
    });

    $("#permanent_state").change(function(){
		var state_id = $("#permanent_state").val();
		var url = 'assessor_profile/assessor_registration/ajax_district/'+ state_id;
		if(state_id != "") {
			$.ajax({
				url: url,
				success: function(result){
					//alert(result);
					$("#permanent_district").html(result);
				}
			});
		} else {
			$("#permanent_district").html('<option value="">-- Select District --</option>');
		}
    });




    $(document).on("click", "#permanent_same_present_addr", function (e) {
        //alert($(this).val());
        if ($(this).prop('checked')==true){ 
            //state=val($('#state :selected').val());
            state=$('#state').find('option:selected').val();
            //alert(state);
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

            if(state==19){
                $(".other_permanent_block_hide").show();
            }else{
                $(".other_permanent_block_hide").hide();
            }

        } else {
            $("#permanent_house_flat_building").val("");
            $("#permanent_street").val("");
            $("#permanent_district").val("");
            $("#permanent_post_office").val("");
            $("#permanent_police").val("");
            $("#permanent_pin").val("");

            $("#permanent_state").html($("#state").html());
            $("#permanent_district").html('<option value="">-- Select District --</option>');
            $("#permanent_block").html('<option value="">-- Select Block / Municipality --</option>');
            
            $(".other_permanent_block_hide").hide();
            
        }
    });

    // $(document).on("dblclick",".working_in", function () {
    //     if(this.checked){
    //         $(this).prop('checked', false);
    //     }
    // });


    //Remove Work Experience Confirmation
		$('.work_exp_remove').click(function(){
			var pt_hash = $(this).attr('id');
			//var cen_hash = $(this).attr('rel');
			var url = 'assessor_profile/assessor_registration/ajax_remove_work_exp/'+pt_hash;
			//alert(url);
			$.ajax({
				type: 'GET',
				url: url,
				success: function(result)
				{
					$('.modal_remove_content').html(result);
				}
			});
		});
		
		//remove Work Experience ----------------------------------------------------------------
		$(document).on('click','.yes_work_exp_remove',function(event){
			event.preventDefault();
			$(".yes_work_exp_remove").hide();
			var id_hash = $(this).attr('id');
			//var c_id_hash = $(this).attr('rel');
			var url = 'assessor_profile/assessor_registration/ajax_delete_work_exp_dtls/'+id_hash;
			var this_ob = this;
			if(id_hash != "" && id_hash.length == 32) 
			{
				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'text',
					success: function(result)
					{
						$(".remove_btn_no").html('Close');
						var obj = JSON.parse(result);
						if(obj.response == "TRUE")
						{
							//csrf=obj.csrf_token;
							$(".remove_body").html('<div class="alert alert-success">Work Experience  Details Removed Successfully</div>');
							$("#work_exp_"+id_hash).remove();
							$('.c1').remove();
							//setTimeout(function(){ location.reload(); }, 2000);
						} 
						else 
						{
							//csrf=obj.csrf_token;
							$(".remove_body").html('<div class="alert alert-warning">Work Experience Details Removed Failed</div>');
							//setTimeout(function(){ location.reload(); }, 2000);
						}
					}
				});
			} 
			else 
			{
				//$(".remove_body").html('Something Went wrong.');
				$(".remove_body").html('<div class="alert alert-warning">Something Went wrong! Please try again</div>');
			}
        });
        


        //Remove Assessor Experience Confirmation
		$('.assessor_exp_remove').click(function(){
			var pt_hash = $(this).attr('id');
			//var cen_hash = $(this).attr('rel');
			var url = 'assessor_profile/assessor_registration/ajax_remove_assessor_exp/'+pt_hash;
			//alert(url);
			$.ajax({
				type: 'GET',
				url: url,
				success: function(result)
				{
					$('.modal_remove_content').html(result);
				}
			});
		});
		
		//remove Assessor Experience ----------------------------------------------------------------
		$(document).on('click','.yes_assessor_exp_remove',function(event){
			event.preventDefault();
			$(".yes_assessor_exp_remove").hide();
			var id_hash = $(this).attr('id');
			//var c_id_hash = $(this).attr('rel');
			var url = 'assessor_profile/assessor_registration/ajax_delete_assessor_exp_dtls/'+id_hash;
			var this_ob = this;
			if(id_hash != "" && id_hash.length == 32) 
			{
				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'text',
					success: function(result)
					{
						$(".remove_btn_no").html('Close');
						var obj = JSON.parse(result);
						if(obj.response == "TRUE")
						{
							//csrf=obj.csrf_token;
							$(".remove_body").html('<div class="alert alert-success">Experience As Assessor / Expert of syllabus committee  Details Removed Successfully</div>');
							$("#assessor_exp_"+id_hash).remove();
							$('.c1').remove();
							//setTimeout(function(){ location.reload(); }, 2000);
						} 
						else 
						{
							//csrf=obj.csrf_token;
							$(".remove_body").html('<div class="alert alert-warning">Experience As Assessor / Expert of syllabus committee Details Removed Failed</div>');
							//setTimeout(function(){ location.reload(); }, 2000);
						}
					}
				});
			} 
			else 
			{
				//$(".remove_body").html('Something Went wrong.');
				$(".remove_body").html('<div class="alert alert-warning">Something Went wrong! Please try again</div>');
			}
        });




        //Remove Assessor Experience Confirmation
		$('.assessor_professional_remove').click(function(){
			var pt_hash = $(this).attr('id');
			//var cen_hash = $(this).attr('rel');
			var url = 'assessor_profile/assessor_registration/ajax_remove_assessor_professional/'+pt_hash;
			//alert(url);
			$.ajax({
				type: 'GET',
				url: url,
				success: function(result)
				{
					$('.modal_remove_content').html(result);
				}
			});
		});
		
		//remove Assessor Experience ----------------------------------------------------------------
		$(document).on('click','.yes_assessor_professional_remove',function(event){
			event.preventDefault();
			$(".yes_assessor_professional_remove").hide();
			var id_hash = $(this).attr('id');
			//var c_id_hash = $(this).attr('rel');
			var url = 'assessor_profile/assessor_registration/ajax_delete_assessor_professional_dtls/'+id_hash;
			var this_ob = this;
			if(id_hash != "" && id_hash.length == 32) 
			{
				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'text',
					success: function(result)
					{
						$(".remove_btn_no").html('Close');
						var obj = JSON.parse(result);
						if(obj.response == "TRUE")
						{
							//csrf=obj.csrf_token;
							$(".remove_body").html('<div class="alert alert-success"> Present Engagement details Removed Successfully</div>');
							$("#assessor_exp_"+id_hash).remove();
							$('.c1').remove();
							//setTimeout(function(){ location.reload(); }, 2000);
						} 
						else 
						{
							//csrf=obj.csrf_token;
							$(".remove_body").html('<div class="alert alert-warning"> Present Engagement details Removed Failed</div>');
							//setTimeout(function(){ location.reload(); }, 2000);
						}
					}
				});
			} 
			else 
			{
				//$(".remove_body").html('Something Went wrong.');
				$(".remove_body").html('<div class="alert alert-warning">Something Went wrong! Please try again</div>');
			}
        });
		
		/* Auto Redirection of Added by Waseem on 23-01-2021 */
	$(document).on('click','.remove_btn_no',function(){
		window.location.href = "assessor_profile/assessor_registration/professional_details";
	});
        


    //confirmation Final Submit
	$('.confirm_final_submit').click(function(){
        var cen_hash = $(this).attr('rel');
        //alert(cen_hash);
		var url = 'assessor_profile/assessor_registration/ajax_confirm_final_submit/'+cen_hash;
		//alert(url);
		$.ajax({
			type: 'GET',
			url: url,
			success: function(result)
			{
				$('.modal_remove_content').html(result);
			}
		});
	});
	
	//confirmation Final Submit ----------------------------------------------------------------
	$(document).on('click','.yes_confirm_final_submit',function(event){
		event.preventDefault();
		$(".yes_confirm_final_submit").hide();
		//var id_hash = $(this).attr('id');
		var c_id_hash = $(this).attr('rel');
		//alert(c_id_hash);
		var url = 'assessor_profile/assessor_registration/ajax_confirm_final_submit_button/'+c_id_hash;
		var this_ob = this;
		if(c_id_hash != "" && c_id_hash.length == 32) 
		{
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'text',
				success: function(result)
				{
					//$(".remove_btn_no").remove();
					var obj = JSON.parse(result);
					if(obj.response == "TRUE")
					{
						//csrf=obj.csrf_token;
						$(".remove_body").html('<div class="alert alert-success">Assessor Application Final Submited Successfully</div>');
						//$("#trainer_"+id_hash).remove();
						$('.c1').remove();
						$(".remove_btn_no").hide();
						$("#close_btn").show();
						//setTimeout(function(){ location.reload(); }, 2000);

						
					} 
					else 
					{
						//csrf=obj.csrf_token;
						$(".remove_body").html('<div class="alert alert-warning">Assessor Application Final Submite Failed</div>');
						//setTimeout(function(){ location.reload(); }, 2000);
					}

					
				}
			});

			
		} 
		else 
		{
			//$(".remove_body").html('Something Went wrong.');
			$(".remove_body").html('<div class="alert alert-warning">Something Went wrong! Please try again</div>');
		}
    });
    

    $("#working_in").change(function(){
		var working_in = $("#working_in").val();
       // alert(working_in);
        if(working_in=='3'){
            $(".centre_hide_show").hide();
            $("#centre_code").val("");
            $("#centre_name").val("");
        } else if(working_in=='1' || working_in=='2' || working_in=='4'){
            $(".centre_hide_show").show();
            $("#centre_code").val("");
            $("#centre_name").val("");
        } 
    });

    //$(document).on('change','#centre_code', function () {
        $( "#centre_code" ).mouseout(function() {
        working_value=$('#working_in').find('option:selected').val();
        centre_code=$(this).val();
        //alert(working_value);
        //alert($(this).val());
        var centre_code_hash = CryptoJS.MD5(centre_code);
        //alert(centre_code_hash);
 
        $.ajax({
            type: "GET",
            url: "assessor_profile/assessor_registration/ajax_get_centre_details/"+working_value+"/"+centre_code_hash,
            beforeSend: function() {
                //$('.submit_button').prop('disabled', true);
                $('#centre_name').val("");
                //$('#branch').val("");
             },
            success: function (response) {
                 var obj = JSON.parse(response);
                 if(obj.exists == 1){
                     var centre_id   = obj.centre.centre_id;
                     var centre_name = obj.centre.working_centre_name;
                     //var branch      = obj.centre.branch;
                     $('#centre_id').val(centre_id);
                     $('#centre_name').val(centre_name);
                     //$('.submit_button').prop('disabled', false);
                 } else if(obj.exists == 0) {
                     alert('Centre code does not exist.');
                     //$('.submit_button').prop('disabled', true);
                 }
            }
        });
     });
//Added by Waseem on 26-02-2021

$("#ssc_wbsctvesd_certified").change(function(){
    var ssc_wbsctvesd_certified = $("#ssc_wbsctvesd_certified").val();
   // alert(ssc_wbsctvesd_certified);
    if(ssc_wbsctvesd_certified=='1'){
        $(".hide_show_attened_toa").show();
        //$(".hide_show_toa_certificate").show();
        $("#attended_any_toa").val("");
       // $("#centre_name").val("");
    } else{
        $(".hide_show_attened_toa").hide();
        $(".hide_show_toa_certificate").hide();
        $("#attended_any_toa").val("");
        //$("#centre_name").val("");
    } 
});

$("#attended_any_toa").change(function(){
    var attended_any_toa = $("#attended_any_toa").val();
   // alert(ssc_wbsctvesd_certified);
    if(attended_any_toa=='1'){
        $(".hide_show_toa_certificate").show();
        //$("#attended_any_toa").val("");
       // $("#centre_name").val("");
    } else{
        $(".hide_show_toa_certificate").hide();
        //$("#attended_any_toa").val("");
        //$("#centre_name").val("");
    } 
});




});