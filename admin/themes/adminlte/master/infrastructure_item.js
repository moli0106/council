$(document).ready(function() {

    $('.select2').select2();

    var course_name_id = $('#course_name_id').val();
    var discipline_id = $('#discipline_list').val();
    getGroupList(course_name_id, discipline_id);

    $('#discipline_list').on('change', function() {


        var course_name_id = $('#course_name_id').val();
        var discipline_id = $(this).val();
        getGroupList(course_name_id, discipline_id)
    });

    function getGroupList(course_name_id, discipline_id) {

        $.ajax({
                url: 'master/infrastructure/getGroupList',
                dataType: "json",
                data: { course_name_id: course_name_id, discipline_id: discipline_id }
            })
            .done(function(response) {
                $('#group_list').html(response);
            })


    }


    // !----------- Delete Infrastructure Item -------------! //

    $(document).on('click', '.delete-infra-item-btn', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this Ifrastructure Item!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $('#itemDelete').submit();
                // var id_hash = $(this).closest('tr').prop('id');

                // $.ajax({
                //         url: "master/infrastructure/delete_infrastructure_item/" + id_hash,
                //         type: 'GET',
                //         dataType: "json",
                //     })
                //     .done(function(response) {
                //         // console.log(response);
                //         if (response == 'done') {
                //             //$('#' + id_hash).remove();
                //             $('.itemDelete').closest("tr[id=" + id_hash + "]").remove();
                //             Swal.fire('Success!', 'Infrastructure Item has been removed.!', 'success');
                //             window.load();
                //         }
                //     })
                //     .fail(function(res) {

                //         Swal.fire('Error!', 'Oops! Unable to remove Infrastructure Item.', 'error');
                //     });
            }
        })
    });


    // !----------- Get Infrastructure Item Details-------------! //

    $(document).on('click', '.infra-item-details-btn', function() {

        var id_hash = $(this).closest('tr').prop('id');

        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.infra-item-data').html(loader);
        $.ajax({
                url: "master/infrastructure/infrastructure_item_details/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(res) {
                $('.infra-item-data').html(res);
                $('.select2').select2();
            })
            .fail(function(res) {
                $('#modal-infra-item-details').modal('toggle');
                Swal.fire('Warning!', 'Oops! Unable to get Infrastructure item details, Please try later.', 'warning');
            });
    });

    $(document).on('click', '.delete-infrastructure-btn', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this mapping!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {


                var id_hash = $(this).closest('tr').prop('id');

                $.ajax({
                        url: "master/infrastructure/delete_infrastructure_map/" + id_hash,
                        type: 'GET',
                        dataType: "json",
                    })
                    .done(function(response) {
                        // console.log(response);
                        if (response == 'done') {
                            //$('#' + id_hash).remove();
                            $('.mydelete').closest("tr[id=" + id_hash + "]").remove();
                            Swal.fire('Success!', 'Infrastructure Map has been removed.!', 'success');
                        }



                    })
                    .fail(function(res) {

                        Swal.fire('Error!', 'Oops! Unable to remove Infrastructure Map.', 'error');
                    });
            }
        })
    });

    $(document).on('click', '.infra-map-details-btn', function() {

        var id_hash = $(this).closest('tr').prop('id');

        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.infra-map-data').html(loader);
        $.ajax({
                url: "master/infrastructure/infrastructure_map_details/" + id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(res) {
                $('.infra-map-data').html(res);
                $('.select2').select2();
            })
            .fail(function(res) {
                $('#modal-infra-map-details').modal('toggle');
                Swal.fire('Warning!', 'Oops! Unable to get Infrastructure map details, Please try later.', 'warning');
            });
    });

    $(document).on('click', '#update-infrastructure-item-btn', function(e) {
        var error = 0;

        $(this).closest('form').find('input,select').each(function() {
            if ($(this).hasClass('required')) {
                if ($(this).val() == '') {
                    $(this).removeClass('green-border');
                    $(this).addClass('red-border');
                    ++error;
                } else {
                    $(this).removeClass('red-border');
                    $(this).addClass('green-border');
                }
            }
        });

        if (error) {
            e.preventDefault();
        }
    });


})