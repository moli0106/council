$(document).ready(function () {
	
	$(document).on('click','.print', function () {
    //alert(1111);
    $(".print_details").print(/*options*/);
});

    $('a.confirm_next').click(function(){return confirm('Please save your data before going to the next tab');});
    $('a.confirm_pre').click(function(){return confirm('Please save your data before going to the Previous tab');});

    $('.datepicker').datepicker({
		autoclose: true,
		format: 'dd-mm-yyyy',
		
	});

    $(document).on('change', '#marital_status', function() {

        var gender = $('#gender').val();
        var marital_status = $(this).val();
        showKanyashreeBox(gender,marital_status);
        
    });

    $(document).on('change', '#gender', function() {

        var marital_status = $('#marital_status').val();
        var gender = $(this).val();
        showKanyashreeBox(gender,marital_status);
        
    });

    function showKanyashreeBox(gender,marital_status) {
        
        if (marital_status == 2 && gender == 2) {
            $('.kanyashree_no_div').show();
        } else {
            $('.kanyashree_no_div').hide();
        }
    }

    $(document).on('change', '#citizenship', function() {
        if ($(this).val() != 1) {
            $('.citizenship_doc_div').show();
        } else {
            $('.citizenship_doc_div').hide();
        }
    });

    $(document).on('change', '#state', function() {
        var state = $(this).val();

        getDistrictVal(state,'');
    });

    function getDistrictVal(state, dis){
        if(state == 19){
            $('.other_state_div').show();
        }else{
            $('.other_state_div').hide();
        }

        $.ajax({
                url: "student_profile/std_registration/getDistrict/" + state,
                dataType: "JSON",
            })
            .done(function(res) {
                var html = '<option value=""> select District </option>';
                for(var i=0; i< res.length; i++){
                    if(dis == res[i].district_id_pk){
                        var sel = "selected";
                    }else{
                        sel = '';
                    }
                    html += '<option '+sel+' value="'+res[i].district_id_pk+'" >'+res[i].district_name+' </option>'
                    
                }

                $('#district').html(html);
               
            })
            .fail(function() {
                console.log('error');
            });
    }

    $(document).on('change', '#district', function() {
        var district = $(this).val();
        // alert(district);
        getSubDivisionVal(district,'');
       
    });

    function getSubDivisionVal(district , subdiv){
        $.ajax({
            url: "student_profile/std_registration/getSubDivision/" + district,
            dataType: "JSON",
        })
        .done(function(res) {

            var html = '<option value=""> select Subdivision </option>';
            var subDivision = res.subDivision;
            console.log(subDivision);
            for(var i=0; i< subDivision.length; i++){
                if(subdiv == subDivision[i].subdiv_id_pk){
                    var sel = "selected";
                }else{
                    sel = '';
                }
                html += '<option '+sel+' value="'+subDivision[i].subdiv_id_pk+'" >'+subDivision[i].subdiv_name+' </option>'
                
            }


            $('#subDivision').html(html);
            // $('#subDivision').html(res.subDivisionHtml);
            $('#nodal_id_fk').html(res.nodalOfficerHtml);
        })
        .fail(function() {
            console.log('error');
        });
    }

    $(document).on('change', '#subDivision', function() {
        var subDivision = $(this).val();

        getBlockMunicipalityVal(subDivision, '');
        
        
    });

    function getBlockMunicipalityVal(subDivision , block){

        $.ajax({
            url: "student_profile/std_registration/getMunicipality/" + subDivision,
            dataType: "JSON",
        })
        .done(function(res) {

            var html = '<option value=""> select Municipality </option>';
            for(var i=0; i< res.length; i++){
                if(block == res[i].block_municipality_id_pk){
                    var sel = "selected";
                }else{
                    sel = '';
                }
                html += '<option '+sel+' value="'+res[i].block_municipality_id_pk+'" >'+res[i].block_municipality_name+' </option>'
                
            }
            $('#municipality').html(html);
        })
        .fail(function() {
            console.log('error');
        });
    }

    $(document).on('change', '#caste_id', function() {
        if ($(this).val() != 1) {
            $('.caste_doc_div').show();
        } else {
            $('.caste_doc_div').hide();
        }
    });
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        var log = numFiles > 1 ? numFiles + ' files selected' : label;
        $(this).parents('.input-group').find(':text').val(log);
    });
    $(document).on('change', '#phy_challenged', function() {
        if ($(this).val() == 1) {
            $('.phy_challenged_doc_div').show();
        } else {
            $('.phy_challenged_doc_div').hide();
        }
    });

    $('#fullmark').on('input', function() {
        calculate();
      });
      $('#marks_obtain').on('input', function() {
       calculate();
      });
    function calculate(){
        var fullmark = parseInt($('#fullmark').val()); 
        var marks_obtain = parseInt($('#marks_obtain').val());
		var exam_type_id = parseInt($('#exam_type_id').val());
        var perc="";
        if(isNaN(fullmark) || isNaN(marks_obtain)){
            perc=" ";
        }else{
			perc = ((marks_obtain/fullmark) * 100).toFixed(3);
		}
			
		if(exam_type_id == 2 || exam_type_id == 3){
            if(perc <30){
                $('.edu_save_btn').hide();
                
                $('.blink_text').show();
            }else{
                $('.edu_save_btn').show();
                $('.blink_text').hide();
            }
        }else if(exam_type_id == 1){
			if(perc <25){
                $('.edu_save_btn').hide();
                
                $('.blink_text').show();
            }else{
                $('.edu_save_btn').show();
                $('.blink_text').hide();
            }
		}

        $('#percentage').val(perc);
    }
    $("#fullmark, #marks_obtain").on("keyup", function() {
        var fullmark = $("#fullmark").val();
        var marks_obtain = $("#marks_obtain").val();
        if (Number(marks_obtain) > Number(fullmark)) {
            // alert("Second value should less than first value");
            Swal.fire('Obtain marks value should less than to value of Full marks')
            return true;
        }
    });
	
	

    //confirmation Final Submit
	$('.confirm_final_submit').click(function(){
        var cen_hash = $(this).attr('rel');
        alert(cen_hash);
		var url = 'student_profile/std_registration/ajax_confirm_final_submit/'+cen_hash;
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
		var url = 'student_profile/std_registration/ajax_confirm_final_submit_button/'+c_id_hash;
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
						$(".remove_body").html('<div class="alert alert-success">Student Application Final Submited Successfully</div>');
						//$("#trainer_"+id_hash).remove();
						$('.c1').remove();
						$(".remove_btn_no").hide();
						$("#close_btn").show();
						setTimeout(function(){ location.reload(); }, 2000);

						
					} 
					else 
					{
						//csrf=obj.csrf_token;
						$(".remove_body").html('<div class="alert alert-warning">Student Application Final Submite Failed</div>');
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
	
	 $("#phy_marks").on("keyup", function() {
        var phy_marks = $("#phy_marks").val();
       
        if(phy_marks !=''){
            if ((Number(phy_marks) < 30)) {
                // alert("Second value should less than first value");
                Swal.fire('Physics Marks value should be equal or greater than 33')
                return true;
            }
        }
        
    });

    $("#chem_marks").on("keyup", function() {
        var chem_marks = $("#chem_marks").val();
        if(chem_marks !=''){
            if ((Number(chem_marks) < 30)) {
                // alert("Second value should less than first value");
                Swal.fire('Chemistry Marks value should be equal or greater than 33')
                return true;
            }
        }
        
    });

    $("#math_bio_marks").on("keyup", function() {
        var math_bio_marks = $("#math_bio_marks").val();
        if(math_bio_marks !=''){
            if (Number(math_bio_marks) < 30) {
                // alert("Second value should less than first value");
                Swal.fire('Mathemetics/Biology Marks value should be equal or greater than 33')
                return true;
            }
        }
        
    });

    $('#basic_details').on('submit', function(e){
        
        e.preventDefault();
        var fullmark = $('#fullmark').val();
          // alert(fullmark);
        var marks_obtain = $('#marks_obtain').val();

        var phy_marks = $("#phy_marks").val();
        var chem_marks = $("#chem_marks").val();
        var math_bio_marks = $("#math_bio_marks").val();
		var exam_type_id = $('#exam_type_id').val();
        if (Number(marks_obtain) > Number(fullmark)) {
            // alert("Second value should less than first value");
            Swal.fire('Obtain marks value should less than to value of Full marks')
            return false;
        }
		
		else
        {

            this.submit();
		}
		
        
            
      
    });
	
	// Bangla sikha Reg No Added by Moli on 13-02-2023
    var page = $('#page').val();
    if(page == 'basic_page'){
        var basic_save_status = $('#basic_save_status').val();
        if(basic_save_status == 0){
            var bengShikshaRegNo = $('#bengShikshaRegNo').val();
            var validate_error = $('#validate_error').val();

            if(validate_error == 0){
                if(!$('#submit-btn').data('clicked')) {
                    if(bengShikshaRegNo !=''){

                        gettingDataFromBengShikshaRegNo(bengShikshaRegNo);
                    }
                }
            }
            
        }
    }

    $(document).on('blur', '#bengShikshaRegNo', function() {

        var bengShikshaRegNo = $(this).val();
        var dob = $this('#dob').val();
        if(dob ==''){

            gettingDataFromBengShikshaRegNo(bengShikshaRegNo);
        }
    });
    function buildFirstMiddleLastList (list) {
        const { 0: first, [list.length - 1]: last, ...rest } = list;
      
        return [
            first, 
            Object.values(rest).toString().replaceAll(',', ' '), 
            list.length > 1 ? last : undefined
        ];
      };

    function gettingDataFromBengShikshaRegNo(bengShikshaRegNo){
        if (bengShikshaRegNo != '') {
            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data From Bangla Shiksha Registration No.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {

                        $.ajax({
                                url: "student_profile/std_registration/getBanglashikhshaStudentDetails/" + bengShikshaRegNo,
                                type: 'GET',
                                dataType: "json",
                            })
                            .done(function(res) {
                                if (res != '') {
                                    console.log(res);
                                    $('#father_name').val(res.fatherName);
                                    $('#guardian_name').val(res.guardianName);
                                    $('#aadhar_no').val(res.aadhaarNumber);
                                    $('#mob_no').val(res.stuMobile);

                                    $('#state option[value="'+res.state+'"]').attr("selected", "selected");
                                    getDistrictVal(res.state, res.district);
                                    getSubDivisionVal(res.district, res.subdivision);
                                    getBlockMunicipalityVal(res.subdivision,res.block);

                                    $('#pinCode').val(res.stuContactPin);

                                    $('#citizenship option[value="'+res.nationality+'"]').attr("selected", "selected");
                                    $('#caste_id option[value="'+res.caste+'"]').attr("selected", "selected");
                                    $('#religion_id option[value="'+res.religion+'"]').attr("selected", "selected");
                                    $('#gender option[value="'+res.gender+'"]').attr("selected", "selected");
                                    // $('#phy_challenged option[value="'+res.phy_challenged+'"]').attr("selected", "selected");

                                    $('#dob').val(res.date_of_birth);

                                    var nameArr = res.fullname;
                                    nameArr = nameArr.split(' ');
                                    var [fname, mname, lname] = buildFirstMiddleLastList(nameArr);
                                    $('#fname').val(fname);
                                    $('#mname').val(mname);
                                    $('#lname').val(lname);

                                    Swal.close();
                                } else {
                                    $('#district').val('');
                                    // $('#vtcName').val('');
                                    Swal.fire('Warning!', 'Data Not Found', 'warning');
                                }
                            })
                            .fail(function(res) {
                                $('#district').val('');
                                // $('#vtcCode').val('');
                                Swal.fire('Warning!', 'Data Not Found', 'warning');
                            });

                    }, 100);
                }
            });
        }
    }
	
	//Aded by Abhijit on 21-03-2023
	 $(document).on('change','#exam_type_id', function(){
		var exam_type_id = $(this).val();
		  //alert(exam_type_id);
		var vtc_code = $('#instituteCode').val();
        // alert(vtc_code);
		if(exam_type_id!='' && vtc_code!=''){
			getInstituteWiseCourseName(vtc_code,exam_type_id)
		}
	});

    function getInstituteWiseCourseName(vtc_code,exam_type_id){
        if(vtc_code !=''){
            $.ajax({
                url: "student_profile/std_registration/getCourseByInsCode",
                type: 'GET',
                dataType: "json",
                data: {vtc_code : vtc_code , exam_type_id : exam_type_id}
            })
            .done(function(res) {
                var html = '';
				console.log(res.length);
				if(res.length != 0){
					for(var i=0; i< res.length; i++){
					   
						html += '<option value="'+res[i].discipline_id_pk+'" >'+res[i].discipline_name+'['+res[i].discipline_code+'] </option>'
						
					}
				}else{
					html += '<option value="">No Data Found </option>'
				}

                $('#course_id').html(html);
               
            })
            .fail(function() {
                console.log('error');
            });
        }
    }
    
});