$(document).ready(function() {
    // alert("hiii");

        $('#editable-sample').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 50,
            "ajax": {
            "url": "poly_institute/institute_list/get_institute_list",
            "dataType": "json",
            "type": "GET",
            
            },
    
            
    
            "columns": [{
                "data": "sl_no"
            },
            {
                "data": "institute_code"
            },
			
			{
                "data": "institute_type"
            },

            {
                "data": "institute_name"
            },
            {
                "data": "institute_category"
            },

            {
                "data": "available_student"
            },
            
            {
                "data": "action"
            }
            ],
            // "preDrawCallback": function(settings) {
            //   $('#chk_all').prop('checked', false);
            // }
    
        });
    
    
    $('.select2').select2();

    // added by abhijit 07-03-2023

    $(document).on('change','#exam_type_id', function(){
		var exam_type_id = $(this).val();
		 //  alert(exam_type_id);
		var vtc_code = $('#instituteCode').val();
        //  alert(vtc_code);
		if(exam_type_id!='' && vtc_code!=''){
			getInstituteWiseCourseName(vtc_code,exam_type_id)
		}
	});

    function getInstituteWiseCourseName(vtc_code,exam_type_id){
        if(vtc_code !=''){
            $.ajax({
                url: "poly_institute/institute_list/getCourseByInsCode",
                type: 'GET',
                dataType: "json",
                data: {vtc_code : vtc_code , exam_type_id : exam_type_id}
            })
            .done(function(res) {
                var html = '';
                for(var i=0; i< res.length; i++){
                   
                    html += '<option value="'+res[i].discipline_id_pk+'" >'+res[i].discipline_name+'['+res[i].discipline_code+'] </option>'
                    
                }

                $('#course_id').html(html);
               
            })
            .fail(function() {
                console.log('error');
            });
        }
    }

    $(document).on('change', '#citizenship', function() {
        if ($(this).val() != 1) {
            $('.citizenship_doc_div').show();
        } else {
            $('.citizenship_doc_div').hide();
        }
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
                url: "poly_institute/institute_list/getDistrict/" + state,
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
            url: "poly_institute/institute_list/getSubDivision/" + district,
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
            url: "poly_institute/institute_list/getMunicipality/" + subDivision,
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
                                url: "poly_institute/institute_list/getBanglashikhshaStudentDetails/" + bengShikshaRegNo,
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


    $(document).on('change','#exam_type_id', function(){
		var exam_type_id = $(this).val();
		
        if (exam_type_id == 3 ) {
            $('#marks_submit_div').show();
        } else {
            $('#marks_submit_div').hide();
        }
    });

    
    // $('.datepicker').datepicker({
	// 	autoclose: true,
	// 	format: 'dd-mm-yyyy',
		
	// });
    // $("#std_dob").datepicker({
	// 	autoclose: true,
	// 	format: 'mm/dd/yyyy',
		
	// });
    $('#std_dob').datepicker({
        format: 'mm/dd/yyyy',
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        
    });


    $("#vtcName").autocomplete({
       
        source: function (request, response) {
            $.ajax({
                url: "poly_institute/institute_list/getVtcDetailsByName",
                type : "GET",
                dataType: "json",
                data: {
                    vtc_name : request.term
                   
                },
                success: function (data) {console.log(data);
                    response(data);
                  //response(data.id);
                }
            });
        },
        minLength: 3,        
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            $('.ui-helper-hidden-accessible').hide();
        },
        close: function () {
             //alert($(this).val());
            var vtc_name = $(this).val().split(',');
         //alert(vtc_name);
            
            
			var exam_type_id = $('#exam_type_id').val();
            getInstituteWiseCourseName(vtc_name[1],exam_type_id);
            
            $(this).val(vtc_name[0]);
            $('#instituteCode').val(vtc_name[1]);
			$('#ins_category').val(vtc_name[2]); //Added by Moli on 14-02-2023
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            $('.ui-helper-hidden-accessible').hide();
        }
    });

    $(document).on('click', '.re-approve-modal', function() {
      // debugger;
        // alert('hii');

        // var id_hash = $(this).closest('tr').prop('id');
        var id_hash = $(this).attr('data-id');
       //  alert(id_hash);
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.re-approve-data').html(loader);

        $.ajax({
                url: "poly_institute/institute_list/showreApproved/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.re-approve-data').html(response);
            })
            .fail(function(res) {
                $('#re-approve-modal').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get Student data.', 'error');
            });


    });

    $(document).on('click', '.reapprove_btn', function(e) {

        $(".reject-btn").hide();

        // debugger;

        $("#div_class").attr("style", "display:none");
       // $("#approve_div").attr("style", "display:block");
        e.preventDefault();
        var error = 0;

        $('#status').val(1);
       
            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to approve this student.',
                text: "You will not able to revert it back.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Do it!',
                allowEscapeKey: false,
                allowOutsideClick: false
            }).then((result) => {
    
                if (result.isConfirmed) {
                    $("#reapprove").submit();
    
                }
            })
        

        

    })


    // $(document).on('click', '.reapprove-btn', function(e) {

    //     // alert('hi');
    //     debugger;
    //     $(".reject-btn").hide();

    //     $("#div_class").attr("style", "display:none");
    //    //  $("#approve_div").attr("style", "display:block");
    //     e.preventDefault();
    //     var error = 0;

    //     $('#status').val(1);
        
    //         Swal.fire({
    //             title: 'Warning!<br>Are you sure? You want to  reapprove this student.',
    //             text: "You will not able to revert it back.",
    //             icon: 'question',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: 'Yes, Do it!',
    //             allowEscapeKey: false,
    //             allowOutsideClick: false
    //         }).then((result) => {
    
    //             if (result.isConfirmed) {
    //                 $("#reapprove").submit();
    
    //             }
    //         })
    //    // }

        

    // })


    $(document).on('click', '.modal-reject-note', function() {
        // alert('hi');
        // var id_hash = $(this).closest('tr').prop('id');
        // debugger;
        var id_hash = $(this).attr('data-id');

        // alert(id_hash);
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.reject-note-data').html(loader);

        $.ajax({
                url: "poly_institute/institute_list/getRejectNote/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.reject-note-data').html(response);
            })
            .fail(function(res) {
                $('#modal-reject-note').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get Student data.', 'error');
            });


    });
	
	$(document).on('click', '.changeStatus', function(){
       
		// alert ('hello');
		var tr_id  = $(this).closest('tr').prop('id'),
		buttonName = $(this).attr('data-name'),
		self = this;
		
		var updateStatus = successText = buttonText = $td_action = $td_status = '';

		if(buttonName == 'Activate')
		{
			updateStatus  = 1;
			successText   = 'Activated';
			buttonText    = 'Yes, Activate it!';
		} 
		else 
		{
			updateStatus  = 0;
			successText   = 'Deactive';
			buttonText    = 'Yes, Deactive it!';
		}

		Swal.fire({
			title: 'Are you sure?',
			text: "You want to "+buttonName+" this Student.!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: buttonText
		}).then((result) => {
			if (result.isConfirmed) {
				
				$.ajax({
					url: "poly_institute/institute_list/changeActiveDeactiveStatus/"+tr_id,
					type: 'GET',
					dataType: "json",
					data: {updateStatus: updateStatus}
				})
				.done(function(response) {
					if(response =='done'){
					
						if(buttonName == 'Activate')
						{
							$("#"+tr_id).find("td:last").prev().find("small").removeClass('label-danger').addClass('label-success').text('Activate');
							$(self).removeClass('btn-success').addClass('btn-danger').attr("data-name", "Deactivate");
						} 
						else 
						{
							$("#"+tr_id).find("td:last").prev().find("small").removeClass('label-success').addClass('label-danger').text('Deactivate');
							$(self).removeClass('btn-danger').addClass('btn-success').attr("data-name", "Activate");
						}
						
						Swal.fire(successText+'!', 'Student has been '+successText+'.', 'success');
					}else{
						Swal.fire('Error!', 'Oops! Data Not Updated at this momment', 'error'); 
					}
				})
				.fail(function(res) {
					Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
				});
			}
		});

	});
