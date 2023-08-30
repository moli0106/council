$(document).ready(function(){

    $(document).on('click', '.approve-reject-modal', function() {


        // var id_hash = $(this).closest('tr').prop('id');
        var id_hash = $(this).attr('data-id');
       // alert(id_hash);
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.approve-reject-data').html(loader);

        $.ajax({
                url: "institute_student/student_list/showApproveRejectModal/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.approve-reject-data').html(response);
            })
            .fail(function(res) {
                $('#approve-reject-modal').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get Student data.', 'error');
            });


    });

    $(document).on('click', '.reject-btn', function(e) {

        $(".approve-btn").hide();
        $("#div_class").attr("style", "display:block");
        $("#approve_div").attr("style", "display:none");
        e.preventDefault();
        var error = 0;
        var remarksVal = $('textarea#remarks').val();
        $('#status').val(0);
        if (remarksVal != '') {

            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to reject this student.',
                text: "You will not able to revert it back.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Do it!',
                allowEscapeKey: false,
                allowOutsideClick: false
            }).then((result) => {

                if (result.isConfirmed) {
                    $("#approve_reject_form").submit();

                }
            })
        } else {
            Swal.fire('Remarks field is the required');
        }

    });

    $(document).on('click', '.approve-btn', function(e) {

        $(".reject-btn").hide();

        $("#div_class").attr("style", "display:none");
        $("#approve_div").attr("style", "display:block");
        e.preventDefault();
        var error = 0;

        $('#status').val(1);
        var management_quota = $('input[name="management_quota"]:checked').val();
        if (management_quota == undefined) {
            Swal.fire('This field is the required');

        }else{
            Swal.fire({
                title: 'Warning!<br>Are you sure? You want to approve this student.',
                text: "You will not able to revert it back.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Do it!',
                allowEscapeKey: false,
                allowOutsideClick: false
            }).then((result) => {
    
                if (result.isConfirmed) {
                    $("#approve_reject_form").submit();
    
                }
            })
        }

        

    })

    $(document).on('click', '.modal-reject-note', function() {


        // var id_hash = $(this).closest('tr').prop('id');
        var id_hash = $(this).attr('data-id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.reject-note-data').html(loader);

        $.ajax({
                url: "institute_student/student_list/getRejectNote/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(response) {
                $('.reject-note-data').html(response);
            })
            .fail(function(res) {
                $('#modal-reject-note').modal('toggle');
                Swal.fire('Error!', 'Oops! Unable to get Student data.', 'error');
            });


    });
});