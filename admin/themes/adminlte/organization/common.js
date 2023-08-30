$(document).ready(function(){
    
    $(".std-datepicker").datepicker({
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
                url: "organization/student_reg/getDistrict/" + state,
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

    $(document).on('change', '#district', function() {
        var district = $(this).val();
        // alert(district);
        getSubDivisionVal(district,'');
       
    });

    function getSubDivisionVal(district , subdiv){
        $.ajax({
            url: "organization/student_reg/getSubDivision/" + district,
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
            url: "organization/student_reg/getMunicipality/" + subDivision,
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
})