$(document).ready(function () {
    $(document).on("click",".approve_assessor", function () {
        $(".modal-title").html("Approve Assessor");
        var page = $(this).attr("alt");
        var assessor_id_hash = $(this).attr("href");

        // alert(page);
        // alert(assessor_id_hash);
        $.ajax({
            type: "GET",
            url: "council/assessor_list/approve_assessor/"+assessor_id_hash,
            success: function (response) {
                $(".modal-body").html(response);
            }
        });
    });
    $(document).on("click",".reject_assessor", function () {
        $(".modal-title").html("Reject Assessor");
        var page = $(this).attr("alt");
        var assessor_id_hash = $(this).attr("href");

        // alert(page);
        // alert(assessor_id_hash);
        $.ajax({
            type: "GET",
            url: "council/assessor_list/reject_assessor/"+assessor_id_hash,
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
});