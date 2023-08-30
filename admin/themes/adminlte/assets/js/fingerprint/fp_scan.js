

var data_fp=null;


    $("#finger_impression_scan").attr('src','image/fingerprint.png');


    var templatesArray = [1];
    var numberOfTemplates = 1; 
    var template;
	
	
function fp_scan()
{
    alert("Place Your finger on the sensor.");
	
    $.ajax
    ({ 
        type: 'GET', 
        dataType: "text",
        url: 'http://localhost:8080/CallMorphoAPI', 
        success: function (data) 
        { 
            var img = JSON.parse(data);
            data_fp=a2hex(data);
            $("#finger_impression_scan").attr('src', "data:image/bmp;base64,"+img.Base64BMPIMage );
			template=img.Base64ISOTemplate;
			//templatesArray[0] = template;
        }

    });
}

function verify_fp_data()
{
    var eid = $("#userid").val();
	var scan_img = $("#finger_impression_scan").attr("src");
	
	scan_img = scan_img.substring(scan_img.lastIndexOf("/")+1);
	
	
	
	
	if(eid === "")
	{
		alert("Please enter your user Id");
		return false;
	}
	else if(scan_img == "fingerprint.png")
	{
		alert("Please Scan your Finger");
		return false;
	}
	else
	{
		$.ajax({
	
			url: "compare_fp.php",
			type: 'POST',
			dataType: 'text',
			data:{eid: eid , fp_data: data_fp},
			success: function(data)
			{
				fpobject = JSON.parse(data);
				
				console.log(fpobject);
				
				templatesArray[0]=hex2a(fpobject.base64isotemplate);
				
				console.log(template);
				CompareTemplateshh(eid);
        	}
    	});
	}
}

function CompareTemplateshh(eid)
{
		$.ajax({
			url:"http://localhost:8080/CompareTemplates" +"?"+templatesArray+"$"+template+"$"+numberOfTemplates,
			type: 'POST', 
			dataType: "text",
        	//data:{fp_data:data_fp}	,	
        	success: function (data) 
			{ 
				fpobject = JSON.parse(data);
			   
			   	if(fpobject.MatchingResult == 1 && fpobject.ReturnCode == 0)
			   	{
									
					$.ajax({
						url: "fp_insert.php",
						type:"POST",
						dataType:"text",
						data: {e_id: eid},
						success: function(data)
						{
							alert(data);
							
							id = JSON.parse(data);
							
							$(".thumnails_info").html("Login Successful for "+id.e_id);
							$(".thumnails_info").show();
							$("#userid").val('');
							$("#finger_impression_scan").attr('src','image/fingerprint.png');
							
						},
						error: function(data)
						{
							$(".thumnails_info").html("Login Failed...");
							$(".thumnails_info").show();
						}
					})
				}
				else
				{
					$(".thumnails_info").html("Invalid Login Credentials");
					$(".thumnails_info").show();
				}
			},
			error:function(data)
			{
				alert("Please Check Biometric device whether installed or not");
			}
			
		});
		
}
function CompareTemplateshLogout(eid)
{
		$.ajax({
			url:"http://localhost:8080/CompareTemplates" +"?"+templatesArray+"$"+template+"$"+numberOfTemplates,
			type: 'POST', 
			dataType: "text",
        	//data:{fp_data:data_fp}	,	
        	success: function (data) 
			{ 
				fpobject = JSON.parse(data);
			   
			   	if(fpobject.MatchingResult == 1 && fpobject.ReturnCode == 0)
			   	{
					//alert("Matched");
					
					$.ajax({
						url: "compare_fp.php",
						type:"POST",
						dataType:"text",
						data: {e_id: eid, req: "logout"},
						success: function(data)
						{
							$(".thumnails_info").html(data);
							$(".thumnails_info").show();
							$("#userid").val('');
							$("#finger_impression_scan").attr('src','fingerprint.png');
						}
					})
				}
				else
				{
					$(".thumnails_info").html("Invalid Login Credentials");
					$(".thumnails_info").show();
				}
			},
			error:function(data)
			{
				alert("Please Check Biometric device whether installed or not");
			}
			
		});
		
}

function logout()
{
	var eid = $("#userid").val();
	var scan_img = $("#finger_impression_scan").attr("src");
	
	scan_img = scan_img.substring(scan_img.lastIndexOf("/")+1);
		
	if(eid === "")
	{
		alert("Please enter your user Id");
		return false;
	}
	else if(scan_img == "fingerprint.png")
	{
		alert("Please Scan your Finger");
		return false;
	}
	else
	{
		$.ajax({
	
			url: "compare_fp.php",
			type: 'POST',
			dataType: 'text',
			data:{eid: eid , fp_data: data_fp},
			success: function(data)
			{
				fpobject = JSON.parse(data);
				
				console.log(fpobject);
				
				templatesArray[0]=hex2a(fpobject.base64isotemplate);
				
				console.log(template);
				CompareTemplateshLogout(eid);
        	}
    	});
	}
}

function search_login_status()
{	
	
	
	var id = $("#userid").val();
	var atten_count=0;
	$.ajax({
		
		url:"compare_fp.php",
		type:"POST",
		dataType:"text",
		data:{e_id: id, req: "search_user"},
		success: function(data)
		{
			console.log(data);
			atten_count = JSON.parse(data);
			$(".thumnails_info").html(atten_count);
			$(".thumnails_info").show();

			if(atten_count == 1)
			{
				$("#btn_login").attr("disabled","disabled");
				$("#btn_logout").removeAttr("disabled");
				$(".thumnails_info").hide();
			}
			else if(atten_count == 2)
			{
				$("#btn_login").attr("disabled","disabled");
				$("#btn_logout").attr("disabled","disabled");
				$(".thumnails_info").hide();
			}
			else if(atten_count == 4)
			{
				$(".thumnails_info").html("User is not registered");
				$(".thumnails_info").show();
			}
			else if(atten_count == 3)
			{
				$("#btn_login").removeAttr("disabled");
				$("#btn_logout").attr("disabled","disabled");
				$(".thumnails_info").hide();
			}
		},
	});
}


   



	
	