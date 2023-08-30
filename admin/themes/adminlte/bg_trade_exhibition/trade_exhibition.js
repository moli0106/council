$(document).ready(function(){

    $(document).on('click', '.created-by-remove-btn', function(){
        $(this).closest('.row').remove();
    });

    $(document).on('click', '.created-by-add-more-btn', function(){
        var remove_btn = '<br><button type="button" class="btn btn-flat btn-danger btn-sm created-by-remove-btn"><i class="fa fa-times" aria-hidden="true"></i></button>';
        var created_by_html = '<div class="row">' + $(this).closest('.row').html() + '</div>';
        
        $(this).parent('div').html(remove_btn);
        $('#created-by-div').append(created_by_html);
    });

    /*$(document).on('click','.submit-btn',function(){
        var error = 0;
        $('#trade-exhibition-form').find('input,textarea').each(function () {
                if ($(this).val() == '') {
                    $(this).removeClass('green-border');
                    $(this).addClass('red-border');
                    ++error;
                } else {
                    $(this).removeClass('red-border');
                    $(this).addClass('green-border');
                }
        });

        if (error == 0) {
            $('#trade-exhibition-form').submit();
        }
    });*/
});


// trade-exhibition-form