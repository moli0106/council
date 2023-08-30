$(document).ready(function(evt){
	$('#dob').datepicker({
		startDate: '-1000y',
        endDate:'-25y',
		autoclose: true,
		format: 'dd/mm/yyyy',
		
		
		 });
	});

$(document).ready(function(e) {
	
	
	//ajax for district selection box added by Waseem on 30-08-2018
	$("#state").change(function(){
		var state_id = $("#state").val();
		var url = 'inspector/registration/ajax_district/'+ state_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#district").html(result);
			//alert(111);
			}
		});
		
		//alert(state_id);
	});
	
	//ajax for block selection box added by Waseem on 30-08-2018
	
	$("#district").change(function(){
		var district_id = $("#district").val();
		var url = 'inspector/registration/ajax_block/'+ district_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#block").html(result);
			//alert(111);
			}
		});
	});
	
	
	//ajax for Organization block selection box added by Waseem on 30-08-2018
	
	$("#org_district").change(function(){
		var district_id = $("#org_district").val();
		var url = 'inspector/registration/ajax_org_block/'+ district_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#org_block").html(result);
			//alert(111);
			}
		});
	});
	
	
	
	
	$("#bank_name").change(function(){
		var url = 'inspector/registration/ajax_bank_branch/'+$("#bank_name").val();
		$.ajax({
			type: 'GET',
			url: url,
			success: function(result){
				$("#bank_branch").html(result);
				
			}
		});
	});
	
	$("#bank_branch").change(function(){
		
		if($("#bank_branch").val() != ''){
			var url = 'inspector/registration/ajax_ifsc/'+$("#bank_name").val()+'/'+$("#bank_branch").val();
			$.ajax({
				type: 'GET',
				url: url,
				success: function(result){
					$("#ifsc").val(result);
				}
			});
		} else {
			$("#ifsc").val('');
		}
	});
	
	 $("#captcha_regresh").click(function(){
		var url = 'inspector/registration/reload_captcha';
		$.ajax({
			url: url,
			beforeSend: function(){
				$("#captcha_regresh").addClass('fa-spin');
			},
			success: function(result){
				$("#captcha").html(result);
				$("#captcha_regresh").removeClass('fa-spin');
			}
		});
	});
	
	$("#declaration").click(function(){
				var dec = document.getElementById('declaration');
				var submit_val = document.getElementById('submit');
				
				if(dec.checked)
				{
						submit_val.removeAttribute('disabled','disabled');
				}
				else
				{
							submit_val.setAttribute('disabled','disabled');
				}
		});
});





	
