$(document).ready(function () {

    $(document).on('click','.final_save_btn',function(){
        Swal.fire({
            title: 'Warning!<br>Once submitted, You can not make any change in institute selection.',
            text: "Please verify  and then submit.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Saving the data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $('#choice-filling-form').submit();
                        }, 100);
                    }
                })
            }
        });
    })

    $(document).on('click','.print', function () {
        //alert(1111);
        $(".print_details").print(/*options*/);
    });
});