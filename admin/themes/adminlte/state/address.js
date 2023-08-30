$(document).ready(function () {
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
                url: "polytechnic_affiliation/Affiliation/getDistrict/" + state,
                dataType: "JSON",
            })
            .done(function(res) {
                var html = '';
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
            url: "polytechnic_affiliation/Affiliation/getSubDivision/" + district,
            dataType: "JSON",
        })
        .done(function(res) {

            var html = '';
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

});
