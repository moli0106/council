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
            if (result.isConfirmed) {
                Swal.fire('Work in Progress!', 'We are working on it.', 'success');
                $.ajax
            }
        });
    })

});