/* first dependency */
$(document).on('change','#etype_name',function(evt){
		
    var exam_type_id_fk = $(this).val();
    var url = 'spot_council/stud_att_report_centre/ajax_centre/'+exam_type_id_fk;
    $.ajax({
        url: url,
        
        success: function(result){

            console.log(result);
            $("#centre_name").html(result);
        }
    });
});

/* second dependency */
$(document).on('change','#etype_id',function(evt){
		
    var etype_id = $(this).val();
    var url = 'spot_council/stud_att_report_centre/ajax_centre1/'+etype_id;
    $.ajax({
        url: url,
        
        success: function(result){
            $("#centre_id").html(result);
        }
    });
});


/* Third dependency */
$(document).on('change','#etype_id_fk',function(evt){
		
    var etype_id_fk = $(this).val();
    var url = 'spot_council/stud_att_report_centre/ajax_centre2/'+etype_id_fk;
    $.ajax({
        url: url,
        
        success: function(result){
            $("#centre_id_fk").html(result);
        }
    });
});