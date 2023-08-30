$(document).ready(function() {

    $(document).on('click','.view_discipline',function(){
        alert ('hhh');
        var discipline_id_hash = $(this).attr("alt");
        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.discipline_data').html(loader);
        $.ajax({
                url: "polytechnic_master/discipline/discipline_details/" + discipline_id_hash,
                type: 'GET',
                dataType: "json",
            })
            .done(function(res) {
                $('.discipline_data').html(res);
                $('.select2').select2();
            })
            .fail(function(res) {
                $('#modal-infra-item-details').modal('toggle');
                Swal.fire('Warning!', 'Oops! Unable to get Discipline details, Please try later.', 'warning');
            });
    });

    $(document).on('click', '#update-discipline-btn', function(e) {
        var error = 0;

        $(this).closest('form').find('input').each(function() {
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