$(document).ready(function () {

    $(document).on("click",".approve_assessor_course", function () {
        $(".modal-title").html("Accept Assessor Course");
        var page = $(this).attr("alt");
        var assessor_course_id_hash = $(this).attr("href");

        // alert(page);
        // alert(assessor_id_hash);
        $.ajax({
            type: "GET",
            url: "council/assessor_list/approve_assessor_course/"+assessor_course_id_hash,
            success: function (response) {
                $(".modal-body").html(response);
            }
        });
    });

    $(document).on("click",".reject_assessor_course", function () {
        $(".modal-title").html("Reject Assessor");
        var page = $(this).attr("alt");
        var assessor_id_hash = $(this).attr("href");

        // alert(page);
        // alert(assessor_id_hash);
        $.ajax({
            type: "GET",
            url: "council/assessor_list/reject_assessor_course/"+assessor_id_hash,
            success: function (response) {
                $(".modal-body").html(response);
            }
        });
    });

   $(document).on("click",".approve_button", function () {

      var action_page = $("#approve_form").attr("action");
      $.ajax({
          type: "POST",
          url: action_page,
          data: $( "#approve_form" ).serialize(),
          success: function (response) {
            $(".modal-body").html(response);
          }
      });
   });

   $(document).on("click",".reject_button", function () {

        var action_page = $("#approve_form").attr("action");
        $.ajax({
            type: "POST",
            url: action_page,
            data: $( "#approve_form" ).serialize(),
            success: function (response) {
            $(".modal-body").html(response);
            }
        });
    });

    //apply_for_expert
    $(document).on('click','.apply_for_expert', function () {
        if($(this).is(":checked") == true){
            $(".expart_type_industrial").prop("disabled", false);
            $(".expart_type_academic").prop("disabled", false);
        } else {
            $(".expart_type_industrial").prop("disabled", true);
            $(".expart_type_academic").prop("disabled", true);
        }
    });

    $('#myModal').on('hidden.bs.modal', function () {
        location.reload();
    });

    $('#submit').click(function(){
        var action_page = "council/assessor_list/confirm_course_submit/";
        //alert(action_page);
        $.ajax({
            type: "POST",
            url: action_page,
            data: $( "#assessor_course_details" ).serialize(),
            success: function (result) {
                //$(".modal-body").html(response);
                var obj = JSON.parse(result);
                    if(obj.response == "TRUE")
                    {
                        //csrf=obj.csrf_token;
                        $(".modal-body").html('<div class="alert alert-success">Assessor Course approve Successfully</div>');
                        $(".remove_btn_no").hide();
                        
                    } 
                    else 
                    {
                        //csrf=obj.csrf_token;
                        $(".modal-body").html('<div class="alert alert-warning">Assessor Course approve Failed</div>');
                        //setTimeout(function(){ location.reload(); }, 2000);
                    }
            }
        });
    });

    $('#confirm-submit').on('hidden.bs.modal', function () {
        location.reload();
    });

    $(document).on('click','.update-Information', function (){
        
        var count = 1, myArray = {}; courseList = {};
        var rowCount = 0; objCount = 0;
        
        $("#courseListRow").find('tr').each(function(i, e){
            ++rowCount;

            if ($('#radio1-'+count).is(":checked") || $('#radio2-'+count).is(":checked"))
            {
                ++objCount;
                $(this).removeClass('danger');

                var checkboxName = $('#radio1-'+count).attr('name'),
                checkboxValue    = $('input[name="'+checkboxName+'"]:checked').val();

                var str = checkboxName.split('[');
                str     = str[1].split(']');

                courseList[str[0]] = checkboxValue;
            
            } else {
                $(this).addClass('danger');
                Swal.fire('Please select Accepct/Reject.');
            }

            ++count;
        });

        if(objCount == rowCount)
        {
            var certifiedStatus = $("input[name='ssc_wbsctvesd_status']:checked").val();
			var sscInput		= $("#ssc-404").val();
			if( (typeof certifiedStatus !== 'undefined') || (sscInput == 404))
            {
                $('#certifiedStatusRow').removeClass('danger');
                
                myArray['courseList']       = courseList;
                myArray['certifiedStatus']  = certifiedStatus;
                myArray['assessor_id_hash'] = $("#assessor_id_hash").val();

                $('#applicationType').find("input[type='checkbox']").each(function(i, e) {

                    var checkboxName = $(this).attr('name'),
                    checkboxValue    = $("input[name='"+checkboxName+"']:checked").val();

                    if (typeof checkboxValue !== 'undefined'){
                        myArray[checkboxName] = checkboxValue;
                    } else {
                        myArray[checkboxName] = '';
                    }

                });

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to save the information.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            url: "council/assessor_list/updateAssessorCourseInformation",
                            data: {myArray: myArray}
                        })
                        .done(function(res){
                            // console.log(res);
                            Swal.fire('Updated!', 'Information updated, please wait a moment.', 'success');
                            location.reload();
                        })
                        .fail(function(){
                            Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                        });
                    }
                });
            
            } else {
                $('#certifiedStatusRow').addClass('danger');
                Swal.fire('Please select Accepct/Reject.');
            }
        }

    });

});