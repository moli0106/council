$(document).ready(function() {
    // alert("hiii");

        $('#editable-sample').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 50,
            "ajax": {
            "url": "poly_institute/institute_list/get_institute_list",
            "dataType": "json",
            "type": "GET",
            
            },
    
            
    
            "columns": [{
                "data": "sl_no"
            },
            {
                "data": "institute_code"
            },
            {
                "data": "institute_name"
            },
            {
                "data": "institute_category"
            },

            {
                "data": "available_student"
            },
            
            {
                "data": "action"
            }
            ],
            // "preDrawCallback": function(settings) {
            //   $('#chk_all').prop('checked', false);
            // }
    
        });
    
    
    $('.select2').select2();

    
    

});