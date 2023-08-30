$(document).ready(function () {
    
    $('.select2').select2();

    $(document).on('click', '.getResult', function(){

        var assessor_id = $(this).closest("tr").prop("id");
        var batch_id = $(this).closest("tr").prop("class");

        // alert(assessor_id);
        // alert(batch_id);

        $.ajax({
            url: "assessor_ems/assessor_batch_result/getResult",
            type: 'GET',
            dataType: "json",
            data: {assessor_id: assessor_id,batch_id: batch_id},
        })
        .done(function(response) {
            $("#resultDetails").html(response);
        })
        .fail(function(res) {
            $('#myModalList').modal('toggle');
            Swal.fire('Error!', 'Oops! Something went wrong', 'error'); 
        });
    });


//For Accept resulr
    $(document).on("click",".approve_assessor_result", function () {
        $(".modal-title").html("Accept Assessor Result");
        var batch_id_hash = $(this).attr("alt");
        var assessor_id_hash = $(this).attr("href");

        //alert(batch_id_hash);
       //alert(assessor_id_hash);
        $.ajax({
            type: "GET",
            url: "assessor_ems/assessor_batch_result/approve_assessor_result/"+assessor_id_hash+"/"+batch_id_hash,
            success: function (response) {
                $(".result_accept_revert_content").html(response);
            }
        });
    });

    
    $(document).on("click",".reject_assessor_result", function () {
        $(".modal-title").html("Revert Assessor Result");
        var batch_id_hash = $(this).attr("alt");
        var assessor_id_hash = $(this).attr("href");

        // alert(page);
        // alert(assessor_id_hash);
        $.ajax({
            type: "GET",
            url: "assessor_ems/assessor_batch_result/reject_assessor_result/"+assessor_id_hash+"/"+batch_id_hash,
            success: function (response) {
                $(".result_accept_revert_content").html(response);
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
            $(".result_accept_revert_content").html(response);
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
          $(".result_accept_revert_content").html(response);
        }
    });
 });

});