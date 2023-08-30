$(document).ready(function () {


    $(document).on('change', '#course_name_id', function() {

        var vtc_code = $('#vtcCode').val();
        var course_name_id = $(this).val();

        $.ajax({
            url: "vtc_student/batch_declaration/getGroupName/" + course_name_id,
            type: 'GET',
            data: {vtc_code : vtc_code},
            dataType: "JSON",
        })
        .done(function(res) {
            $('#group_id').html(res);
        })
        .fail(function() {
            console.log('error');
        });

    });

    $(".batch_datepicker").datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true
	});
})