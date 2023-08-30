<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>TC Course</h1>
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
       

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Course Selection</h3>
                            <div class="box-tools pull-right">
                               
                            </div>
                        </div>
                    
                            <div class="box-body">
                                <?php echo form_open('admin/organization/course_details', array('id' => 'course-selection-form')) ?>
                                
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo (form_error('stdSector') != '') ? 'has-error' : ''; ?>">
                                                <label for="stdSector">Sector <span class="text-danger">*</span></label>
                                                <select name="stdSector" id="stdSector" class="form-control <?php echo (form_error('stdSector') != '') ? 'is-invalid' : ''; ?>">
                                                    <option value="" hidden="true">Select Sector</option>
                                                    <?php foreach ($sectorList as $key => $value) { ?>
                                                        <option value="<?php echo $value['sector_id_pk']; ?>" <?php echo set_select('stdSector', $value['sector_id_pk']) ?>>
                                                            <?php echo $value['sector_name']; ?> [<?php echo $value['sector_code']; ?>]
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('stdSector'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group <?php echo (form_error('stdCourse') != '') ? 'has-error' : ''; ?>">
                                                <label for="stdCourse">Course <span class="text-danger">*</span></label>
                                                <select name="stdCourse" id="stdCourse" class="form-control">
                                                    <option value="" hidden="true">Select Course</option>
                                                    <?php if (!empty($courseList)) { ?>
                                                        <?php foreach ($courseList as $key => $value) { ?>
                                                            <option value="<?php echo $value['course_id_pk']; ?>" <?php echo set_select('stdCourse', $value['course_id_pk']); ?>>
                                                                <?php echo $value['course_name']; ?> [<?php echo $value['course_code']; ?>]
                                                            </option>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <option value="" disabled="true">Select Sector first...</option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('stdCourse'); ?>
                                            </div>
                                        </div>
                            
                                    </div>


                                    
                    
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-4">
                                            <label>&nbsp;</label><br>
                                            <button type="submit" class="btn btn-success btn-block btn-sm">Submit Course Selection</button>
                                            
                                        </div>
                                    </div>
                                            
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
                                <th>Sector Name</th>
                                <th>Sector Code</th>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                
                                
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            <?php if (count($TcCourseList) > 0) { ?>
                                <?php foreach ($TcCourseList as $key => $value) { ?>
                                    <tr id="<?php echo md5($value['tc_course_id_pk']); ?>">
                                        <td><?php echo ++$count; ?>.</td>
                                        <td><?php echo $value['sector_name']; ?></td>
                                        <td><?php echo $value['sector_code']; ?></td>
                                        <td><?php echo $value['course_name']; ?></td>
                                        <td><?php echo $value['course_code']; ?></td>
                                      
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

