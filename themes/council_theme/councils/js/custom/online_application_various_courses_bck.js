


$(document).ready(function () {

  $('#dob').datepicker({
		startDate: '-1000y',
        endDate:'-18y',
		autoclose: true,
		format: 'dd/mm/yyyy'
		
		 });
  //$('#kanyashree').hide();
  $('#gender').change(function () {
    var gender = $("#gender option:selected").val();
    if (gender == 2) {
      $("#kanyashree").show();
    } else {
      $("#kanyashree").hide();
      $("#unique_id").hide();
    }
  });

  //$('#unique_id').hide();
  $('input[name=kanyashree]').change(function () {
    var value = $('input[name=kanyashree]:checked').val();
    if (value == 'yes') {
      $("#unique_id").show();
    } else {
      $("#unique_id").hide();
    }
  });

  $(document).on('change', '#state', function () {
    var state = $(this).val();

    getDistrictVal(state, '');
  });

  function getDistrictVal(state, dis) {
    if (state == 19) {
      $('.other_state_div').show();
    } else {
      $('.other_state_div').hide();
    }

    $.ajax({
      url: "online_application_various_courses/registration/getDistrict/" + state,
      dataType: "JSON",
    })
      .done(function (res) {
        var html = '';
        for (var i = 0; i < res.length; i++) {
          if (dis == res[i].district_id_pk) {
            var sel = "selected";
          } else {
            sel = '';
          }
          html += '<option ' + sel + ' value="' + res[i].district_id_pk + '" >' + res[i].district_name + ' </option>'

        }

        $('#district').html(html);

      })
      .fail(function () {
        console.log('error');
      });
  }

  $(document).on('change', '#district', function () {
    var district = $(this).val();
    // alert(district);
    getSubDivisionVal(district, '');

  });

  function getSubDivisionVal(district, subdiv) {
    $.ajax({
      url: "online_application_various_courses/registration/getSubDivision/" + district,
      dataType: "JSON",
    })
      .done(function (res) {

        var html = '';
        var subDivision = res.subDivision;
        console.log(subDivision);
        for (var i = 0; i < subDivision.length; i++) {
          if (subdiv == subDivision[i].subdiv_id_pk) {
            var sel = "selected";
          } else {
            sel = '';
          }
          html += '<option ' + sel + ' value="' + subDivision[i].subdiv_id_pk + '" >' + subDivision[i].subdiv_name + ' </option>'

        }


        $('#subDivision').html(html);
       
      })
      .fail(function () {
        console.log('error');
      });
  }

  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

    var log = numFiles > 1 ? numFiles + ' files selected' : label;
    $(this).parents('.input-group').find(':text').val(log);
  });

/** added by Abhijit 03-01-2023**/
$('#fullmark').on('input', function() {
        calculate();
      });
      $('#marks_obtain').on('input', function() {
       calculate();
      });
      function calculate(){
          var fullmark = parseInt($('#fullmark').val()); 
          var marks_obtain = parseInt($('#marks_obtain').val());
          var perc="";
          if(isNaN(fullmark) || isNaN(marks_obtain)){
              perc=" ";
             }else{
             perc = ((marks_obtain/fullmark) * 100).toFixed(3);
             }
  
          $('#percentage').val(perc);
    }


     $("#fullmark, #marks_obtain").on("keyup", function() {
        var fullmark = $("#fullmark").val();
        var marks_obtain = $("#marks_obtain").val();
        if (Number(marks_obtain) > Number(fullmark)) {
            // alert("Second value should less than first value");
            Swal.fire('Value of Obtain Marks should less than to value of Full marks')
            return true;
        }
    });

      $('#online_application_reg_form').on('submit', function(e){
        
        e.preventDefault();
        var fullmark = $('#fullmark').val();
          // alert(fullmark);
        var marks_obtain = $('#marks_obtain').val();
        if (Number(marks_obtain) > Number(fullmark)) {
            // alert("Second value should less than first value");
            Swal.fire('Value of Obtain Marks should less than to value of Full marks')
            return false;
        }else
        {

            this.submit();
        }
            
      
    });
/*** end of ABHIJIT ****/




});


