$(document).ready(function () {

	$("#datepicker-13").datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true
	});

	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

	var checkin = $('#datepicker-14').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true,
		onRender: function (date) {
			return date.valueOf() < now.valueOf() ? 'disabled' : '';
		}
	}).on('changeDate', function (ev) {
		if (ev.date.valueOf() > checkout.date.valueOf()) {
			var newDate = new Date(ev.date)
			newDate.setDate(newDate.getDate() + 1);
			checkout.setValue(newDate);
		}
		checkin.hide();
		$('#datepicker-15')[0].focus();
	}).data('datepicker');
	var checkout = $('#datepicker-15').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true,
		onRender: function (date) {
			return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
		}
	}).on('changeDate', function (ev) {
		checkout.hide();
	}).data('datepicker');

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


	$(document).on('click', '.publication-status', function () {

		var thisBtn = $(this);
		var thisTr = $(this).closest('tr');
		var id_hash = thisTr.prop('id');
		var statusTd = thisTr.find("td:eq(6)");

		if ($(this).attr('data-status') == 1) {

			var status = 0;
			var thisText = 'Deactivate';
			var thisTd = '<span class="label label-warning">Pending</span>';
		} else {

			var status = 1;
			var thisText = 'Approved';
			var thisTd = '<span class="label label-success">Approved</span>';
		}

		Swal.fire({
			title: thisText + ' the Publication?',
			text: "Are you sure?",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Change Status!',
			allowEscapeKey: false,
			allowOutsideClick: false
		}).then((result) => {
			if (result.isConfirmed) {

				Swal.fire({
					title: 'Please wait a moment!',
					html: 'We\'ll ' + thisText + ' the Publication.',
					allowEscapeKey: false,
					allowOutsideClick: false,
					didOpen: () => {
						Swal.showLoading();

						$.ajax({
							url: 'notice_and_circular_management/notice_and_circular/change_status',
							type: 'GET',
							dataType: "json",
							data: { 'id_hash': id_hash },
						})
							.done(function (response) {
								statusTd.html(thisTd);
								thisBtn.attr('data-status', status);
								Swal.fire('Success!', 'The Publication is ' + thisText, 'success');
								location.reload();
							})
							.fail(function (res) {
								Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
							});
					}
				})

			}
		})
	})
});
