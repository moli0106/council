$(document).ready(function(){ 
    $(document).on('click', '.approve-reject-modal', function() {


        // var id_hash = $(this).closest('tr').prop('id');
        var id_hash = $(this).attr('data-id');
        
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';
        
        $('.approve-reject-data').html(loader);
        
        $.ajax({
                url: "student_transfer/student_list/showApproveRejectModal/" + id_hash,
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
                    $("#verify_reject_form").submit();
        
                }
            })
        } else {
            Swal.fire('Remarks field is the required');
        }
        
    });
        
    $(document).on('click', '.approve-btn', function(e) {
       
        $(".reject-btn").hide();
        
        $("#div_class").attr("style", "display:none");
       
        e.preventDefault();
        var error = 0;
        
        $('#status').val(1);
        
        Swal.fire({
            title: 'Warning!<br>Are you sure? You want to verify this student.',
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
                $("#verify_reject_form").submit();
    
            }
        })
        
        
        
        
    });
        
    $(document).on('click', '.modal-reject-note', function() {
        
        
        // var id_hash = $(this).closest('tr').prop('id');
        var id_hash = $(this).attr('data-id');
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';
        
        $('.reject-note-data').html(loader);
        
        $.ajax({
                url: "student_transfer/student_list/getRejectNote/" + id_hash,
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

    $(document).on('click', '.std_admit_btn', function(e) {
      
       
        e.preventDefault();
        var error = 0;
        var id_hash = $(this).attr('data-id');
       
        Swal.fire({
            title: 'Warning!<br>Are you sure? You want to admit this student.',
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
                $.ajax({
                    url: "student_transfer/student_list/admit_transfer_student/" + id_hash,
                    type: 'GET',
                    dataType: "json",
                })
                .done(function(res) {
                    if(res=='done'){

                        Swal.fire('Success!', 'Student Successfully Admitted.', 'success');
                        location.reload();
                    }else{
                        Swal.fire('Danger!', 'Something Went Wrong.', 'danger');
                    }
                })
                .fail(function(res) {
                    
                    Swal.fire('Error!', 'Oops! Unable to get Student data.', 'error');
                });
    
            }
        })
        
        
        
        
    })
});