/* ADDED BY AVIJIT ON 20-03-2023 */
 $(document).on('click','.std_reg_certificate_btn_old',function(){
        
        var institute_id_fk = $("#institute_id_fk").val();
         // alert(institute_id_fk);

        Swal.fire({
            title: 'Genarate Registration Certificate Number?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Genarate!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'We\'ll Genarate Registration Certificate Number.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                url: "poly_institute/institute_list/genarate_student_reg_certificate",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { 'institute_id_fk': institute_id_fk },
                                })
                                .done(function(response) {
                                    if (!response.ok) {

                                        Swal.fire('Error!', response.msg, 'error');
                                    } else if (response.ok == 1) {

                                        
                                        Swal.fire('Success!', response.msg, 'success');
                                    } else {

                                        Swal.fire('Warning!', response.msg, 'warning');
                                    }
                                    console.log(response);
                                })
                                .fail(function(res) {
                                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                                });
                        }, 1000);

                        /* setTimeout(function () {
                            Swal.close()
                        }, 1000); */

                    }
                })

            }
        })
    })
// end 14-03-23

// 23-03-2023
// abhijit added by 14-03-2023

    $(document).on('click','.std_reg_certificate_btn',function(){
        
        var institute_id_fk = $("#institute_id_fk").val();
         // alert(institute_id_fk);

        Swal.fire({
            title: 'Genarate Registration Certificate Number for 1st Year?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Genarate!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'We\'ll Genarate Registration Certificate Number for 1st Year.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                url: "poly_institute/institute_list/genarate_student_reg_certificate",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { 'institute_id_fk': institute_id_fk },
                                })
                                .done(function(response) {
                                    if (!response.ok) {

                                        Swal.fire('Error!', response.msg, 'error');
                                    } else if (response.ok == 1) {

                                        
                                        Swal.fire('Success!', response.msg, 'success');
                                    } else {

                                        Swal.fire('Warning!', response.msg, 'warning');
                                    }
                                    console.log(response);
                                })
                                .fail(function(res) {
                                    Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                                });
                        }, 1000);

                        /* setTimeout(function () {
                            Swal.close()
                        }, 1000); */

                    }
                })

            }
        })
    })
