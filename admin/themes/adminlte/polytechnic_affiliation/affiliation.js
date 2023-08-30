$(document).ready(function () {
    $(document).on('click', '#add_affiliation_intake_btn', function(e) {
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
  

    $(document).on('click', '#teacher_add_btn', function(e) {
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

    $(document).on('click', '#add_class_intake_btn', function(e) {
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

    $(document).on('click', '#add_lab_intake_btn', function(e) {
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

     $(document).on('click', '#add_library_intake_btn', function(e) {
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

     $(document).on('click', '#add_mand_btn', function(e) {
        var error = 0;

        $(this).closest('form').find('select').each(function() {
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


     $(document).on('click', '#upload_file_btn', function(e) {
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

    function isNumberValid(evt)
   {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
         return false;
      return true;
   }
   
    $('#tnc').click(function () {
        //check if checkbox is checked
        if ($(this).is(':checked')) {
            // alert("hii");
            
            $('.pay_btn').css('display','block'); //enable input
            $('.edit_btn').css('display','none');
            
        } else {
            $('.pay_btn').css('display','none'); //disable input
            $('.edit_btn').css('display','block');
        }
    });
	
	$('input[name=ins_type]').change(function(){
        var value = $( 'input[name=ins_type]:checked' ).val();
        if (value != 4) {
            $('.eligable_text').show();
        }else{
            $('.eligable_text').hide();
        }
    });
	
	$(document).on('change', '#engagement_type', function() {

        var engagement_type = $(this).val();
        //alert(engagement_type);
        if(engagement_type == "Other"){
            $('.other_faculty').show();
        }else{
            $('.other_faculty').hide();
        }
    });


});