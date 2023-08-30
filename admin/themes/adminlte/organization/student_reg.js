$(document).ready(function () {

	

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
					url: "organization/student_reg/getCourseList/" + stdSector,
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

	$(document).on('change', '#stdCourse', function () {

		var stdCourse = $(this).val();
		Swal.fire({
			title: 'Please wait a moment!',
			html: 'loading data...',
			allowEscapeKey: false,
			allowOutsideClick: false,
			didOpen: () => {
				Swal.showLoading();

				$.ajax({
					url: "organization/student_reg/getCourseDuration/" + stdCourse,
					dataType: "json",
				})
					.done(function (res) {
						$('#courseDuration').val(res);
						Swal.close();
					})
					.fail(function (res) {
						Swal.fire('Warning!', 'Oops! Unable to get Course Duration, Please try later.', 'warning');
					});
			}
		});
	});

	
})