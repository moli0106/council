<?php echo form_open('admin/council/new_course/edit_course/'. $course_id_hash,array("id"=> "course_edit_form")) ?>
<?php print_r($_POST) ?>
<input type="hidden" name="course_id" id="input_course_id" class="form-control" value="<?php echo $course_id_hash ?>">

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Course Name</label>
            <input type="text" class="form-control" name="course_name" id="course_name"
                value="<?php echo $course['course_name']; ?>" placeholder="Enter course name">
            <?php echo form_error('course_name'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Course Code</label>
            <input type="text" class="form-control" name="course_code" id="sector_course_code"
                value="<?php echo $course['course_code']; ?>" placeholder="Enter course code">
            <?php echo form_error('course_code'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Course Description</label>
            <input type="text" class="form-control" name="course_desc" id="course_desc"
                value="<?php echo $course['course_description']; ?>" placeholder="Enter course description">
            <?php echo form_error('course_desc'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Sector</label>
            <select class="form-control select2" style="width: 100%;" name="sector_id">
                <option value="">-- Select Sector --</option>

                <?php if($this->input->method(TRUE) == "GET"){ ?>
                    <?php foreach($sectors as $sector){ ?>
                    <option value="<?php echo $sector['sector_id_pk'] ?>"
                        <?php echo $sector['sector_id_pk'] === $course['sector_id_fk'] ? 'selected="selected"' : ""; ?>>
                        <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)</option>
                    <?php } ?>
                <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                    <?php foreach($sectors as $sector){ ?>
                    <option value="<?php echo $sector['sector_id_pk'] ?>"
                        <?php echo set_select('sector_id',$sector['sector_id_pk']) ?>>
                        <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)</option>
                    <?php } ?>
                <?php } ?>
               
            </select>
            <?php echo form_error('sector_id'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Trainer eligibility criteria</label>
            <input type="text" class="form-control" name="trainer_eligibility_criteria"
                id="sector_sector_codedesc"
                value="<?php echo $course['trainer_eligibility_criteria']; ?>"
                placeholder="Trainer eligibility criteria">
            <?php echo form_error('trainer_eligibility_criteria'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Minimum educational qualification</label>
            <input type="text" class="form-control" name="minimum_educationl_qualification"
                id="minimum_educationl_qualification"
                value="<?php echo $course['minimum_educationl_qualification']; ?>"
                placeholder="Minimum educationl qualification">
            <?php echo form_error('minimum_educationl_qualification'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Domain specific working experience</label>
            <input type="text" class="form-control" name="domain_specific_working_experience"
                id="sector_sector_codedesc"
                value="<?php echo $course['domain_specific_working_experience']; ?>"
                placeholder="Trainer eligibility criteria">
            <?php echo form_error('domain_specific_working_experience'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Assessment experience</label>
            <input type="text" class="form-control" name="assessment_experience"
                id="assessment_experience" value="<?php echo $course['assessment_experience']; ?>"
                placeholder="Assessment experience">
            <?php echo form_error('assessment_experience'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Course category</label>
            <select class="form-control select2" style="width: 100%;" name="course_category">
                <option value="">-- Course category --</option>
                <?php if($this->input->method(TRUE) == "GET"){ ?>
                     <?php foreach($categories as $category){ ?>
                    <option value="<?php echo $category['course_category_id_pk'] ?>"
                        <?php echo $category['course_category_id_pk'] === $course['course_category_id_fk'] ? 'selected="selected"' : ""; ?>>
                        <?php echo $category['category_name'] ?> (<?php echo $category['course_rate'] ?>)
                    </option>
                    <?php } ?>
                <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                    <?php foreach($categories as $category){ ?>
                    <option value="<?php echo $category['course_category_id_pk'] ?>"
                        <?php echo set_select('course_category',$category['course_category_id_pk']) ?>>
                        <?php echo $category['category_name'] ?> (<?php echo $category['course_rate'] ?>)
                    </option>
                    <?php } ?>
                <?php } ?>
               
            </select>
            <?php echo form_error('course_category'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Project Type</label>
            <select class="form-control select2" style="width: 100%;" name="project_type">
                <option value="">-- Project types --</option>
                <?php foreach($project_types as $project_type){ ?>
                <option value="<?php echo $project_type['project_type_id_pk'] ?>"
                    <?php echo set_select('project_type',$project_type['project_type_id_pk']) ?>>
                    <?php echo $project_type['project_type_name'] ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('project_type'); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 course_edit_submit">
        <button type="submit" class="btn btn-primary pull-right submit_edit">Submit</button>
    </div>
</div>
<?php echo form_close() ?>