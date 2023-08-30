<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Affiliation</li>
            <li><a href="affiliation/vtc"><i class="fa fa-align-center"></i> Course & Teachers / Instructor List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Details</li>
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
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <li class="header pull-left">
                                    <i class="fa fa-university"></i>
                                    <?php echo $vtcDetails['vtc_name']; ?>
                                    [<?php echo $vtcDetails['vtc_code']; ?>]
                                </li>
                                <?php if (!empty($vtcCourseList) && !empty($teacherList) && !empty($studentCountDetails)) { ?>
                                    <?php if ($vtcDetails['final_submit_status'] == 0) { ?>
                                        <li><a href="#finalsubmit" data-toggle="tab">Final Submit</a></li>
                                    <?php } ?>
                                <?php } ?>
                                <li><a href="#studentDetails" data-toggle="tab">Student Details</a></li>
                                <li><a href="#teachersInstructor" data-toggle="tab">Teachers / Instructor</a></li>
                                <li><a href="#courseSelection" data-toggle="tab">Course Selection</a></li>
                                <li class="active"><a href="#basicDetails" data-toggle="tab">Basic Details</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="basicDetails">
                                    <?php echo form_open('admin/affiliation/vtc/vtcEmailUpdate', array('id' => 'updateVtcEmail')) ?>
                                    <input type="hidden" name="vtc_details_id_hash" value="<?php echo md5($vtcDetails['vtc_details_id_pk']); ?>">
                                    <div class="row">
                                        
                                        <div class="col-xs-12 table-responsive">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th width="15%">VTC Email:</th> 
                                                    <td width="35%"><input type="email" name="vtc_email" class="form-control" value="<?php echo $vtcDetails['vtc_email']; ?>"></td>
                                                    <th width="15%">HOI Name:</th>
                                                    <td width="35%"><?php echo $vtcDetails['hoi_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>HOI Designation:</th>
                                                    <td><?php echo $vtcDetails['hoi_designation']; ?></td>
                                                    <th>HOI email:</th>
                                                    <td><input type="email" name="hoi_email" class="form-control" value="<?php echo $vtcDetails['hoi_email']; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <th>HOI Mobile No.:</th>
                                                    <td><?php echo $vtcDetails['hoi_mobile_no']; ?></td>
                                                    <th>Type:</th>
                                                    <td>
                                                        <?php
                                                        if (!empty($vtcDetails['other_type'])) {
                                                            echo $vtcDetails['other_type'];
                                                        } else {
                                                            echo $vtcDetails['vtc_type_name'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Medium of Instruction:</th>
                                                    <td>
                                                        <?php
                                                        if (!empty($vtcDetails['other_medium'])) {
                                                            echo $vtcDetails['other_medium'];
                                                        } else {
                                                            echo $vtcDetails['medium_of_instruction'];
                                                        }
                                                        ?>
                                                    </td>
                                                    <th>Address:</th>
                                                    <td><?php echo $vtcDetails['vtc_address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>District:</th>
                                                    <td><?php echo $vtcDetails['district_name']; ?></td>
                                                    <th>Sub Division:</th>
                                                    <td><?php echo $vtcDetails['subdiv_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Municipality:</th>
                                                    <td><?php echo $vtcDetails['block_municipality_name']; ?></td>
                                                    <th>Panchayat:</th>
                                                    <td><?php echo $vtcDetails['panchayat']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Police Station:</th>
                                                    <td><?php echo $vtcDetails['police_station']; ?></td>
                                                    <th>Pin Code:</th>
                                                    <td><?php echo $vtcDetails['pin_code']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Inst. Phone No.:</th>
                                                    <td><?php echo $vtcDetails['phone_no']; ?></td>
                                                    <th>Nodal:</th>
                                                    <td><?php echo $vtcDetails['nodal_centre_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Does the school have Higher Secondary or equivalent in regular section:</th>
                                                    <td><?php echo ($vtcDetails['hs_equivalent'] == 1) ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Does the school have Higher Secondary Science (Mathematics) in regular section:</th>
                                                    <td><?php echo ($vtcDetails['hs_science'] == 1) ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Does the school have Higher Secondary Science (Biology) in regular section:</th>
                                                    <td><?php echo ($vtcDetails['hs_biology'] == 1) ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Does the school have Higher Secondary Commerce in regular section:</th>
                                                    <td><?php echo ($vtcDetails['hs_commerce'] == 1) ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-4 col-md-offset-4">
                                            <button type="button" class="btn btn-flat btn-block bg-navy" id="updateVtcEmailBtn">Update VTC Details</button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                                <div class="tab-pane" id="courseSelection">
                                    <div class="row">
                                        <?php if (!empty($vtcCourseList)) { ?>
                                            <div class="col-md-10 col-md-offset-1">
                                                <?php if (isset($hsDiscipline)) { ?>
                                                    <hr>
                                                    <strong><i class="fa fa-book margin-r-5"></i> HS-Voc</strong>
                                                    <p class="text-muted">Discipline:</p>
                                                    <p>
                                                        <?php foreach ($hsDiscipline as $key => $value) { ?>
                                                            <span class="label <?php echo $label1[$key]; ?>"><?php echo $value['discipline_name']; ?></span>
                                                        <?php } ?>
                                                    </p>
                                                    <p class="text-muted">Course List:</p>
                                                    <?php foreach ($hsCourseList as $key => $value) { ?>
                                                        <span class="label <?php echo $label2[$key]; ?>"><?php echo $value['group_name']; ?>(<?php echo $value['group_code']; ?>)</span>
                                                    <?php } ?>
                                                <?php } ?>
                                                <hr>
                                                <?php if (isset($stcDiscipline)) { ?>
                                                    <strong><i class="fa fa-book margin-r-5"></i> VIII+ STC</strong>
                                                    <p class="text-muted">Discipline:</p>
                                                    <p>
                                                        <?php foreach ($stcDiscipline as $key => $value) { ?>
                                                            <span class="label <?php echo $label1[$key]; ?>"><?php echo $value['discipline_name']; ?></span>
                                                        <?php } ?>
                                                    </p>
                                                    <p class="text-muted">Course List:</p>
                                                    <?php foreach ($stcCourseList as $key => $value) { ?>
                                                        <span class="label <?php echo $label2[$key]; ?>"><?php echo $value['group_name']; ?>(<?php echo $value['group_code']; ?>)</span>
                                                    <?php } ?>
                                                    <hr>
                                                <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-md-10 col-md-offset-1">
                                                <div class="alert alert-warning alert-dismissible">
                                                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                                                    Your Courses is not added for academic year <span class="label label-success"><?php echo $academic_year; ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="tab-pane" id="teachersInstructor">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Designation</th>
                                                <th>Course</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0; ?>
                                            <?php if (count($teacherList) > 0) { ?>
                                                <?php foreach ($teacherList as $key => $value) { ?>
                                                    <tr id="<?php echo md5($value['teacher_id_pk']); ?>">
                                                        <td><?php echo ++$count; ?>.</td>
                                                        <td><?php echo $value['teacher_name']; ?></td>
                                                        <td><?php echo $value['mobile_no']; ?></td>
                                                        <td><?php echo $value['email_id']; ?></td>
                                                        <td>
                                                            <?php
                                                            if (!empty($value['designation_id_fk'])) {
                                                                echo $value['designation_name'];
                                                            } else {
                                                                echo $value['other_designation'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if (!empty($value['group_name'])) {
                                                                echo $value['group_name'] . ' [' . $value['group_code'] . ']';
                                                            } else {
                                                                echo $value['course_name'];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url('admin/affiliation/vtc/teachers/' . md5($value['teacher_id_pk'])); ?>" class="btn btn-info btn-sm">
                                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                                            </a>
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
                                <div class="tab-pane" id="studentDetails">
                                    <div class="row" style="margin-top: 50px;">
                                        <div class="col-md-6 col-md-offset-3">
                                            <ul class="list-group list-group-unbordered">
                                                <li class="list-group-item">
                                                    <b>Course of the Year</b><a class="pull-right">Enrolled Student</a>
                                                </li>
                                                <?php $count = 0; ?>
                                                <?php foreach ($studentCountDetails as $key => $value) { ?>
                                                    <li class="list-group-item">
                                                        <?php echo ++$count; ?>.
                                                        <b><?php echo $value['group_name']; ?></b>
                                                        (<?php echo $value['group_code']; ?>)
                                                        <a class="pull-right"><?php echo $value['enrolled_student']; ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Show nearby VTC List -->
        <?php $this->load->view($this->config->item('theme') . 'affiliation/nearby_vtc_list_view') ?>
        <!-- Show nearby VTC List -->

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>