<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
     span.select2.select2-container.select2-container--default {
        width: 350px !important;
    }

    .select2-container--default.select2-container--focus, .select2-selection.select2-container--focus, .select2-container--default:focus, .select2-selection:focus, .select2-container--default:active, .select2-selection:active {
        outline: none;
        width: 350px !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation</li>
            <li class="active"><i class="fa fa-align-center"></i>Course Selection</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Course Selection</h3>
                <div class="box-tools pull-right">
                    
                </div>
            </div>
            <?php if (!empty($vtcDetails)) { ?>
                <div class="box-body">
                    <?php echo form_open('admin/affiliation/courses/detail/'. md5($course['vtc_course_id_pk']))?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="current_year">Current Year <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="current_year" value="<?php echo $academic_year; ?>" readonly="true">
                                <?php echo form_error('current_year'); ?>
                            </div>
                        </div>
                        <!-- </div>
                        <div class="row"> -->
                        <?php //if ($vtcDetails['hs_equivalent'] == 1) { 
                        ?>
                        <input type="hidden" value="<?php echo md5($course['vtc_course_id_pk'])?>" name="vtc_course_id_hash" id="vtcCourseId">

                        <input type="hidden" value="<?php echo $vtcDetails['hs_science']?>" name="hs_science" id="hs_science">
                        <input type="hidden" value="<?php echo $vtcDetails['hs_biology']?>" name="hs_biology" id="hs_biology">
                        <input type="hidden" value="<?php echo $vtcDetails['hs_commerce']?>" name="hs_comerce" id="hs_comerce">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="course_name_id">Course Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="course_name_id" id="course_name_id">
                                    <option value="" hidden="true">Select Course Name</option>
                                    <option value="1" <?php if ($course['course_name_id_fk']==1){echo 'selected';} ?>>HS-Voc</option>
                                    <option value="4" <?php if ($course['course_name_id_fk']==4){echo 'selected';} ?>>VIII+ STC</option>
                                </select>
                                <?php echo form_error('course_name_id'); ?>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Select Discipline<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="discipline" id="discipline">

                                    <?php if (!empty($course)) { ?>
                                       
                                        <option value="<?php echo $course['discipline_id_fk'] ?>" selected="true">
                                            <?php echo $course['discipline_name'] ?>
                                        </option>
                                       
                                    <?php } else { ?>
                                        <option value="" disabled="true">Select Course Name First...</option>
                                    <?php } ?>
                                    
                                </select>

                                <?php echo form_error('discipline'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Select group/trade <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="group_id" id="groupSelection">
                                   
                                    <?php if (!empty($course)) { ?>
                                       
                                       <option value="<?php echo $course['group_id_fk'] ?>" selected="true">
                                            <?php echo $course['group_name']?> [<?php echo $course['group_code']?>]
                                       </option>
                                      
                                   <?php } else { ?>
                                        <option value="" disabled="true">Select Discipline Name First...</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('group_id'); ?>
                            </div>
                        </div>
                        <?php //} 
                        ?>

                    </div>
                   
                    <div class="class-div" style="display:none">
                       <b><h4 style="margin-left:20px">Subject Selection</h4></b>
                       <hr>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="class_name">Select Class <span class="text-danger">*</span></label>
                                    <select class="form-control" name="class_name" id="class_name">
                                        <option value="" hidden="true">Select Class</option>
                                        <option value="1" <?php if ($course['class_name']==1){echo 'selected';} ?>>class-XI</option>
                                        <option value="2" <?php if ($course['class_name']==2){echo 'selected';} ?>>class-XII</option>
                                    </select>
                                    <?php echo form_error('class_name'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="category_id">Select Subject Category <span class="text-danger">*</span></label>
                                    <select class="form-control" name="category_id" id="category_id">

                                       <option value="" hidden="true">Select Subject Category</option>

                                        <?php if (!empty($course)) { ?>
                                       
                                            <option value="<?php echo $course['subject_category_id_fk'] ?>" selected="true">
                                                    <?php echo $course['subject_category_name']?>
                                            </option>
                                            
                                        <?php } else { ?>
                                            <option value="" disabled="true">Select Class Name First...</option>
                                        <?php } ?>

                                        
                                        
                                    </select>
                                    <?php echo form_error('category_id'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="subject_name_id">Select Subject Name <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="subject_name_id[]" id="subject_name_id" multiple="multiple">
                                        <?php foreach ($courseSubject as $val) { ?>
                                            <?php if(!empty($course)) {?>
                                                <option value="<?php echo $val['subject_name_id_fk'] ?>" <?php if (in_array($val['subject_name_id_fk'], $subjectArray)) {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>
                                                    <?php echo $val['subject_name'] ?> [<?php echo $val['subject_code'] ?>]
                                                </option>
                                            <?php } else {?>
                                                <option value="" hidden="true">Select Subject Category First...</option>
                                            <?php }?>
                                        <?php }?>
                                    
                                    </select>
                                    <?php echo form_error('subject_name_id'); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div> 
                        
                    <!-- </div> -->
                    <?php if ($vtcDetails['final_submit_status'] == 0) { ?>
                    <?php //if ($vtcDetails['final_submit_status'] != 0) { ?>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <label>&nbsp;</label><br>
                                <?php //if (empty($vtcCourses)) { ?>
                                    <button type="submit" class="btn btn-success btn-block btn-sm">Update Course Selection</button>
                                <?php //} ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php echo form_close() ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your Basic Details is not completed for academic year <span class="label label-success"><?php echo $academic_year; ?></span>
                </div>
            <?php } ?>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

