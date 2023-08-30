$(document).ready(function () {
    
    $('.select2').select2();

	$('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        orientation: "top",
        startDate:'+0d' 
  });

  $('.timepicker').timepicker({
	showInputs: false,
	showMeridian: false
});

    $("#course_id").change(function(){
		var course_id = $("#course_id").val();
		//alert(discipline_id);
		var url = 'question_set_master/upload_all_hs_question/get_subject/'+ course_id;
		$.ajax({
			url: url,
			success: function(result){
				$("#subject_id").html(result);
			}
		});
	});

	/***********File upload********************/
	$(document).on('change', ':file', function () {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	});

	// We can watch for our custom `fileselect` event like this
	$(document).ready(function () {
		$(':file').on('fileselect', function (event, numFiles, label) {

			var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;

			if (input.length) {
				input.val(log);
			} else {
				if (log) alert(log);
			}

		});
	});
	/***********End File upload********************/



    
});