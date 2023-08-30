<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li><a href="#studentInformation" data-toggle="tab">HS Question Code Details</a></li>
                </ul>
                <div class="tab-content" style="height: 270px;" id="custom-scrollbar">
                        <?php echo form_open_multipart("admin/question_set_master/question_hs_code/update", array("id" => "update-question-code-form")); ?>
                        <input type="hidden" name="question_code_id" value="<?php echo md5($hs_question_code['question_code_id_pk']); ?>">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Course</th>
                                    <td>
                                        <div class="form-group">
                                            <select name="course_id" id="course_id_update" class="form-control required">
                                                <option value="" hidden="true">Select Class</option>
                                                <?php foreach ($course_list as $course) { ?>
                                                    <option value="<?php echo $course['course_id_pk']; ?>" <?php if ($hs_question_code['course_id_fk'] == $course['course_id_pk']) echo 'selected'; ?>>
                                                        <?php echo $course['course_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Subject</th>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control required" id="subject_id_update" name="subject_id" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off">
                                                <option value="" hidden="true">Select Subject</option>
                                                <?php foreach ($subjectList as $subject) { ?>
                                                    <option value="<?php echo $subject['subject_id_pk'] ?>" <?php if ($hs_question_code['subject_id_fk'] == $subject['subject_id_pk']) echo 'selected'; ?>>
                                                        <?php echo $subject['subject_name']; ?> [<?php echo $subject['subject_code'] ?>]
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <tr>
                                <th><i class="fa fa-circle-o text-green"></i> Question Code</th>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control required" value="<?php echo $hs_question_code['question_code'] ?>" name="question_code">
                                        </div>
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <button type="button" class="btn btn-sm btn-info btn-flat" id="update-question-code">
                                            Update
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php echo form_close() ?>
                    
                </div>

            </div>
        </div>
    </div>

</section>