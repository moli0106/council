$(document).ready(function() {

    $('.select2').select2();

    var aplicable_no = $('input[name=aplicable_no]:checked').val();
    showQuestionBlock(aplicable_no);

    $(document).on('click', '.present-aplicable', function() {

        var aplicable_no = $('input[name=aplicable_no]:checked').val();
        showQuestionBlock(aplicable_no);

    });

    function showQuestionBlock(aplicable_no) {
        if (aplicable_no == 1) {
            $('.lab-size-div').show();
            $('.equipment-doc-div').show();
        } else {
            $('.lab-size-div').hide();
            $('.equipment-doc-div').hide();
        }
    }
    var cmnLabId = $('#cmn_id_hash').val();

    var course_name_id = $('#course_name_id').val();
    if(course_name_id!=null && course_name_id!='' && course_name_id!=undefined){

        getDisciplineName(course_name_id, cmnLabId);
    }

    $('#course_name_id').on('change', function() {
        var cmnLabId = $('#cmn_id_hash').val();
        var course_name_id = $('#course_name_id').val();
        getDisciplineName(course_name_id, cmnLabId);
    });

    function getDisciplineName(course_name_id, cmnLabId) {

        $.ajax({
                url: 'vtc_infrastructure/common_laboratory/getDisciplineName/' + course_name_id,
                data: { 'cmnLabId': cmnLabId },
                dataType: "json",
            })
            .done(function(response) {
                $('#discipline_id').html(response);
            })

    }

    var discipline_id = $('#discipline_id').val();
    if(discipline_id!=null && discipline_id!='' && discipline_id!=undefined){

        getInfrastructureByDisciplineId(discipline_id, cmnLabId, course_name_id);
    }


    $('#discipline_id').on('change', function() {
        var discipline_id = $(this).val();
        var cmnLabId = $('#cmn_id_hash').val();
        var course_name_id = $('#course_name_id').val();
        getInfrastructureByDisciplineId(discipline_id, cmnLabId, course_name_id);
    });

    function getInfrastructureByDisciplineId(discipline_id, cmnLabId, course_name_id) {

        $.ajax({
                url: 'vtc_infrastructure/common_laboratory/getInfrastructureItem/' + discipline_id,
                data: { 'cmnLabId': cmnLabId, 'course_name_id': course_name_id },
                dataType: "json",
            })
            .done(function(response) {
                $('#item_id').html(response);
            })
    }

    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        var log = numFiles > 1 ? numFiles + ' files selected' : label;
        $(this).parents('.input-group').find(':text').val(log);
    });
})