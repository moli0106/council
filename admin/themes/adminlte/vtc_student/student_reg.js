$(document).ready(function () {
	
    $(document).on('click','.print', function () {
        //alert(1111);
        $(".print_details").print(/*options*/);
    })

	$("#std-datepicker").datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true
	});

    

	$(document).on('change', ':file', function () {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

		var log = numFiles > 1 ? numFiles + ' files selected' : label;
		$(this).parents('.input-group').find(':text').val(log);
	});

	$(document).on('click', '.get-student-details', function (e) {

		var id_hash = $(this).prop('id');
		var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

		$('.student-data-div').html(loader);

		$.ajax({
			url: "vtc_student/student/details/" + id_hash,
			type: 'GET',
			dataType: "json",
		})
			.done(function (response) {
				$('.student-data-div').html(response);

				$("#std-datepicker").datepicker({
					format: 'dd/mm/yyyy',
					autoclose: true
				});
			})
			.fail(function (res) {
				$('#modal-student-details').modal('toggle');
				Swal.fire('Error!', 'Oops! Unable to get student details.', 'error');
			});
	});

	// $(document).on('change', '#district', function () {

	// 	var district = $(this).val();
	// 	Swal.fire({
	// 		title: 'Please wait a moment!',
	// 		html: 'loading data...',
	// 		allowEscapeKey: false,
	// 		allowOutsideClick: false,
	// 		didOpen: () => {
	// 			Swal.showLoading();

	// 			$.ajax({
	// 				url: "vtc_student/student/getMunicipalityList/" + district,
	// 				dataType: "json",
	// 			})
	// 				.done(function (res) {
	// 					$('#municipality').html(res);
	// 					Swal.close();
	// 				})
	// 				.fail(function (res) {
	// 					Swal.fire('Warning!', 'Oops! Unable to get Block, Please try later.', 'warning');
	// 				});
	// 		}
	// 	});
	// });

	$(document).on('change', '#stdSector', function () {

		var stdSector = $(this).val();
		Swal.fire({
			title: 'Please wait a moment!',
			html: 'loading data...',
			allowEscapeKey: false,
			allowOutsideClick: false,
			didOpen: () => {
				Swal.showLoading();

				$.ajax({
					url: "vtc_student/student/getCourseList/" + stdSector,
					dataType: "json",
				})
					.done(function (res) {
						$('#stdCourse').html(res);
						Swal.close();
					})
					.fail(function (res) {
						Swal.fire('Warning!', 'Oops! Unable to get Course list, Please try later.', 'warning');
					});
			}
		});
	});

	$(document).on('click', '#update-student-profile', function () {
		Swal.fire({
			title: 'Warning!<br>Are you sure?',
			text: "You want to update student profile.",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Do it!',
			allowEscapeKey: false,
			allowOutsideClick: false
		}).then((result) => {
			if (result.isConfirmed) {

				Swal.fire({
					title: 'Please wait a moment!',
					allowEscapeKey: false,
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();
						$('#update-student-info-form').submit();
					}
				});
			}
		});
	});

	$(document).on('click', '.delete-student', function () {
		Swal.fire({
			title: 'Are you sure?',
			text: "You want to delete this student!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {

				// $('#update-student-status').submit();
				var id_hash = $('.std_id_hash').val();

				$.ajax({
					url: "vtc_student/student/remove_student/" + id_hash,
					type: 'GET',
					dataType: "json",
				})
					.done(function (response) {
						$('#' + id_hash).remove();
						$('#modal-student-details').modal('toggle');
						Swal.fire('Success!', 'Student has been removed.!', 'success');
					})
					.fail(function (res) {
						$('#modal-student-details').modal('toggle');
						Swal.fire('Error!', 'Oops! Unable to remove student.', 'error');
					});
			}
		})
	});

	//------------------------- Moli on 26-08-2022 ---------------------//


	$(document).on('change', '#academic_year', function() {
        
        // alert("hiii");
        $('#vtc_search_form').submit();
        
    });

    //added by moli on 01-06-2023
    $(document).on('change', '#batch_no', function() {
        
        // alert("hiii");
        $('#vtc_search_form').submit();
        
    });

    var selected_year = $('#selected_year').val();
    var batch_no = $('#batch_no').val();
    // alert (selected_year);
    // alert (batch_no);
        $('#editable-sample').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 50,
            "ajax": {
            "url": "vtc_student/student_reg/get_list",
            "dataType": "json",
            "type": "GET",
            "data": {
                //'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'selected_year':selected_year,
                'batch_no' : batch_no
            }
            },
    
            
    
            "columns": [{
                "data": "sl_no"
            },
            {
                "data": "std_name"
            },
            {
                "data": "father_name"
            },
            // {
            //     "data": "email"
            // },
            // {
            //     "data": "aadhar_no"
            // },
            
            // {
            //     "data": "mobile_no"
            // },
            {
                "data": "reg_year"
            },
            // {
            //     "data": "dob"
            // },
            {
                "data": "course_name"
            },
			{
                "data": "group_name"
            },
			{
                "data": "group_code"
            },
			{
                "data": "status"
            },
			{
                "data": "action"
            }
            ]
    
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
                url: "vtc_student/student_reg/getDistrict/" + state,
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

	// $(document).on('change', '#district', function() {
        // var district = $(this).val();

        // $.ajax({
                // url: "vtc_student/student_reg/getSubDivision/" + district,
                // dataType: "JSON",
            // })
            // .done(function(res) {
                // $('#subDivision').html(res.subDivisionHtml);
                // $('#nodal_id_fk').html(res.nodalOfficerHtml);
            // })
            // .fail(function() {
                // console.log('error');
            // });
    // }); 
	
	
	$(document).on('change', '#district', function() {
        var district = $(this).val();
        // alert(district);
        getSubDivisionVal(district,'');
       
    });

    function getSubDivisionVal(district , subdiv){
        $.ajax({
            url: "vtc_student/student_reg/getSubDivision/" + district,
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

	// $(document).on('change', '#subDivision', function() {
        // var subDivision = $(this).val();

        // $.ajax({
                // url: "vtc_student/student_reg/getMunicipality/" + subDivision,
                // dataType: "JSON",
            // })
            // .done(function(res) {
                // $('#municipality').html(res);
            // })
            // .fail(function() {
                // console.log('error');
            // });
    // });
	
	$(document).on('change', '#subDivision', function() {
        var subDivision = $(this).val();

        getBlockMunicipalityVal(subDivision, '');
        
        
    });

    function getBlockMunicipalityVal(subDivision , block){

        $.ajax({
            url: "vtc_student/student_reg/getMunicipality/" + subDivision,
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

    $(document).on('change', '#religion_id', function() {
        if ($(this).val() == 4) {
            $('.other_religion_div').show();
        } else {
            $('.other_religion_div').hide();
        }
    });

    $(document).on('change', '#phy_challenged', function() {
        if ($(this).val() == 1) {
            $('.phy_challenged_doc_div').show();
        } else {
            $('.phy_challenged_doc_div').hide();
        }
    });

	// $('#dob').datepicker({
	// 	format: 'dd/mm/yyyy',
    //     autoclose: true
		
	// });

    var start = new Date();
    start.setFullYear(start.getFullYear() - 70);
    var end = new Date();
    end.setFullYear(end.getFullYear() - 12);

    $('#dob').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        startDate: start,
        endDate: end,
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

    $('#total_marks').on('input', function() {
        calculate();
      });
      $('#aggregate_marks').on('input', function() {
       calculate();
      });
      function calculate(){
          var total_marks = parseInt($('#total_marks').val()); 
          var aggregate_marks = parseInt($('#aggregate_marks').val());
          var perc="";
          if(isNaN(total_marks) || isNaN(aggregate_marks)){
              perc=" ";
             }else{
             perc = ((aggregate_marks/total_marks) * 100).toFixed(3);
             }
  
          $('#percentage_marks').val(perc);
    }

    $(document).on('change', '#course_name_id', function() {
        
        if ($(this).val() == 4 ) {
            $('.batch_duration_div').show();

            $('.stc_last_exam_div').show();
            $('.HSVoc_last_exam_div').hide();
            // $('.stc_last_exam_div').find('input:number').each(function() {
            //     $(this).val('');
            // });

            $('.stc_last_exam_div').find(':input').each(function() {
                switch(this.type) {
                    
                    case 'number':
                    
                        $(this).val('');
                        break;
                    
                    case 'radio':
                        this.checked = false;
                        break;
                }
              });
              $('.stc_reg_div').hide();
              $('.marksheet_btn').hide();
            
        } else {
            $('.batch_duration_div').hide();

            $('.stc_last_exam_div').hide();
            $('.HSVoc_last_exam_div').show();

            $('#last_exam_id').val('');

           
        }

        var vtc_code = $('#vtcCode').val();
        var course_name_id = $(this).val();

        $.ajax({
            url: "vtc_student/student_reg/getGroupName/" + course_name_id,
            type: 'GET',
            data: {vtc_code : vtc_code},
            dataType: "JSON",
        })
        .done(function(res) {
            $('#group_id').html(res);
        })
        .fail(function() {
            console.log('error');
        });

    });

    $(document).on('click', '.approve-reject-modal', function() {


        // var id_hash = $(this).closest('tr').prop('id');
        var id_hash = $(this).attr('data-id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.approve-reject-data').html(loader);

        $.ajax({
                url: "vtc_student/student_reg/showApproveRejectModal/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.approve-reject-data').html(response);
				//return false;
            })
            .fail(function(res) {
                $('#approve-reject-modal').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get vtc data.', 'error');
				return false;
            });


    });

    $(document).on('click', '.reject-btn', function(e) {

        $(".approve-btn").hide();
        $("#div_class").attr("style", "display:block");
        e.preventDefault();
        var error = 0;
        var remarksVal = $('textarea#remarks').val();
        $('#status').val(0);
        if (remarksVal != '') {

            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to reject this student.',
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
                    $("#approve_reject_form").submit();
					
                }
            })
        } else {
            Swal.fire('Remarks field is the required');
        }

    });

    $(document).on('click', '.approve-btn', function(e) {

        $("#div_class").attr("style", "display:none");
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
                $("#approve_reject_form").submit();

            }
        })

    })

    $(document).on('click', '.modal-reject-note', function() {


        // var id_hash = $(this).closest('tr').prop('id');
        var id_hash = $(this).attr('data-id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.reject-note-data').html(loader);

        $.ajax({
                url: "vtc_student/student_reg/getRejectNote/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.reject-note-data').html(response);
            })
            .fail(function(res) {
                $('#modal-reject-note').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get vtc data.', 'error');
            });


    });

    $(document).on('change', '#group_id', function() {

        var group_id = $(this).val();
        var course_name_id = $('#course_name_id').val();
        if(course_name_id == 4){
            getDuration(course_name_id , group_id);
        }

        //Modify by moli on 17-05-2023
        checkRegNo(group_id);

    });

    function checkRegNo(group_id) {
        
        $.ajax({
            url: "vtc_student/student_reg/checkRegNo/" + group_id,
            type: 'GET',
            //data: {group_id : group_id},
            dataType: "JSON",
        })
        .done(function(res) {
            if(res.reg_no = 'Yes'){
                $('.std_reg_submit_btn').hide();
            }else{
                $('.std_reg_submit_btn').show();
            }
        })
        .fail(function() {
           // console.log('error');
        });
    }


    function getDuration(course_name_id , group_id) {
        
        $.ajax({
            url: "vtc_student/student_reg/getDuration/" + course_name_id,
            type: 'GET',
            data: {group_id : group_id},
            dataType: "JSON",
        })
        .done(function(res) {
            // $('#batch_duration').html(res);
            $('#batch_duration').val(res.duration);
        })
        .fail(function() {
           // console.log('error');
        });
    }

    $('input:radio[name="haveRegisterNo"]').change(function() {
        if ($(this).val() == 1) {
            $('.stc_reg_div').show();
        } else {
            $('.stc_reg_div').hide();
            $('#old_reg_no').val('');
            $('#old_reg_year').val('');
        }
    });
    $('input:radio[name="haveHSRegisterNo"]').change(function() {
        if ($(this).val() == 1) {
            $('.hs_reg_div').show();
        } else {
            $('.hs_reg_div').hide();
            $('#old_reg_no').val('');
            $('#old_reg_year').val('');
        }
    });

    $('input:radio[name="haveSHSPassed"]').change(function() {
        if ($(this).val() == 1) {
            $('.eligable_text').show();
            $('.std_reg_submit_btn').hide();
        } else {
            $('.eligable_text').hide();
            $('.std_reg_submit_btn').show();
        }
    });

    $(document).on('change', '#school_state', function() {

        var state = $(this).val();
        if(state == 19){
            $('.migrate_certificate_div').hide();
        }else{
            $('.migrate_certificate_div').show();
        }
    });

    $('input:radio[name="register_hs_course"]').change(function() {
        var register_hs_course = $(this).val();
        if(register_hs_course == 0){
            $('.transfer_certificate_div').hide();
        }else{
            $('.transfer_certificate_div').show();
        }
    });

    $(document).on('change', '#citizenship', function() {
        if ($(this).val() != 1) {
            $('.citizenship_doc_div').show();
        } else {
            $('.citizenship_doc_div').hide();
        }
    });

    // $(document).on('change', '#state', function() {
        // var state = $(this).val();

        // if(state == 19){
            // $('.other_state_div').show();
        // }else{
            // $('.other_state_div').hide();
        // }

        // $.ajax({
                // url: "vtc_student/student_reg/getDistrict/" + state,
                // dataType: "JSON",
            // })
            // .done(function(res) {
                // $('#district').html(res);
               
            // })
            // .fail(function() {
                // console.log('error');
            // });
    // });

    $("#total_marks, #aggregate_marks").on("keyup", function() {
        var total_marks = $("#total_marks").val();
        var aggregate_marks = $("#aggregate_marks").val();
        if (Number(aggregate_marks) > Number(total_marks)) {
            // alert("Second value should less than first value");
            Swal.fire('Aggregate marks value should less than to value of Total marks')
            return true;
        }
    });

    // Payment Section 11-04-2023

    $(document).on('click', '.pay_vtc_std_exam_fee', function(e) {

        
        var isChecked = $('.checkStd').is(':checked');
        if (isChecked == false) {
            Swal.fire('Warning!', 'Oops! Please checked atleast one student.', 'warning');
        } else {

            var stdIdArray = [];
            $.each($("input[name='std_id_pk']:checked"), function() {
                stdIdArray.push($(this).val());
            });
            alert("My favourite std_id_pk are: " + stdIdArray);
            
            //modify on 12-04-2023
            var countCheckedCheckboxes = $("input[name='std_id_pk']:checked").length;
            var totalStudent = $("#std_cnt").val();

            if(totalStudent == countCheckedCheckboxes){
                var msg = ''
            }else{
                var msg = 'You have not selected all candidate,'
            }

            if(stdIdArray.length > 50){
                Swal.fire('Warning!', 'Oops! checked no of 20 students at a time.', 'warning');
            }else{
                if(stdIdArray){

                    Swal.fire({
                        title: msg +'Are you sure?You want to eligible these students!',
                        text: "You will not able to revert it back.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, eligible it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Please wait a moment!',
                                html: 'We\'ll saving your Data.',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                
                                    setTimeout(function() {

                                        $.ajax({
                                            url: "vtc_student/student_reg/readyForExam",
                                            data: {
                                                stdIdArray: stdIdArray
                                                
                                            },
                                            type: 'GET',
                                            dataType: "json",
                                        })
                                        .done(function(response) {
											if(response == 'done'){
                                            Swal.fire('Success!', 'Successfully Eligible for examination.', 'success');
                                            location.reload();
											}else{
												Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
											}
                                        })
                                        .fail(function(res) {
                                            
                                            Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                                        });

                                    })
                                }
                            })
                        }
                    })
                }
            }

           

        }
    });
    // Payment Section
	
	
	$(document).on('blur', '#bengShikshaRegNo', function() {

        var bengShikshaRegNo = $(this).val();
        
        

        gettingDataFromBengShikshaRegNo(bengShikshaRegNo);
        
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
                                url: "vtc_student/student_reg/getBanglashikhshaStudentDetails/" + bengShikshaRegNo,
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

    $(document).on('click','.std_reg_submit_btn',function() {
        // alert('hii');
        
        $('.std_reg_submit_btn').hide();
        Swal.fire({
            title: 'Please wait a moment!',
            html: 'We\'ll collecting the data From Bangla Shiksha Registration No.',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        })
    })
	event.preventDefault();


    // added by abhijit 15-03-2023,



});