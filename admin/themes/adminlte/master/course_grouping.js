$(document).ready(function () {
    
    $('.select2').select2();

    $('#example1').DataTable()

    $(document).on('change', '#course_id', function(e){
        var course_id = $(this).val();
        var raw_html = '<option value="" disabled="true">Please wait a moment</option>';
        $('#course_map_id').html(raw_html);
        
        $.ajax({
            url: "master/course_grouping/get_course/"+course_id,
            type: 'GET',
            dataType: "json",
        })
        .done(function(response) {
            $('#course_map_id').html(response);
        })
        .fail(function(res) {
            Swal.fire('Error!', 'Oops! Something went wrong.', 'error'); 
        });
    });
});