$(document).ready(function(evt){
	$('#dob').datepicker({
		startDate: '-1000y',
        endDate:'-25y',
		autoclose: true,
		format: 'mm/dd/yyyy'
		
		 });
	});

$(document).ready(function(e) {
    $("#district").change(function(){
			var district = $('#district').val(); 
			var block =  document.getElementById('block');
			$.ajax({
				url: "inspector/Registration/blockByDistrict",
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
				error: function(xhr){
	
					console.log('Error occurred');
				}
			});
		});
	
	$("#org_district").change(function(){
			var district = $('#org_district').val(); 
			var block =  document.getElementById('block');
			$.ajax({
				url: "inspector/Registration/blockByDistrict",
				method: "GET",
				data: {districtId: district},
				dataType: 'json',
				success: function(resp)
						{
							for(var i = 0; i < resp.blocks.length; i++)
							{
								 
									$('.org_block_append').remove();
								
							}
							$.each( resp.blocks, function( key, value ) {
			
								$('#org_block').append("<option value='"+ value.block_municipality_id_pk +"' class='org_block_append'>"+ value.block_municipality_name +"</option>");
							});
			
						},
				error: function(xhr)
						{
							console.log('Error occurred');
						}
			});
		});
	
	$("#bank_name").change(function(){
			var bank_name = $('#bank_name').val();
		    document.getElementById('ifsc').value = "";
		 
			$.ajax({
				url: "inspector/Registration/branchByBank",
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
				url: "inspector/Registration/ifscByBranchBank",
				method: "GET",
				data: {branch: branch,bank_name: bank_name},
				dataType: 'json',
				success: function(resp)
						{
							 document.getElementById('ifsc').value = resp.ifsc;
							 
						},
						error: function(xhr)
						{
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
			success: function(resp)
					{
								
								 
						$('#captcha').html(resp.captchaImg);
								 
					},
			error: function(xhr)
					{
						
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





	
