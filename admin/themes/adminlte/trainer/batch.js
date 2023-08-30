$(document).ready(function () {
    
    $("#eligibleForAssessment").submit(function (e) { 
        var eligibleAssessor = new Array();

        $("#tbody").find(".assessorCheckbox").each(function(i, e){
            if($(this).is(":checked"))
                eligibleAssessor.push($(this).val());
        });

        if(eligibleAssessor.length == 0 ) {
            e.preventDefault();
            Swal.fire('Please select Assessor from the list.');
            return false;
        }
        
    });

    $(document).on("click", "#UpdateEvaluationMarks", function(e){

        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Update the Marks & Training Attends!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
		}).then((result) => {
            if (result.isConfirmed) {
                $("#UpdateEvaluationMarksSubmit").click();
            }
        });
    });

    $(document).on("click", ".assessorCheckbox", function(){
        if($(this).is(":checked")) {
            var eligibleAssessor = new Array();
            
            $("#tbody").find(".assessorCheckbox").each(function(i, e){
                if($(this).is(":checked"))
                    eligibleAssessor.push($(this).val());
            });

            if(eligibleAssessor.length == $(".assessorCheckbox").length ) {
                $("#check_all").prop("checked", true);
            }

        } else {
            $("#check_all").prop("checked", false);
        }
    });

    $(document).on("click", "#check_all", function(){
        if($(this).is(":checked")) {
            $("#tbody").find(".assessorCheckbox").each(function(i, e){
                $(this).prop("checked",true);
            });
        } else {
            $("#tbody").find(".assessorCheckbox").each(function(i, e){
                $(this).prop("checked", false);
            });
        }
    });

    $(document).on('click', '#assignQuestion', function(e){
        var id = $(this).attr("data-id");
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to assign question in batch!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
		}).then((result) => {
            // Swal.fire('Please wait a moment...');
            if (result.isConfirmed) {
                $.ajax({
                    url: "trainer/batch/add_question/"+id,
                    dataType: "json",
                })
                .done(function(res) {
                    console.log(res);
                    if(res == 1)
                    {
                        $('#assignQuestion').hide('slow');
						$('#show_eligible_asseessement').show('slow');
                        Swal.fire('Assigned!', 'Question successfully assigned.', 'success');
                    }
                    else if(res == 2)
                    {
                        Swal.fire('Oops!', 'There is not enough question in course.', 'error');
                    }
                    else
                    {
                        Swal.fire('Oops!', 'There is no module found in course.', 'error');
                    }
                })
                .fail(function(res) {
                    Swal.fire('Error!', 'Oops! Something went wrong, please try again', 'error'); 
                });

            }
        });
    })

// For Send Online Training Link

    $(document).on("click",".send_training_link", function () {
        $(".modal-title").html("Send link for Online Training");
        var page = $(this).attr("alt");
        var batch_id_hash = $(this).attr("href");

        // alert(page);
        // alert(assessor_id_hash);
        $.ajax({
            type: "GET",
            url: "trainer/batch/send_training_link/"+batch_id_hash,
            success: function (response) {
                $(".modal-body").html(response);
            }
        });
    });

    $(document).on("click",".send_link_button", function () {

        var action_page = $("#send_link_form").attr("action");
        $.ajax({
            type: "POST",
            url: action_page,
            data: $( "#send_link_form" ).serialize(),
            success: function (response) {
              $(".modal-body").html(response);
            }
        });
     });

// End For Send Online Training Link

// Start For set Exam date and time
    $(document).on("click",".set_exam_date_time", function () {
        var page = $(this).attr("alt");
        var batch_id_hash = $(this).attr("href");
        
        // alert(page);
        // alert(assessor_id_hash);
        $.ajax({
            type: "GET",
            url: "trainer/batch/set_exam_date_time/"+batch_id_hash,
            success: function (response) {
                
                $(".myModalSetexamTime_body").html(response);
                $('.startdate').datepicker({
                    todayBtn:  1,
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                  });
                $('.timepicker').timepicker({
                    showInputs: false,
                    showMeridian: false
                });
                
            }
        });
    });

    $(document).on("click",".set_exam_date_time", function () {

        var action_page = $("#set_exam_date_time_form").attr("action");
        $.ajax({
            type: "POST",
            url: action_page,
            data: $( "#set_exam_date_time_form" ).serialize(),
            success: function (response) {
              $(".myModalSetexamTime_body").html(response);
              $('.startdate').datepicker({
                todayBtn:  1,
                autoclose: true,
                format: 'dd/mm/yyyy'
              });
            $('.timepicker').timepicker({
                showInputs: false,
                showMeridian: false
            });
            }
        });
     });

// End For set Exam date and time


// Start For entry Continuous Evaluation Marks
$(document).on("click",".continuous_evaluation_marks", function () {
    var page = $(this).attr("alt");
    var batch_id_hash = $(this).attr("href");
    
    // alert(page);
    // alert(assessor_id_hash);
    $.ajax({
        type: "GET",
        url: "trainer/batch/add_continuous_evaluation_marks/"+batch_id_hash,
        success: function (response) {
            
            $(".continuous_evaluation_marks_content").html(response);
            
        }
    });
});

$(document).on("click",".set_continuous_evaluation_marks", function () {

    var action_page = $("#continuous_evaluation_marks_form").attr("action");
    $.ajax({
        type: "POST",
        url: action_page,
        data: $( "#continuous_evaluation_marks_form" ).serialize(),
        success: function (response) {
          $(".continuous_evaluation_marks_content").html(response);
        }
    });
 });

// End For entry Continuous Evaluation Marks
});