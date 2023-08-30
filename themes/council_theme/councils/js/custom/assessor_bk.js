
$(document).ready(function(evt){
	/*if($('.table').attr("data-flag") == 0)
	{
		document.getElementById('sector_table').style.display = "none";	
	}*/
	$('[data-toggle="tooltip"]').tooltip();
	
	$('#dob').datepicker({
		startDate: '-1000y',
        endDate:'-25y',
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
	    
	  });
$(document).ready(function(e) {
		
		/* newly addedd contents starts 21/08/2018 */
		$('#certified_no').click(function(){
				var certified_no = document.getElementById('certified_no');
				var certified_field_div = document.getElementById('certified_field_div');
				if(certified_no.checked == true)
				{
					
					certified_field_div.style.display = "none";
					document.getElementById('certified_flag').value = "0";
					//alert("Checked");	
				}
				
			});
		$('#certified_yes').click(function(){
				var certified_yes = document.getElementById('certified_yes');
				var certified_field_div = document.getElementById('certified_field_div');
				if(certified_yes.checked == true)
				{
					certified_field_div.style.display = "block";
					document.getElementById('certified_flag').value = "1";
				}
			});
			
		$('#same_present_addr').click(function(){
				var present_house = $('#house').val();
				var present_street_name = $('#street').val();
				var present_pincode = $('#pincode').val();
				var present_district = $('#district').val();
				var present_block = $('#block').val();
				var present_po = $('#po').val();
				var present_ps = $('#ps').val();
				var present_landline = $('#landline').val();
				var present_mobile_no = $('#mobile_no').val();
				var present_email = $('#email').val();
				var same_present_addr_checkbox = document.getElementById('same_present_addr');
				if(same_present_addr_checkbox.checked == true)
				{
					document.getElementById('permanent_house').value = present_house;	
					document.getElementById('permanent_street').value = present_street_name;
					document.getElementById('permanent_pincode').value = present_pincode;
					document.getElementById('permanent_district').value = present_district;
					document.getElementById('permanent_po').value = present_po;
					document.getElementById('permanent_ps').value = present_ps;
					document.getElementById('permanent_landline').value = present_landline;
					document.getElementById('permanent_mobile_no').value = present_mobile_no;
					document.getElementById('permanent_email').value = present_email;
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
										document.getElementById('permanent_block').value = present_block;
						
									},
							error: function(xhr)
									{
						
										console.log('Error occurred');
									}
						});
						
						
					}
				}
				else
				{
					document.getElementById('permanent_house').value = "";	
					document.getElementById('permanent_street').value = "";
					document.getElementById('permanent_pincode').value = "";
					document.getElementById('permanent_district').value = "";
					document.getElementById('permanent_block').value = "";
					document.getElementById('permanent_po').value = "";
					document.getElementById('permanent_ps').value = "";
					document.getElementById('permanent_landline').value = "";
					document.getElementById('permanent_mobile_no').value = "";
					document.getElementById('permanent_email').value = "";
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
	});
		/* var wrapper = $("#wrapper_dynamic");
		$('#add_row').click(function(){
			 var max_row = 20;
			 var no_of_rows = document.getElementsByClassName('added_row').length;
			 if(no_of_rows < max_row)
			 {	 
				$.ajax({
						url: "assessor/Registration/ajax_add_sector_course"+ no_of_rows,
						
						success: function(resp)
								 {
									$(wrapper).append(resp); 
								 },
						error: function(xhr)
								{
									alert("ERROR");	
								}
					});
			 }
		});
		$(wrapper).on("click",".remove_field_button", function(e){ //user click on remove field
		e.preventDefault(); 
		var id=$(this).attr('id');
		$('#rm_row_'+id).remove();
		x--;
		$('#running_sl').val(x);
	});*/
		/*$('#add_row').click(function(){
				
				var course = document.getElementsByClassName('course_append');
				var sectors = {};
				var sector_table_row = document.getElementsByClassName('sector_append');
				for(var j = 0; j < sector_table_row.length; j++ )
				{
					 $('.sector_append').remove();
				}
				for(var i = 0; i < course.length; i++)
				{
					if(course[i].selected)	
					{
						sectors[i] = course[i].value;
						$.ajax({
							url: "assessor/Registration/ajax_sectors" ,
							type: "GET",
							data: {sectors: course[i].value},
							dataType: 'json',
							success: function(resp)
									 {
										 console.log(resp);
										
										 $.each( resp, function( key, value ) {
						
											$('.sector_table_body').append("<tr class='sector_append'><td>"+ value.sector_name +"</td><td>"+ value.course_description +"</td></tr>");
										});
										 
									 },
							error: function(xhr)
									{
										
									}
							});
					}
				}							
			});*/
		$("#permanent_district").change(function(){
				var district = $('#permanent_district').val(); 
				var block =  document.getElementById('permanent_block');
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
				
								console.log('Error occurred');
							}
				});
			});
		/* newly addedd contents ends 21/08/2018 */
	 
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
							alert("ERROR");	
						}
						 
				});
				
			}); 
		$("#district").change(function(){
				var district = $('#district').val(); 
				var block =  document.getElementById('block');
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
				
								console.log('Error occurred');
							}
				});
			});
			
		$("#org_district").change(function(){
				var district = $('#org_district').val(); 
				var block =  document.getElementById('block');
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
						console.log('Error occurred');
					}
				});
			});
			
		$("#bank_name").change(function(){
				var bank_name = $('#bank_name').val();
			    document.getElementById('ifsc').value = "";
			 
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
								console.log('Error occurred');
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
						 document.getElementById('ifsc').value = resp.ifsc;
						 
					},
					error: function(xhr){
						alert("errr");
					}
				});
			});
			
		$("#dob").change(function(){
				var dob = document.getElementById('dob').value;
				var dob_date = new Date(dob);
				var curr_date = new Date();
				var age = curr_date.getFullYear() - dob_date.getFullYear();
				document.getElementById('age').value = age;
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
				var dec = document.getElementById('declaration');
				var submit = document.getElementById('submit');
			
				if(dec.checked)
				{
					submit.removeAttribute('disabled','disabled');
				}
				else
				{
						submit.setAttribute('disabled','disabled');
				}
			});
    });
	/*
	function loadCaptcha(){
		
		}
	function declare(){
			var dec = document.getElementById('declaration');
			var submit = document.getElementById('submit');
			
			if(dec.checked){
					submit.removeAttribute('disabled','disabled');
				}else{
						submit.setAttribute('disabled','disabled');
					}
		}*/