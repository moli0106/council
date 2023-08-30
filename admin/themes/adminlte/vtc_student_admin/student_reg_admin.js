$(document).ready(function () {

    $(".genarate_vtc_reg_no").click(function () {
        var vtc_id = $(this).attr("data-vtc-id");
        var course_id = $(this).attr("data-course-id");
        alert(vtc_id);
        alert(course_id);

        if(vtc_id!='' && course_id!=''){

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
                                    url: "vtc_student_admin/student_reg_admin/genarate_student_reg_certificate",
                                        type: 'GET',
                                        dataType: "json",
                                        data: { 'vtc_id': vtc_id,'course_id':course_id },
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
        }
    })


    // add on 12-05-2023
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
            $('#kanyashree_no').val('');
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

    $(document).on('change', '#group_id', function() {

        var group_id = $(this).val();
        var course_name_id = $('#course_name_id').val();
        if(course_name_id == 4){
            getDuration(course_name_id , group_id);
        }

    });
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

    $("#total_marks, #aggregate_marks").on("keyup", function() {
        var total_marks = $("#total_marks").val();
        var aggregate_marks = $("#aggregate_marks").val();
        if (Number(aggregate_marks) > Number(total_marks)) {
            // alert("Second value should less than first value");
            Swal.fire('Aggregate marks value should less than to value of Total marks')
            return true;
        }
    });
    $(document).on('change', ':file', function () {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

		var log = numFiles > 1 ? numFiles + ' files selected' : label;
		$(this).parents('.input-group').find(':text').val(log);
	});

   
})