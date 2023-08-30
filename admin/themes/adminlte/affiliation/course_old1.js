$(document).ready(function() {

    $('.select2').select2();

    var course_name_id = $('#course_name_id').val();
    
    var vtcCourseId = $('#vtcCourseId').val();

    var discipline = $('#discipline').val();
    var class_name = $('#class_name').val();

    var group =  $('#groupSelection').val();

    var hs_science = $('#hs_science').val();
    var hs_biology = $('#hs_biology').val();
    var hs_comerce = $('#hs_comerce').val();
    

   
    showClassDiv(course_name_id);

    if(course_name_id!=undefined && course_name_id!= ''){

        getDisciplineByCourseName(course_name_id , vtcCourseId, hs_science, hs_biology, hs_comerce);
    }

    $(document).on('change', '#course_name_id', function() {
        
        var course_name_id = $(this).val();
        // alert(vtcCourseId);
        showClassDiv(course_name_id);
        getDisciplineByCourseName(course_name_id , vtcCourseId, hs_science, hs_biology, hs_comerce);
    });

    function showClassDiv(course_name_id){
        if(course_name_id == 1){
            $('.class-div').show();
        }else{
            $('.class-div').hide();
        }
    }

    

    // alert(vtcCourseId);
    

    function getDisciplineByCourseName(course_name_id , vtcCourseId, hs_science, hs_biology, hs_comerce){

        
        $.ajax({
                url: "affiliation/courses/getDisciplineByCourseName/" + course_name_id,
                dataType: "JSON",
                data : {vtcCourseId : vtcCourseId, hs_science:hs_science, hs_biology:hs_biology, hs_comerce:hs_comerce}
            })
            .done(function(res) {
                $('#discipline').html(res);
            })
            .fail(function() {
                console.log('error');
            });
    }

    if((course_name_id!=undefined && discipline!=undefined) && (course_name_id!='' && discipline!='')){

        getGroupByDiscipline(discipline, course_name_id, vtcCourseId, hs_science, hs_biology, hs_comerce );
    }

    $(document).on('change', '#discipline', function() {

        var discipline = $(this).val();
        var course_name_id = $('#course_name_id').val();
        var class_name = $('#class_name').val();
        getGroupByDiscipline(discipline, course_name_id, vtcCourseId, hs_science, hs_biology, hs_comerce );
        
        
    });
    function getGroupByDiscipline(discipline, course_name_id, vtcCourseId, hs_science, hs_biology, hs_comerce ){

        $.ajax({
            url: "affiliation/courses/getEquivalentGroupByDiscipline",
            type: 'GET',
            dataType: "json",
            data: { discipline: discipline, course_name_id: course_name_id, vtcCourseId:vtcCourseId, hs_science:hs_science, hs_biology:hs_biology, hs_comerce:hs_comerce },
        })
        .done(function(res) {
            // console.log(res);
            $('#groupSelection').html(res);
            Swal.close()
        })
        .fail(function() {
            console.log('error');
        });
    }
    
    // alert(group);
    if(course_name_id!=undefined && group !=undefined && discipline!=undefined){

        // getSubCategory(group, discipline, course_name_id, vtcCourseId, class_name );
    }

    $(document).on('change', '#groupSelection', function() {
        var group = $(this).val();
        var discipline = $('#discipline').val();
        var course_name_id = $('#course_name_id').val();
        var class_name = $('#class_name').val();
        // getSubCategory(group,discipline, course_name_id, vtcCourseId, class_name );
        
        
    });

    function getSubCategory(group,discipline, course_name_id, vtcCourseId, class_name ){

        $.ajax({
            url: "affiliation/courses/getSubjectCategory",
            type: 'GET',
            dataType: "json",
            data: { group:group, discipline: discipline, course_name_id: course_name_id, class_name: class_name, vtcCourseId:vtcCourseId },
        })
        .done(function(res) {
            $('#category_id').html(res);
            Swal.close()
        })
        .fail(function() {
            console.log('error');
        });
    }

    var category_id = $('#category_id').val();

    if((category_id !=undefined && group !=undefined ) && (category_id !='' && group !='')){

        // getSubjectList(category_id, group,discipline, course_name_id, vtcCourseId, class_name );
        getSubjectList(category_id, group, class_name );
    }

    $(document).on('change', '#category_id', function(){

        var category_id = $(this).val();
        var group = $('#groupSelection').val();
        var discipline = $('#discipline').val();
        var course_name_id = $('#course_name_id').val();
        var class_name = $('#class_name').val();
        // getSubjectList(category_id, group,discipline, course_name_id, vtcCourseId, class_name );
        getSubjectList(category_id, group, class_name );
    });

    function getSubjectList(category_id, group, class_name ){

        $.ajax({
            url: "affiliation/subject/getSubjectList",
            type: 'GET',
            dataType: "json",
            data: { category_id: category_id, group:group, class_name: class_name },
        })
        .done(function(res) {
            $('#subject_name_id').html(res);
            Swal.close()
        })
        .fail(function() {
            console.log('error');
        });
    }


    $(document).on('click', '#course-selection-btn', function() {

        var group_id = $('#groupSelection').val();
        var course_name_id = $('#course_name_id').val();
        if(group_id.length > 4){

            Swal.fire('Group/Trade should less than or equal to no of 4')
            
            return false;
        }else{

            Swal.fire({
                title: 'Warning!<br>Once submitted, You can not make any change in course selection.',
                text: "Please verify Group/Trade code and then submit.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Submit it!',
                allowEscapeKey: false,
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "affiliation/courses/getGroupCount",
                        type: 'GET',
                        dataType: "json",
                        data: { group_id: group_id, course_name_id:course_name_id },
                    }) .done(function(response) {
                        
                        if (response == 'done') {

                            
                            Swal.fire({
                                title: 'Please wait a moment!',
                                html: 'Saving the data...',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
            
                                    setTimeout(function() {
                                        $('#course-selection-form').submit();
                                    }, 100);
                                }
                            })
                        } else {
                           
                            Swal.fire('Warning!', response.msg, 'warning');
                        }
                    })
                }
            });
        }
        
    });

   

    $(document).on('click', '#subject-selection-btn', function() {
        Swal.fire({
            title: 'Warning!<br>Once submitted, You can not make any change in subject selection.',
            text: "Please verify Group/Trade code and subject and then submit.",
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
                            $('#subject-selection-form').submit();
                        }, 100);
                    }
                })
            }
        });
    });

    $(document).on('click', '.deleteVtcCourse', function(){

        var this_tr = $(this).closest('tr');
        var id_hash = this_tr.prop('id');

        Swal.fire({
            title: 'Warning!<br>Are You Sure? Delete it.',
            text: "You will not able to revert it back.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#00a65a',
            confirmButtonText: 'Yes! Delete it.',
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Removing Course...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "affiliation/courses/removeVtcCourse",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { id_hash: id_hash }
                                })
                                .done(function(response) {

                                    if (response == 'done') {

                                        this_tr.remove();
                                        Swal.fire('Success!', 'Group/Trade removed successfully.', 'success');
                                    }else{
                                        Swal.fire('Warning!', response.msg, 'warning');
                                    }
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                });
                        }, 100);
                    }
                });
            }
        });
    });

    $(document).on('click', '.deleteVtcSubject', function(){

        var this_tr = $(this).closest('tr');
        var id_hash = this_tr.prop('id');

        Swal.fire({
            title: 'Warning!<br>Are You Sure? Delete it.',
            text: "You will not able to revert it back.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#00a65a',
            confirmButtonText: 'Yes! Delete it.',
            allowEscapeKey: false,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Removing Subject...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "affiliation/subject/removeVtcSubject",
                                    type: 'GET',
                                    dataType: "json",
                                    data: { id_hash: id_hash }
                                })
                                .done(function(response) {

                                    if (response == 'done') {

                                        this_tr.remove();
                                        Swal.fire('Success!', 'Subject removed successfully.', 'success');
                                    }else{
                                        Swal.fire('Warning!', response.msg, 'warning');
                                    }
                                    
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                });
                        }, 100);
                    }
                });
            }
        });
    })

    $(document).on('change', '#groupSelection', function(){
        var group_id = $(this).val();
        if(group_id.length > 4){

            Swal.fire('Group/Trade should less than or equal to no of 4')
            
            return true;
        }
    });

    //12-07-2022

    $(document).on('click', '#resetCourseSelection', function() {
        Swal.fire({
            title: 'Warning!<br>Once Reset, Your Course, Subject, Teacher & Student data will be erased.',
            text: "You will not able to revert it back.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Erase it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Erasing the data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "affiliation/courses/resetAllCourse",
                                    type: 'GET',
                                    dataType: "json",
                                })
                                .done(function(response) {
                                    location.reload();
                                    // console.log(response);
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                });
                        }, 100);
                    }
                })
            }
        });
    });

    $(document).on('click', '#resetSubjectSelection', function() {
        Swal.fire({
            title: 'Warning!<br>Once Reset, Your  Subject, Teacher Subject Map data will be erased.',
            text: "You will not able to revert it back.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Erase it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'Erasing the data...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {
                            $.ajax({
                                    url: "affiliation/subject/resetAllSubject",
                                    type: 'GET',
                                    dataType: "json",
                                })
                                .done(function(response) {
                                    location.reload();
                                    // console.log(response);
                                })
                                .fail(function(res) {
                                    Swal.fire('Warning!', 'Oops! Something went wrong.', 'warning');
                                });
                        }, 100);
                    }
                })
            }
        });
    });

    //12-07-2022


    // 18-07-2022

    

    if(class_name !='' && class_name!=null && class_name!=undefined){
        var group_id = $('#groupSelection').val();
        // getAllSubjectAndCategory(class_name, group_id);
    }

    $(document).on('change', '#class_name', function() {

        var class_name_id = $(this).val();
        var group_id = $('#groupSelection').val();
        getAllSubjectAndCategory(class_name_id, group_id);

    });

    function getAllSubjectAndCategory(class_name_id, group_id){

        $.ajax({
            url: "affiliation/subject/getAllSubjectAndCategory",
            type: 'GET',
            dataType: "json",
            data: { class_name_id:class_name_id, group_id:group_id },
        })
        .done(function(res) {
            $('.all_sub_cat').html(res);
            Swal.close()
        })
        .fail(function() {
            console.log('error');
        });


    }
    // 18-07-2022

});