$(document).ready(function() {

    var no_of_room = $('#no_of_room').val();
    // alert(no_of_room);
    showRoomDetailsBlock(no_of_room);

    $(document).on('keyup', '#no_of_room', function() {

        var no_of_room = parseInt($(this).val());

        showRoomDetailsBlock(no_of_room);

    });

    function showRoomDetailsBlock(no_of_room) {

        if (no_of_room != '' && no_of_room != undefined) {

            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {

                        $.ajax({
                                url: "vtc_infrastructure/class_room/getRoomDetailsBlock/" + no_of_room,
                                type: 'GET',
                                dataType: "json",
                            })
                            .done(function(res) {
                                $('.room-details-block').html(res);
                                Swal.close();
                            })
                            .fail(function(res) {
                                $('.room-details-block').html('');
                                Swal.fire('Warning!', 'Oops! Not able to get data.', 'warning');
                            });

                    }, 100);
                }
            });
        }
    }

    var no_of_lab = $('#no_of_lab').val();
    // alert(no_of_lab);
    showLabSizeBlock(no_of_lab);


    $(document).on('keyup', '#no_of_lab', function() {

        var no_of_lab = parseInt($(this).val());

        showLabSizeBlock(no_of_lab);
    });

    function showLabSizeBlock(no_of_lab) {

        if (no_of_lab != '' && no_of_lab != undefined) {

            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {

                        $.ajax({
                                url: "vtc_infrastructure/class_room/getLabSizeBlock/" + no_of_lab,
                                type: 'GET',
                                dataType: "json",
                            })
                            .done(function(res) {
                                $('.lab-size-block').html(res);
                                Swal.close();
                            })
                            .fail(function(res) {
                                $('.lab-size-block').html('');
                                Swal.fire('Warning!', 'Oops! Not able to get data.', 'warning');
                            });

                    }, 100);
                }
            });

        }
    }

});