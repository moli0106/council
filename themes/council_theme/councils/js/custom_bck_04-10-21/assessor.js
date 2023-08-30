
$(document).ready(function(evt){
	$(document).on('change','.course', function () {

		var min_quali = "<b>1. Minimum educational qualification</b><br>B.E/B.Thch in Electrical Engineering or diploma in Electrical Engineering<br>"+
		"<b>2. Domain specific working experience</b><br>Diploma with 3 years experience/ TTI with 6 years experiance<br>"+
		"<b>3. Assessment experience</b><br>1 year desirable in the relevant course<br> <div class='clearfix'></div>";

		$(this).parent().parent().siblings( ".course_quali_view" ).html(min_quali);
	});
	/*if($('.table').attr("data-flag") == 0)
	{
		document.getElementById('sector_table').style.display = "none";	
	}*/
	$('[data-toggle="tooltip"]').tooltip();
	
	$('#dob').datepicker({
		startDate: '-1000y',
        endDate:'-18y',
		autoclose: true,
		format: 'dd/mm/yyyy'
		
		 });
		 
	});
$(document).on('change', ':file', function() {
	    var input = $(this),
	        numFiles = input.get(0).files ? input.get(0).files.length : 1,
	        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	    input.trigger('fileselect', [numFiles, label]);
	  });
 $(document).ready( function() {
	      $(':file').on('fileselect', function(event, numFiles, label) {

	          var input = $(this).parents('.input-group').find(':text'),
	              log = numFiles > 1 ? numFiles + ' files selected' : label;

	          if( input.length ) {
	              input.val(log);
	          } else {
	              if( log ) alert(log);
	          }

	      });
	    
	 	 
		
		/* newly addedd contents starts 21/08/2018 */
		$('#certified_no').click(function(){
				 
				if($('#certified_no').prop("checked") == true)
				{
					$('#certified_field_div').css('display','none');
					//certified_field_div.style.display = "none";
					$('#certified_flag').val('0');
					 
				}
				
			});
		$('#certified_yes').click(function(){
				
				if($('#certified_yes').prop('checked') == true)
				{
					$('#certified_field_div').css('display','block') ;
					$('#certified_flag').val('1') ;
				}
			});
			
		$('#same_present_addr').click(function(){
				var present_house = $('#house').val();
				var present_street_name = $('#street').val();
				var present_pincode = $('#pincode').val();
				var state = $('#state').val();
				var present_district = $('#district').val();
				var present_block = $('#block').val();
				var present_po = $('#po').val();
				var present_ps = $('#ps').val();
				var present_landline = $('#landline').val();
				var present_mobile_no = $('#mobile_no').val();
				var present_email = $('#email').val();
				var same_present_addr_checkbox = document.getElementById('same_present_addr');
				if($('#same_present_addr').prop('checked') == true)
				{
					$('#permanent_house').val(present_house) ;	
					$('#permanent_street').val(present_street_name) ;
					$('#permanent_pincode').val(present_pincode) ;
					$('#permanent_state').val(state) ;
					$('#permanent_district').val(present_district)  ;
					$('#permanent_po').val(present_po)  ;
					$('#permanent_ps').val(present_ps) ;
					
					if(state != "")
					{
						$.ajax({
							url: "assessor/Registration/districtByState",
							method: "GET",
							data: {state_id: state},
							dataType: 'json',
							success: function(resp)
									{
										for(var i = 0; i < resp.districts.length; i++)
										{
											 
												$('.permanent_district_append').remove();
											
										}
										$.each( resp.districts, function( key, value ) {
						
											$('#permanent_district').append("<option value='"+ value.district_id_pk +"' class='permanent_district_append'>"+ value.district_name +"</option>");
										});
										$('#permanent_district').val(present_district) ;
						
									},
							error: function(xhr)
									{
						
										 
									}
						});	
					}
					if(present_district != "")
					{
						$.ajax({
							url: "assessor/Registration/blockByDistrict",
							method: "GET",
							data: {districtId: present_district},
							dataType: 'json',
							success: function(resp)
									{
										for(var i = 0; i < resp.blocks.length; i++)
										{
											 
												$('.permanent_block_append').remove();
											
										}
										$.each( resp.blocks, function( key, value ) {
						
											$('#permanent_block').append("<option value='"+ value.block_municipality_id_pk +"' class='permanent_block_append'>"+ value.block_municipality_name +"</option>");
										});
										$('#permanent_block').val(present_block) ;
						
									},
							error: function(xhr)
									{
						
										 
									}
						});
						
						
					}
				}
				else
				{
					$('#permanent_state').val('');
					$('#permanent_house').val('');
					$('#permanent_street').val('');
					$('#permanent_pincode').val('') ;
					$('#permanent_district').val('');
					$('#permanent_block').val('') ;
					$('#permanent_po').val('') ;
				    $('#permanent_ps').val('');
					 
				}
			});
		
		$('.sector_type').change(function(){
			 $('.added_row').remove();
			 $('.courses').remove();
				if($('#sector_type').val() ==  '1' )
				{
					 
					var url = 'assessor/registration/add_wbscvt_sector_courses_state_council';
					var sectors = $('.sectors');
					$.ajax({
						url: url,
						dataType: 'json',
						beforeSend: function(){
							 
						},
						success: function(resp){
							 console.log(resp);
							for(var i = 0; i < sectors.length; i++)
								{
									 
										$('.sectors').remove();
									
								}
								$.each( resp.sectors, function( key, value ) {
									
									$('#industry_1').append("<option value='"+ value.sector_id_pk +"' class='sectors'>"+ value.sector_name +"(" + value.sector_code + ")</option>");
								});
							 
						}
					});
				}
				else
				{ 
				 
					var url = 'assessor/registration/add_wbscvt_sector_courses_ssc';
					var sectors = $('.sectors');
					$.ajax({
						url: url,
						dataType: 'json',
						beforeSend: function(){
							/*$(wrapper).append('<div class="row waiting"><div class="col-md-4"><div class="form-group"><label>Please Wait !!!</label></div></div></div>');*/
						},
						success: function(resp){
							 
							for(var i = 0; i < sectors.length; i++)
								{
									 
										$('.sectors').remove();
									
								}
								$.each( resp.sectors, function( key, value ) {
									 
				
									$('#industry_1').append("<option value='"+ value.sector_id_pk +"' class='sectors'>"+ value.sector_name + "(" + value.sector_code + ")</option>");
								});
						}
					});
				 }
			});
			
			
			
		var max_add_more = 20; //maximum input boxes allowed
		var wrapper = $("#wrapper_dynamic"); //Fields wrapper
		var add_button = $(".add_field_button"); //Add button ID
		 
		var x = 1; //initlal div box count
		$(add_button).click(function(e){
			 //on add input button click
			//var sector_flag = document.getElementById('sector_flag').value;
			e.preventDefault();
			var rnsl=$('#running_sl').val();
			if(rnsl>0)
			{
				x=rnsl;
			}
			if(x < max_add_more)
			{ //max input box allowed
				x++; //text box increment
				 if($('#sector_type').val() ==  '1' )
				{
					 
					var url = 'assessor/registration/add_wbscvt_sector_courses/'+x;
					$.ajax({
						url: url,
						beforeSend: function(){
							 
						},
						success: function(result){
							 
							$(wrapper).append(result);
							  
						}
					});
				}
				else
				{ 
				
					var url = 'assessor/registration/add_sector_courses/'+x;
					$.ajax({
						url: url,
						beforeSend: function(){
							/*$(wrapper).append('<div class="row waiting"><div class="col-md-4"><div class="form-group"><label>Please Wait !!!</label></div></div></div>');*/
						},
						success: function(result){
							 
							$(wrapper).append(result);
							//document.getElementById('sector_flag').value = +sector_flag + +1;
						}
					});
				 }
			}
			$('#running_sl').val(x);
		});
		 
		$(wrapper).on("click",".remove_field_button", function(e){ //user click on remove field
			e.preventDefault(); 
			//var sector_flag = document.getElementById('sector_flag').value;
			var id=$(this).attr('id');
			$('#rm_row_'+id).remove();
			x--;
			$('#running_sl').val(x);
			//document.getElementById('sector_flag').value = sector_flag - 1;
		});
		$(document).on('change','.sector_dpdw',function(evt){
			evt.preventDefault();
			var id=$(this).attr('id');
			var sector_id=$('#'+id).val();
			var select_serial_arr=id.split('_');
			var select_serial=select_serial_arr[1];
			 if($('#sector_type').val() == '1')
			{
				var url = 'assessor/registration/show_wbscvt_courses/'+sector_id;
				$.ajax({
					url: url,
					beforeSend: function(){
						 
					},
					success: function(result){
						$('#skill_'+select_serial).html(result);
					}
				});
			}
			else
			{ 
				var url = 'assessor/registration/show_courses/'+sector_id;
				$.ajax({
					url: url,
					beforeSend: function(){
						/*$('#'+id).html('<option value="">Select</option>');*/
					},
					success: function(result){
						$('#skill_'+select_serial).html(result);
					}
				});
			 }
	});
		
						
		$("#permanent_district").change(function(){
				var district = $('#permanent_district').val(); 
				 
				var blocks =  $('.permanent_block_append');
				if(district =="")
				{
					for(var i = 0; i < blocks.length; i++)
					{
									 
						$('.permanent_block_append').remove();
									
					}
				}
				else
				{
				$.ajax({
					url: "assessor/Registration/blockByDistrict",
					method: "GET",
					data: {districtId: district},
					dataType: 'json',
					success: function(resp)
							{
								for(var i = 0; i < resp.blocks.length; i++)
								{
									 
										$('.permanent_block_append').remove();
									
								}
								$.each( resp.blocks, function( key, value ) {
				
									$('#permanent_block').append("<option value='"+ value.block_municipality_id_pk +"' class='permanent_block_append'>"+ value.block_municipality_name +"</option>");
								});
				
							},
					error: function(xhr)
							{
				
								 
							}
				});
				}
			});
		/* newly added contents by Koustabh ends 21/08/2018 */
		
		/* newly added contents By Koustabh 04/09/2018 starts*/
		
		$('#employment_type').change(function(){
				var employment_type = $('#employment_type').val();
				 
				var joining_div = $('.joining_div');
				var professional_address = $('.professional_address_div');
				if(employment_type != 1 && employment_type != 3)
				{
					
					for(var i = 0 ; i < joining_div.length; i++)
					{
						$('#employment_flag').value = 0;
						joining_div[i].style.display = "none";
					}
					/* newly added by Koustabh 08/09/2018 starts */
					professional_address[0].style.display = "none";
					$('#current_employer_label').text("Current Employer");
					$('#current_employer_input').attr('placeholder',"Current Employer");
					$('#joining_year').val('');
					$('#joining_month').val('');
					
					$('#current_employer_input').val('');
					$('#work_state').val('');
					$('#work_district').val('');
					$('#work_pin').val('');
					
					/* newly added by Koustabh 08/09/2018 ends */
				}
				else if(employment_type == 1)
				{
					for(var i = 0 ; i < joining_div.length; i++)
					{
						$('#employment_flag').value = 1;
						joining_div[i].style.display = "block";
					}
					/* newly added by Koustabh 08/09/2018 starts */
					professional_address[0].style.display = "block";
					$('#current_employer_label').text("Current Employer");
					$('#current_employer_input').attr('placeholder',"Current Employer");
					$('#joining_year').val('');
					$('#joining_month').val('');
					
					$('#current_employer_input').val('');
					$('#work_state').val('');
					$('#work_district').val('');
					$('#work_pin').val('');
					/* newly added by Koustabh 08/09/2018 ends */
				}
				else if(employment_type == 3)
				{
					for(var i = 0 ; i < joining_div.length; i++)
					{
						$('#employment_flag').value = 1;
						joining_div[i].style.display = "block";
					}
					/* newly added by Koustabh 08/09/2018 starts */
					professional_address[0].style.display = "block";
					$('#current_employer_label').text("Last Employer");
					$('#current_employer_input').attr('placeholder',"Last Employer");
					$('#joining_year').val('');
					$('#joining_month').val('');
					
					$('#current_employer_input').val('');
					$('#work_state').val('');
					$('#work_district').val('');
					$('#work_pin').val('');
					/* newly added by Koustabh 08/09/2018 ends */
				}
			});
		
	 	/* newly added contents By Koustabh 04/09/2018 ends*/
		
		 $('#soe').change(function(){
			
			var sector = $(".soe").val();
			$.ajax({
				url: "assessor/Registration/courseBySector",
				method: "GET",
				data: {sector: sector},
				dataType: 'json',
				success: function(resp)
						 {
							  console.log(resp[0]);
							 for(var i = 0; i < resp.length; i++)
								{
									 
										$('.course_append').remove();
									
								}
							$.each( resp, function( key, value ) {
				
									$('#course').append("<option value='"+ value.sector_id_fk + "," + value.course_id_pk +"' class='course_append'>"+ value.course_name +"</option>");
								});  
								//$("#course").html(resp);
							 
						 },
			 	error: function(xhr)
						{
							 
						}
						 
				});
				
			}); 
		$("#district").change(function(){
				var district = $('#district').val(); 
				 
				var blocks =  $('.block_append');
				if(district =="")
				{
					for(var i = 0; i < blocks.length; i++)
					{
									 
						$('.block_append').remove();
									
					}
				}
				else
				{
				$.ajax({
					url: "assessor/Registration/blockByDistrict",
					method: "GET",
					data: {districtId: district},
					dataType: 'json',
					success: function(resp)
							{
								for(var i = 0; i < resp.blocks.length; i++)
								{
									 
										$('.block_append').remove();
									
								}
								$.each( resp.blocks, function( key, value ) {
				
									$('#block').append("<option value='"+ value.block_municipality_id_pk +"' class='block_append'>"+ value.block_municipality_name +"</option>");
								});
				
							},
					error: function(xhr)
							{
				
								 
							}
				});
				}
			});
			
		$("#org_district").change(function(){
				var district = $('#org_district').val(); 
				var block = $('#block');
				$.ajax({
					url: "assessor/Registration/blockByDistrict",
					method: "GET",
					data: {districtId: district},
					dataType: 'json',
					success: function(resp){
						for(var i = 0; i < resp.blocks.length; i++){
							 
								$('.org_block_append').remove();
							
						}
						$.each( resp.blocks, function( key, value ) {
		
							$('#org_block').append("<option value='"+ value.block_municipality_id_pk +"' class='org_block_append'>"+ value.block_municipality_name +"</option>");
						});
		
					},
					error: function(xhr){
						 
					}
				});
			});
			
			 $("#state").change(function(){
				var state = $('#state').val(); 
				var block =  $('#district');
				var districts = $('.district_append');
				var blocks = $('.block_append');
				if(state == "")
				{
				  	for(var i = 0; i < districts.length; i++)
					{
									 
						$('.district_append').remove();
									
					}
					for(var i = 0; i < blocks.length; i++)
					{
									 
						$('.block_append').remove();
									
					}
				}
				else
				{
										 
				$.ajax({
					url: "assessor/Registration/districtByState",
					method: "GET",
					data: {state_id: state},
					dataType: 'json',
					success: function(resp)
							{
								
								for(var i = 0; i < resp.districts.length; i++)
								{
									 
										$('.district_append').remove();
									
								}
								for(var i = 0; i < resp.districts.length; i++)
								{
									 
										$('.block_append').remove();
									
								}
								$.each( resp.districts, function( key, value ) {
				
									$('#district').append("<option value='"+ value.district_id_pk +"' class='district_append'>"+ value.district_name +"</option>");
								});
				
							},
					error: function(xhr)
							{
								 
							}
				});
				}
			}); 
			
			$("#permanent_state").change(function(){
				var state = $('#permanent_state').val(); 
				var block =  $('#permanent_district');
				var districts = $('.permanent_district_append');
				var blocks = $('.permanent_block_append');
				if(state == "")
				{
					for(var i = 0; i < districts.length; i++)
					{
									 
						$('.permanent_district_append').remove();
									
					}
					for(var i = 0; i < blocks.length; i++)
					{
									 
						$('.permanent_block_append').remove();
									
					}
				}
				else
				{
				$.ajax({
					url: "assessor/Registration/districtByState",
					method: "GET",
					data: {state_id: state},
					dataType: 'json',
					success: function(resp)
							{
								
								for(var i = 0; i < resp.districts.length; i++)
								{
									 
										$('.permanent_district_append').remove();
									
								}
								for(var i = 0; i < resp.districts.length; i++)
								{
									 
										$('.permanent_block_append').remove();
									
								}
								$.each( resp.districts, function( key, value ) {
				
									$('#permanent_district').append("<option value='"+ value.district_id_pk +"' class='permanent_district_append'>"+ value.district_name +"</option>");
								});
				
							},
					error: function(xhr)
							{
				
								 
							}
				});
				}
			});
			
			 $("#work_state").change(function(){
				var state = $('#work_state').val(); 
				var block =  $('#work_district');
				var districts = $('.work_district_append');
				if(state == "")
				{
					for(var i = 0; i < districts.length; i++)
					{
									 
						$('.work_district_append').remove();
									
					}
				}
				else
				{
				$.ajax({
					url: "assessor/Registration/districtByState",
					method: "GET",
					data: {state_id: state},
					dataType: 'json',
					success: function(resp)
							{
								
								for(var i = 0; i < resp.districts.length; i++)
								{
									 
										$('.work_district_append').remove();
									
								}
								 
								$.each( resp.districts, function( key, value ) {
				
									$('#work_district').append("<option value='"+ value.district_id_pk +"' class='work_district_append'>"+ value.district_name +"</option>");
								});
				
							},
					error: function(xhr)
							{
				
								 
							}
				});
				}
			}); 
			
			
			
			
			
		$("#bank_name").change(function(){
				var bank_name = $('#bank_name').val();
			    $('#ifsc').val('');
			 
				$.ajax({
					url: "assessor/Registration/branchByBank",
					method: "GET",
					data: {bank_name: bank_name},
					dataType: 'json',
					success: function(resp)
							{
								for(var i = 0; i < resp.bank_branchs.length; i++)
								{
									 
										$('.branch_append').remove();
									
								}
								$.each( resp.bank_branchs, function( key, value ) {
				
									$('#bank_branch').append("<option value='"+ value.branch +"' class='branch_append'>"+ value.branch +"</option>");
								});
							},
					error: function(xhr)
							{
								 
							}
				});
			});
			
		$("#bank_branch").change(function(){
				var branch = $('#bank_branch').val();
				var bank_name = $('#bank_name').val();
				 
				$.ajax({
					url: "assessor/Registration/ifscByBranchBank",
					method: "GET",
					data: {branch: branch,bank_name: bank_name},
					dataType: 'json',
					success: function(resp){
						 		$('#ifsc').val(resp.ifsc);
						 
					},
					error: function(xhr){
						
					}
				});
			});
			
		$("#dob").change(function(){
				var dob = document.getElementById('dob').value;
				var dob_date = new Date(dob);
				var curr_date = new Date();
				var age = curr_date.getFullYear() - dob_date.getFullYear();
				$('#age').val(age);
			});
			
		$("#loadCaptcha").click(function(){
				$.ajax({
					url: "assessor/Registration/captcha",
					method: "GET",
					dataType: "json",
					success: function(resp){
								
								 
						$('#captcha').html(resp.captchaImg);
								 
						},
					error: function(xhr){
						
						}
					});
			});
			
        $("#declaration").click(function(){
				 
				
			
				if($('#declaration').prop("checked") == true)
				{
					$('#submit').removeAttr('disabled')
					 
				}
				else
				{
						$('#submit').attr('disabled','disabled');
						 
				}
			});
    });
