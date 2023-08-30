$(document).ready(function($) {
    $(document).on('click', '.readyToBegin', function(e){

        if($("#myCheck").is(':checked')) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are ready for the exam.!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    $.ajax({
                        url: "assessor_exam_corner/online_exam/updateAssessorStartExam",
                        type: 'GET',
                        dataType: "json",
                        data: {batch_id_hash: $("#myBatchId").val()},
                    })
                    .done(function(res) {
                        window.open($("#myUrl").val(),"_self");
                    })
                    .fail(function() {
                        Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                    });
                }
            });
        } else {
            e.preventDefault();
            Swal.fire('Warning!', 'You must agree to the terms first.', 'warning');
        }
    });

    $(document).on('click', '.save-question', function(){
        Swal.fire({
            title: 'Wait a moment please!',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();

                setTimeout(function () {
                    swal.close()
                }, 1000);
            }
        });
    });
    
    $(document).on('click', '.mark-for-review', function(){
        $('#mark_for_review').val(1);

        loadExamQuestion();
    });
    
    $(document).on('click', '.question-no-link', function(){
        $('#next_question').val($(this).text().trim());

        loadExamQuestion();
    });
    
    $(document).on('click', '.save-and-exit', function(){
        Swal.fire({
            title: 'Are you sure?<br>Save & Exit the Exam.!',
            // text: "Save & Exit the Exam.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save & Exit!'
        }).then((result) => {
            if (result.isConfirmed) 
            {
                loadExamQuestion();
            }
        });
    });

    function loadExamQuestion(){
        $('.loader').show();
        var formData = $('#questionForm').serialize();

        $.ajax({
            url: "assessor_exam_corner/online_exam/nextQuestion",
            dataType: "json",
            data: formData,
        })
        .done(function(response) {
            // console.log(response);
            if(response.html_view){
            
                $('.loader').hide();
                $('.exam-question-body').html(response.html_view);
            
            } else {
                window.open(response.my_url,"_self");
            }
        })
        .fail(function(res) {
            $('.loader').hide();
            Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
        });
    }
});