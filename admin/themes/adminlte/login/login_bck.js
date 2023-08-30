$(document).ready(function(){
	// alert("TEST");
	$('#loadCaptcha').click(function(){
		$.ajax({
			url: "admin/login/load_captcha",
			type: "GET",
			dataType: "json",
			success:function(resp)
					{ 
						$('.captcha_img').html(resp.image);
						$('.security_code').val(resp.word);
					}
			/*beforeSend:function()
						{
							$('.captcha_img').html('<div class="loader login_loader"></div><div class="login_loader">Please wait</div>');
						}*/
		});
	});
});