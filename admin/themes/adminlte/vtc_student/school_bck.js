$(document).ready(function () {

    $(document).on('change', '#district', function () {
        var district = $(this).val();

        $.ajax({
            url: "cssvse/school/getMunicipality/" + district,
            dataType: "JSON",
        })
            .done(function (res) {
                console.log(res);
                // $('#municipality').html(res);
            })
            .fail(function () {
                console.log('error');
            });
    });

});