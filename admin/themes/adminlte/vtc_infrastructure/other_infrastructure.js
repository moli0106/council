$(document).ready(function() {

    $('.select2').select2();

    var electricity_available = $('input[name=electricity_available]:checked').val();
    phase3_supply(electricity_available);

    $(document).on('click', '.electricity-available', function() {

        var electricity_available = $('input[name=electricity_available]:checked').val();
        phase3_supply(electricity_available);
        // alert(electricity_available);
    });

    function phase3_supply(electricity_available) {

        if (electricity_available == 1) {
            $('.phase3-supply-div').show();
        } else {
            $('.phase3-supply-div').hide();
            // $('input[name=phase3_supply]:checked').val('');
        }
    }

    var internet_connection = $('input[name=internet_connect]:checked').val();
    show_connection_type(internet_connection);

    $(document).on('click', '.internet-connect', function() {

        var internet_connection = $('input[name=internet_connect]:checked').val();
        show_connection_type(internet_connection);
    });

    function show_connection_type(internet_connection) {

        if (internet_connection == 1) {
            $('.connection-type-div').show();
        } else {
            $('.connection-type-div').hide();
            $('#connection_type').val('');
        }
    }
});