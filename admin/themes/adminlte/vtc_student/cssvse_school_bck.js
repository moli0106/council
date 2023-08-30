$(document).ready(function () {

    $(document).on('click', '.get-student-details', function (e) {

		var id_hash = $(this).prop('id');
		var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

		$('.student-data-div').html(loader);

		$.ajax({
			url: "cssvse/cssvse_school/student_details/" + id_hash,
			type: 'GET',
			dataType: "json",
		})
			.done(function (response) {
				$('.student-data-div').html(response);
			})
			.fail(function (res) {
				$('#modal-student-details').modal('toggle');
				Swal.fire('Error!', 'Oops! Unable to get student details.', 'error');
			});
	});
});
