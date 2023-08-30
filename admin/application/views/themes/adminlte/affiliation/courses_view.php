<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    
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
        <?php if (!empty($vtcDetails)) { ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Course Selection</h3>
                            <div class="box-tools pull-right">
                                <?php //if ((!empty($vtcCourseList)) && ($vtcDetails['final_submit_status'] != 0)) { ?>
                                <?php if ((!empty($vtcCourseList)) && ($vtcDetails['final_submit_status'] == 0)) { ?>
                                    <button class="btn btn-danger btn-sm" id="resetCourseSelection">Reset Course Selection</button>
                                <?php } ?>
                            </div>
                        </div>
                    
                            <div class="box-body">
                                <?php echo form_open('admin/affiliation/courses', array('id' => 'course-selection-form')) ?>
                                <?php //echo form_open('admin/affiliation/courses/new_course', array('id' => 'course-selection-form')) ?>

                                <?php //if(empty($course)){?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="" for="current_year">Current Year <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="current_year" value="<?php echo $current_academic_year; ?>" readonly="true">
                                                <?php echo form_error('current_year'); ?>
                                            </div>
                                        </div>
                                        <!-- </div>
                                        <div class="row"> -->
                                            <?php //if ($vtcDetails['hs_equivalent'] == 1) { 
                                            ?>

                                        <input type="hidden" value="" name="vtc_course_id_hash" id="vtcCourseId">
                                        <input type="hidden" value="<?php echo $vtcDetails['hs_science']?>" name="hs_science" id="hs_science">
                                        <input type="hidden" value="<?php echo $vtcDetails['hs_biology']?>" name="hs_biology" id="hs_biology">
                                        <input type="hidden" value="<?php echo $vtcDetails['hs_commerce']?>" name="hs_comerce" id="hs_comerce">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="" for="course_name_id">Course Name <span class="text-danger">*</span></label>
                                                <select class="form-control" name="course_name_id" id="course_name_id">
                                                    <option value="" hidden="true">Select Course Name</option>
                                                    <option value="1" <?php echo set_select('course_name_id', 1) ?>>HS-Voc</option>
                                                    <option value="4" <?php echo set_select('course_name_id', 4) ?>>VIII+ STC</option>
                                                </select>
                                                <?php echo form_error('course_name_id'); ?>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="" for="">Select Discipline<span class="text-danger">*</span></label>
                                                <select class="form-control" name="discipline" id="discipline">
                                                    <option value="" hidden="true">Select Discipline</option>
                                                    <option value="" disabled="true">Select Course Name First...</option>
                                                </select>

                                                <?php echo form_error('discipline'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="" for="groupSelection">Select group/trade <span class="text-danger">*</span></label>
                                                <select class="form-control select2" name="group_id[]" id="groupSelection" multiple="multiple">
                                                
                                                    <option value="" hidden="true">Select group/trade</option>
                                                    <option value="" disabled="true">Select Discipline Name First...</option>
                                                    
                                                </select>
                                                <?php echo form_error('group_id[]'); ?>
                                            </div>
                                        </div>
                                        <?php //} 
                                        ?> 
                                    </div>
                                
                                    <?php /*
                                    <div class="class-div" style="display:none">
                                        <b><h4 style="margin-left:20px">Subject Selection</h4></b>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="" for="class_name">Select Class <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="class_name" id="class_name">
                                                        <option value="" hidden="true">Select Class</option>
                                                        <option value="1" <?php echo set_select('class_name', 1) ?>>class-XI</option>
                                                        <option value="2" <?php echo set_select('class_name', 2) ?>>class-XII</option>
                                                    </select>
                                                    <?php echo form_error('class_name'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="" for="category_id">Select Subject Category <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="category_id" id="category_id">

                                                        <option value="" hidden="true">Select Subject Category</option>
                                                        <!-- <?php foreach($subjectCategory as $key=> $val){?>
                                                            <option value="<?php echo $val['subject_category_id_pk']?>"><?php echo $val['subject_category_name']?></option>
                                                        <?php }?> -->
                                                        <option value="" disabled>Select Class Name First...</option>
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

                                                    <option value="" hidden="true">Select Subject Name</option>    
                                                    <option value="" disabled="true">Select Subject Category First...</option>
                                                    
                                                    </select>
                                                    <?php echo form_error('subject_name_id'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    */?>

                                
                                <?php if ($vtcDetails['final_submit_status'] == 0) { ?>
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-4">
                                            <label>&nbsp;</label><br>
                                            <?php //if (empty($vtcCourses)) { ?>
                                                <button type="button" class="btn btn-success btn-block btn-sm" id="course-selection-btn">Submit Course Selection</button>
                                            <?php //} ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php echo form_close() ?>
                            </div>
                    </div>
                </div>
            </div>
           

            <div class="row">
                <div class="col-md-12">
                <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Courses List</h3>
                <div class="box-tools pull-right">
                    <!--  -->
                </div>
            </div>
           
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>Discipline</th>
                                <th>Group / Trade</th>
                                <!-- <th>Class</th>
                                <th>Subject Category</th>
                                <th>Subject</th> -->
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            <?php if (count($vtcCourseList) > 0) { ?>
                                <?php foreach ($vtcCourseList as $key => $value) { ?>
                                    <tr id="<?php echo md5($value['vtc_course_id_pk']); ?>">
                                        <td><?php echo ++$count; ?>.</td>
                                        <td><?php echo $value['course_name']; ?></td>
                                        <td><?php echo $value['discipline_name']; ?></td>
                                        <!-- <td><?php echo $value['group_name']; ?> [<?php echo $value['group_code']; ?>]</td> -->
                                        <td>
                                            <?php if (!empty($value['group'])) {
                                                $group_name = array();
                                                foreach ($value['group'] as $group) { 
                                                    $group_name[] = $group['group_name'] .' ['.$group['group_code'] .']';
                                                }
                                                echo implode(' , ', $group_name);
                                                
                                            } ?>
                                        </td>
                                       <?php /* <td>
                                            <?php if ($value['class_name'] == 1){echo 'XI';}elseif ($value['class_name'] == 2) {
                                                echo 'XII';
                                            } ?>
                                        </td>
                                        <td><?php echo $value['subject_category_name'] ?></td>

                                        <td style="width:30%">
                                            <?php if (!empty($value['subject'])) {
                                                $subject = array();
                                                foreach ($value['subject'] as $sub) { 
                                                    $subject[] = $sub['subject_name'] .' ['.$sub['subject_code'] .']';
                                                }
                                                echo implode(' , ', $subject);
                                                
                                            } ?>
                                        </td> */?>
                                        
                                        <td>
                                            <!-- <a target="_blank" href="<?php echo base_url('admin/affiliation/courses/detail/' . md5($value['vtc_course_id_pk'])); ?>" class="btn btn-info btn-sm">
                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </a> -->
                                            <?php //if ($vtcDetails['final_submit_status'] == 0) { ?>
                                                <!-- <a href="<?php echo base_url('admin/affiliation/courses/detail/' . md5($value['vtc_course_id_pk'])); ?>" class="btn btn-success btn-sm">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a> -->
                                                <!-- <button type="button" class="btn btn-danger btn-sm deleteVtcCourse">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button> -->
                                            <?php //} ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            
        </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                Your Basic Details is not completed for academic year <span class="label label-success"><?php echo $academic_year; ?></span>
            </div>
        <?php } ?>

    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<script>
    $(document).ready(function() {
        // $('.select1').select2();



        // $('.select1').select2({
        //     dropdownParent: $('#modal-teacher-subject-map')
        // });
        // // Do this before you initialize any of your modals
        // $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    });
</script>

