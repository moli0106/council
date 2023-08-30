 <!-- ---------- -->
 <div class="row experience_section">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">Job Role</label>
                            <select class="form-control" name="exp_as_assessor_job_role[<?php echo $count_experience_section ?>]">
                                <option value="">-- Select Job Role --</option>
                                <?php foreach($assessor_courses as $assessor_course) { ?>
                                <option value="<?php echo $assessor_course["course_id_pk"] ?>" <?php echo set_select("exp_as_assessor_job_role[".$count_experience_section."]",$assessor_course["course_id_pk"]) ?>><?php echo $assessor_course["course_name"] ?> (<?php echo $assessor_course["course_code"] ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">NSQF Level</label>
                            <input type="text" value="" name="nsqf_level[<?php echo $count_experience_section ?>]" class="form-control" placeholder="NSQF Level">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">No of Years</label>
                            <input type="text" value="" name="exp_as_assessor_work_years[<?php echo $count_experience_section ?>]" class="form-control" placeholder="No of Years">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">No of Months</label>
                            <input type="text" value="" name="exp_as_assessor_work_months[<?php echo $count_experience_section ?>]" id="work_months" class="form-control" placeholder="No of Months">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Upload doc (PDF only, 50KB Max)</label>
                            <input type="file" class="form-control" placeholder="Doc" name="exp_as_assessor_doc_<?php echo $count_experience_section ?>" ">
                            <?php echo form_error('photo'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label><br>
                            <button type="button" class="btn btn-danger remove_experiance_as_assessor"><i class="fa fa-times" aria-hidden="true"></i></button> 
                        </div>   
                    </div>
                </div>