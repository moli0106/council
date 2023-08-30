$(document).ready(function () {
    
    $('.select2').select2();

    $('#example1').DataTable()

    $(document).on('change', '#district_id', function(e){
        var district_id = $(this).val();
		//alert(district_id);
        var raw_html = '<option value="" disabled="true">Please wait a moment</option>';
        $('#district_map_id').html(raw_html);
        
        $.ajax({
            url: "master/map_district/get_district/"+district_id,
            type: 'GET',
            dataType: "json",
        })
        .done(function(response) {
            $('#district_map_id').html(response);
        })
        .fail(function(res) {
            Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
        });
    });
});