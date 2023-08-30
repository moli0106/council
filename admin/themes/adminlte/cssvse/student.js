$(document).ready(function () {

	$("#std-datepicker").datepicker({
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

	$(document).on('click', '.get-student-details', function (e) {

		var id_hash = $(this).prop('id');
		var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

		$('.student-data-div').html(loader);

		$.ajax({
			url: "cssvse/student/details/" + id_hash,
			type: 'GET',
			dataType: "json",
		})
			.done(function (response) {
				$('.student-data-div').html(response);

				$("#std-datepicker").datepicker({
					format: 'dd/mm/yyyy',
					autoclose: true
				});
			})
			.fail(function (res) {
				$('#modal-student-details').modal('toggle');
				Swal.fire('Error!', 'Oops! Unable to get student details.', 'error');
			});
	});

	$(document).on('change', '#district', function () {

		var district = $(this).val();
		Swal.fire({
			title: 'Please wait a moment!',
			html: 'loading data...',
			allowEscapeKey: false,
			allowOutsideClick: false,
			didOpen: () => {
				Swal.showLoading();

				$.ajax({
					url: "cssvse/student/getMunicipalityList/" + district,
					dataType: "json",
				})
					.done(function (res) {
						$('#municipality').html(res);
						Swal.close();
					})
					.fail(function (res) {
						Swal.fire('Warning!', 'Oops! Unable to get Course list, Please try later.', 'warning');
					});
			}
		});
	});

	$(document).on('change', '#stdSector', function () {

		var stdSector = $(this).val();
		Swal.fire({
			title: 'Please wait a moment!',
			html: 'loading data...',
			allowEscapeKey: false,
			allowOutsideClick: false,
			didOpen: () => {
				Swal.showLoading();

				$.ajax({
					url: "cssvse/student/getCourseList/" + stdSector,
					dataType: "json",
				})
					.done(function (res) {
						$('#stdCourse').html(res);
						Swal.close();
					})
					.fail(function (res) {
						Swal.fire('Warning!', 'Oops! Unable to get Course list, Please try later.', 'warning');
					});
			}
		});
	});

	$(document).on('click', '#update-student-profile', function () {
		Swal.fire({
			title: 'Warning!<br>Are you sure?',
			text: "You want to update student profile.",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Do it!',
			allowEscapeKey: false,
			allowOutsideClick: false
		}).then((result) => {
			if (result.isConfirmed) {

				Swal.fire({
					title: 'Please wait a moment!',
					allowEscapeKey: false,
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();
						$('#update-student-info-form').submit();
					}
				});
			}
		});
	});

	$(document).on('click', '.delete-student', function () {
		Swal.fire({
			title: 'Are you sure?',
			text: "You want to delete this student!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {

				// $('#update-student-status').submit();
				var id_hash = $('.std_id_hash').val();

				$.ajax({
					url: "cssvse/student/remove_student/" + id_hash,
					type: 'GET',
					dataType: "json",
				})
					.done(function (response) {
						$('#' + id_hash).remove();
						$('#modal-student-details').modal('toggle');
						Swal.fire('Success!', 'Student has been removed.!', 'success');
					})
					.fail(function (res) {
						$('#modal-student-details').modal('toggle');
						Swal.fire('Error!', 'Oops! Unable to remove student.', 'error');
					});
			}
		})
	});
});