// end 14-03-23

// abhijit added by 22-03-2023

$(document).on('click','.std_reg2_certificate_btn',function(){
        
    var institute_id_fk = $("#institute_id_fk").val();
     // alert(institute_id_fk);

    Swal.fire({
        title: 'Genarate Registration Certificate Number for 2nd Year?',
        text: "You won't be able to revert this!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Genarate!',
        allowEscapeKey: false,
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll Genarate Registration Certificate Number for 2nd Year.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {
                        $.ajax({
                            url: "poly_institute/institute_list/genarate_student_2nd_yr_reg_certificate",
                                type: 'GET',
                                dataType: "json",
                                data: { 'institute_id_fk': institute_id_fk },
                            })
                            .done(function(response) {
                                if (!response.ok) {

                                    Swal.fire('Error!', response.msg, 'error');
                                } else if (response.ok == 1) {

                                    
                                    Swal.fire('Success!', response.msg, 'success');
                                } else {

                                    Swal.fire('Warning!', response.msg, 'warning');
                                }
                                console.log(response);
                            })
                            .fail(function(res) {
                                Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                            });
                    }, 1000);

                    /* setTimeout(function () {
                        Swal.close()
                    }, 1000); */

                }
            })

        }
    })
})
// end 22-03-23


//Added by moli on 23-05-2023
$(document).on('click', '.cancel_reg_modal', function() {


    // var id_hash = $(this).closest('tr').prop('id');
    var id_hash = $(this).attr('data-id');
   // alert(id_hash);
    var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

    $('.std_reg_data').html(loader);

    $.ajax({
            url: "poly_institute/institute_list/showCancelRegModal/" + id_hash,
            type: 'GET',
            dataType: "json",
        })
        .done(function(response) {
            $('.std_reg_data').html(response);
        })
        .fail(function(res) {
            $('#cancel_reg_modal').modal('toggle');
            Swal.fire('Error!', 'Oops! Unable to get Student data.', 'error');
        });


});

$(document).on('click', '.reg_cancel_btn', function(e) {

    
    e.preventDefault();
    var error = 0;

    $('#status').val(1);
    var reject_note = $('#remarks').val();
    if (reject_note == '') {
        Swal.fire('This field is the required');

    }else{
        Swal.fire({
            title: 'Warning!<br>Are you sure? You want to cancel registration for this student.',
            text: "You will not able to revert it back.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Do it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {

            if (result.isConfirmed) {
                $("#reg_cancel_form").submit();

            }
        })
    }

    

})


    
    

});