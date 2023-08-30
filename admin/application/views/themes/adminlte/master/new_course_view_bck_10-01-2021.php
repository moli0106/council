<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
    .star {
        color: red;
        font-size: 14px;
    }

    .mtop20 {
        margin-top: 20px;
    }

    .mbottom20 {
        margin-bottom: 20px;
    }

    .mright20 {
        margin-right: 20px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Council Course</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Council Course</li>
        </ol>
    </section>
    <section class="content">
        <?php if(isset($status)){ ?>

        <div class="alert alert-<?php echo $status ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message ?>
        </div>

        <?php } ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Entry form</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/new_course',array("id"=> "course_entry_form")) ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Sector *</label>
                            <select class="form-control select2" style="width: 100%;" name="sector_id">
                                <option value="">-- Select Sector --</option>
                                <?php foreach($sectors as $sector){ ?>
                                <option value="<?php echo $sector['sector_id_pk'] ?>"
                                    <?php echo set_select('sector_id',$sector['sector_id_pk']) ?>>
                                    <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('sector_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Course Name *</label>
                            <input type="text" class="form-control" name="course_name" id="course_name"
                                value="<?php echo set_value('course_name'); ?>" placeholder="Enter course name">
                            <?php echo form_error('course_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Course Code *</label>
                            <input type="text" class="form-control" name="course_code" id="sector_course_code"
                                value="<?php echo set_value('course_code'); ?>" placeholder="Enter course code">
                            <?php echo form_error('course_code'); ?>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="" for="">Course Description</label>
                            <input type="text" class="form-control" name="course_desc" id="course_desc"
                                value="<?php echo set_value('course_desc'); ?>" placeholder="Enter course description">
                            <?php echo form_error('course_desc'); ?>
                        </div>

                       
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Course category</label>
                            <select class="form-control select2" style="width: 100%;" name="course_category">
                                <option value="">-- Course category --</option>
                                <?php foreach($categories as $category){ ?>
                                <option value="<?php echo $category['course_category_id_pk'] ?>"
                                    <?php echo set_select('course_category',$category['course_category_id_pk']) ?>>
                                    <?php echo $category['category_name'] ?>
                                </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('course_category'); ?>
                        </div>
                    </div>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Domain specific working experience</label>
                            <textarea name="domain_specific_working_experience" class="form-control" rows="3" placeholder="Domain specific working experience"><?php echo set_value('domain_specific_working_experience'); ?></textarea>
                            <?php echo form_error('domain_specific_working_experience'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Trainer eligibility criteria</label>
                            <textarea name="trainer_eligibility_criteria" class="form-control" rows="3" placeholder="Trainer eligibility criteria"><?php echo set_value('trainer_eligibility_criteria'); ?></textarea>
                            <?php echo form_error('trainer_eligibility_criteria'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Minimum educational qualification</label>
                            <textarea name="minimum_educationl_qualification" class="form-control" rows="3" placeholder="Minimum educational qualification"><?php echo set_value('minimum_educationl_qualification'); ?></textarea>
                            <?php echo form_error('minimum_educationl_qualification'); ?>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Assessment experience</label>
                            <textarea name="assessment_experience" class="form-control" rows="3" placeholder="Assessment experience"><?php echo set_value('assessment_experience'); ?></textarea>
                            <?php echo form_error('assessment_experience'); ?>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Course List</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                <?php if(count($courses)){ ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Course Name</th>
                            <th>Course Code</th>
                            <th>Sector</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $offset + 1; foreach($courses as $course){ ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $course['course_name'] ?></td>
                            <td><?php echo $course['course_code'] ?></td>
                            <td><?php echo $course['sector_name'] ?> (<?php echo $course['sector_code'] ?>)</td>
                            <td class="action_buttons">
                                <a href="#" alt="<?php echo md5($course['course_id_pk']) ?>" class="btn btn-xs btn-primary view_course" data-toggle="modal" data-target="#myModal">View</a>
                                <!-- <a href="#" alt="<?php echo md5($course['course_id_pk']) ?>" class="btn btn-xs btn-primary edit_course" data-toggle="modal" data-target="#myModal">Edit</a> -->
                                <a href="#" alt="<?php echo md5($course['course_id_pk']) ?>" class="btn btn-xs btn-primary delete_course" data-toggle="modal" data-target="#myModal">Delete</a>
                                <a href="master/new_course/map_domain_qualification/<?php echo md5($course['course_id_pk']) ?>" alt="" class="btn btn-xs btn-info">Map Domain</a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    No data found
                <?php } ?>


            </div>
            <div class="box-footer">
                <?php echo $page_links ?>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>