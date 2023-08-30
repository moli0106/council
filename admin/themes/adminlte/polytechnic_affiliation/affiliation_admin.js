$(document).ready(function() {


    $(document).on('change', '#academic_year', function() {
        
        // alert("hiii");
        $('#poly_search_form').submit();
        
    });

    var selected_year = $('#selected_year').val();
    // alert(selected_year);

    

        $('#editable-sample').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 50,
            "ajax": {
            "url": "polytechnic_affiliation/affiliation_admin/get_list",
            "dataType": "json",
            "type": "GET",
            "data": {
                
                'selected_year':selected_year
            }
            },
    
            
    
            "columns": [{
                "data": "sl_no"
            },
            {
                "data": "vtc_code"
            },
            {
                "data": "vtc_name"
            },
            {
                "data": "application_number"
            },
            {
                "data": "academic_year"
            },
            
            {
                "data": "affiliated"
            },
            
            {
                "data": "action"
            }
            ],
            // "preDrawCallback": function(settings) {
            //   $('#chk_all').prop('checked', false);
            // }
    
        });
});