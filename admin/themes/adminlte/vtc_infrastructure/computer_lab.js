$(document).ready(function() {

    var lab_present = $('input[name=lab_present]:checked').val();
    computer_available(lab_present);

    $(document).on('click', '.lab-present', function() {

        var lab_present = $('input[name=lab_present]:checked').val();
        computer_available(lab_present);
        // alert(lab_present);
    });

    function computer_available(lab_present) {

        if (lab_present == 1) {
            $('.computer-no-div').show();
        } else {
            $('.computer-no-div').hide();
            $('#no_of_computer').val('');
            $('#working_computer').val('');
        }
    }


    $("#no_of_computer, #working_computer").on("keyup", function() {
        var no_of_computer = $("#no_of_computer").val();
        var working_computer = $("#working_computer").val();
        if (Number(working_computer) > Number(no_of_computer)) {
            // alert("Second value should less than first value");
            Swal.fire('Working computer value should less than or equal to no of computer value')
            return true;
        }
    });

    $('#computer_form').submit(function() {
        var no_of_computer = $("#no_of_computer").val();
        var working_computer = $("#working_computer").val();
        if (Number(working_computer) > Number(no_of_computer)) {
            // alert("Second value should less than first value");
            Swal.fire('Working computer value should less than or equal to no of computer value')
            return false;
        } else {
            return true;
        }
    });

    $(document).on('click', '.uptd-lab-btn', function(e) {


        var error = 0;
        var lab_present = $('input[name=lab_present]:checked').val();
        if (lab_present == 1) {

            var no_of_computer = $("#no_of_computer").val();
            var working_computer = $("#working_computer").val();

            if (no_of_computer == '' || working_computer == '') {

                $("#no_of_computer").removeClass('green-border');
                $("#no_of_computer").addClass('red-border');

                $("#working_computer").removeClass('green-border');
                $("#working_computer").addClass('red-border');

                ++error;
            } else {
                $("#no_of_computer").removeClass('red-border');
                $("#no_of_computer").addClass('green-border');

                $("#working_computer").removeClass('red-border');
                $("#working_computer").addClass('green-border');
            }
        }
        if (error) {
            e.preventDefault();
        }
    });
});