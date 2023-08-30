$(document).ready(function () {
	$('.select2').select2();
	
    $("#app_approve_reject").on("change", function () {
        var conceptName = $('#app_approve_reject').find(":selected").val();
        if(conceptName == 5){
            $(".reject_area").css("display", "none");
           
        } else if(conceptName == 6){
            $(".reject_area").css("display", "block");
        }
    });
});