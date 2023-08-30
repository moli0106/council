<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .highlight {
        padding: 9px 14px;
        margin-bottom: 14px;
        background-color: #f7f7f9;
        border: 1px solid #e1e1e8;
        border-radius: 4px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Creator/Moderator Details</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-user"></i> Question Creator/Moderator Update</li>
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
                <h3 class="box-title">Question Creator/Moderator Details</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Trainer Name</label>
                            <input type="text" class="form-control" value="<?php echo $qcm_details['qcm_name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="<?php echo $qcm_details['email_id']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" value="<?php echo $qcm_details['mobile_no']; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="highlight">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Course</th>
                                <!-- <th>Discipline</th> -->
                                <th>Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            <?php foreach ($qcm_subject as $key => $value) { ?>
                                <tr id="<?php echo md5($value['creator_moderator_subject_map_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['course_name']; ?></td>
                                    <!-- <td><?php //echo $value['discipline_name']; ?> [<?php //echo $value['discipline_code']?>]</td> -->
                                    <td><?php echo $value['subject_name']; ?> [<?php echo $value['subject_code']?>]</td>
                                    
                                    <!-- <td>
                                        <?php if ($value['active_status'] == 1) { ?>
                                            <small class="label label-success">Active</small>
                                        <?php } else { ?>
                                            <small class="label label-danger">Deactive</small>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($value['active_status'] == 1) { ?>
                                            <button class="btn btn-sm btn-danger changeJobRoleStatus" data-name="Deactive">
                                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-success changeJobRoleStatus" data-name="Activate">
                                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                            </button>
                                        <?php } ?>
                                    </td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php echo form_open('admin/qbm_master/question_creator_moderator/add_more_subject/' . md5($qcm_details['creator_moderator_id_pk'])) ?>
                <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Course *</label>
                                <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                                    <option value="">-- Select Course --</option>
                                    <?php foreach($course_list as $course){ ?>
                                    <<option value="<?php echo $course['course_id_pk'] ?>"
                                        <?php echo set_select('course_id',$course['course_id_pk']) ?>>
                                        <?php echo $course['course_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('course_id'); ?>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Subject *</label>
                                <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject_id">
                                    <option value="">-- Select Subject --</option>
                                    <?php foreach($subjectList as $subject){ ?>
                                    <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                    <option value="<?php echo $subject['subject_id_pk'] ?>"
                                        <?php echo set_select('subject_id',$subject['subject_id_pk']) ?>>
                                        <?php echo $subject['subject_name'] ?></option>
                                    <?php } }?>
                                </select>
                                <?php echo form_error('subject_id'); ?>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="col-md-2 pull-right">
                        <div class="form-group" style="text-align: center;">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-info btn-block">Add Subject</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>