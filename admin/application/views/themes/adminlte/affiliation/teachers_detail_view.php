<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<style>
    img {
        border-radius: 50%;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Teachers / Instructor Details</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation</li>
            <li><a href="affiliation/teachers"><i class="fa fa-align-center"></i>Teachers / Instructor List</a></li>
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

        <div class="row">
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Documents Details</h3>
                    </div>
                    <div class="box-body">
                        <strong><i class="fa fa-file-pdf-o margin-r-5"></i> Qualification Certificate</strong>
                        <a href="<?php echo base_url('admin/affiliation/teachers/download_qualification_certificate/' . md5($teacher['teacher_id_pk'])); ?>" class="label label-info">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            Download
                        </a>

                        <hr>

                        <strong><i class="fa fa-picture-o margin-r-5"></i> PAN Image</strong>
                        <a href="<?php echo base_url('admin/affiliation/teachers/download_pan_image/' . md5($teacher['teacher_id_pk'])); ?>" class="label label-info">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            Download
                        </a>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> PAN Number</strong>
                        <p class="text-muted pull-right"><?php echo $teacher['pan_no']; ?></p>

                        <hr>

                        <strong><i class="fa fa-picture-o margin-r-5"></i> Aadhar Image</strong>
                        <?php if ($teacher['aadhar_no_image'] != NULL) { ?>
                            <a href="<?php echo base_url('admin/affiliation/teachers/download_aadhar_image/' . md5($teacher['teacher_id_pk'])); ?>" class="label label-info">
                                <i class="fa fa-download" aria-hidden="true"></i> Download
                            </a>
                        <?php } else { ?>
                            <p class="text-muted pull-right">--</p>
                        <?php } ?>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Aadhar Number</strong>
                        <p class="text-muted pull-right"><?php echo ($teacher['aadhar_no'] != NULL) ? $teacher['aadhar_no'] : '--'; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Basic Details</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <!-- <i class="fa fa-user"></i>  -->
                                    <?php if (!empty($teacher['photo'])) { ?>
                                        <img src="data:image/jpeg;base64, <?php echo $teacher['photo']; ?>"  alt="User Image" style="height: 80px;">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url('admin/themes/adminlte/assets/image/user-profile.png'); ?>"  alt="User Image" style="height: 80px;width: 104px;">
                                    <?php } ?>
                                    <?php echo $teacher['teacher_name']; ?>
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Mobile Number:</th>
                                        <td><?php echo $teacher['mobile_no']; ?></td>
                                        <th>Email Id:</th>
                                        <td><?php echo $teacher['email_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Designation:</th>
                                        <td>
                                            <?php
                                            if ($teacher['designation_id_fk'] != NULL) {
                                                echo $teacher['designation_name'];
                                            } else {
                                                echo $teacher['other_designation'];
                                            }
                                            ?>
                                        </td>
                                        <th>Teacher Type:</th>
                                        <td>
                                            <small>
                                                <?php
                                                switch ($teacher['teacher_type']) {
                                                    case 1:
                                                        echo 'Teachers for HS-Voc.';
                                                        break;

                                                    case 2:
                                                        echo 'Other teacher for HS Voc / VIII+ / X+ STC';
                                                        break;

                                                    default:
                                                        echo 'Teachers for Short Term Training (VIII+ / X+ STC)';
                                                        break;
                                                }
                                                ?>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Course Name:</th>
                                        <td>
                                            <?php
                                            if ($teacher['course_id_fk'] != NULL) {
                                                echo $teacher['group_name'] . ' [' . $teacher['group_code'] . ']';
                                            } else {
                                                echo $teacher['course_name'];
                                            }
                                            ?>
                                        </td>
                                        <th>Subjects Attached With:</th>
                                        <td><?php echo ($teacher['attached_subjects'] != NULL) ? $teacher['attached_subjects'] : '--'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Type of Engagement :</th>
                                        <td>
                                            <?php
                                            if ($teacher['engagement_id_fk'] != NULL) {
                                                echo $teacher['engagement_name'];
                                            } else {
                                                echo $teacher['other_engagement'];
                                            }
                                            ?>
                                        </td>
                                        <th>Highest / relevant Qualification:</th>
                                        <td>
                                            <?php
                                            if ($teacher['qualification_id_fk'] != NULL) {
                                                echo $teacher['qualification_name'];
                                            } else {
                                                echo $teacher['other_qualification'];
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Subjects Of Qualification:</th>
                                        <td><?php echo $teacher['qualification_subjects']; ?></td>
                                        <th>Employee ID:</th>
                                        <td><?php echo $teacher['employee_id']; ?></td>
                                    </tr>

                                    <tr>
                                        <th>WhatsApp no:</th>
                                        <td><?php echo $teacher['whats_app_mob_no']; ?></td>
                                        <th>Date of Birth:</th>
                                        <td><?php if($teacher['date_of_birth']){echo date('d/m/Y', strtotime($teacher['date_of_birth']));} ?></td>
                                    </tr>

                                    <tr>
                                        <?php if($teacher['teacher_type'] == 3){?>
                                            <th>Group:</th>
                                            <td>
                                                <?php if (!empty($GroupSubject)) {
                                                    $group_name = array();
                                                    foreach ($GroupSubject as $group) { 
                                                        $group_name[] = $group['group_name'] .' ['.$group['group_code'] .']';
                                                    }
                                                    echo implode(' , ', $group_name);
                                                    
                                                } ?>
                                            </td>
                                            <?php }elseif ($teacher['teacher_type'] == 1) {?>
                                                
                                                <th>Subject:</th>
                                                <td>
                                                    <?php if (!empty($GroupSubject)) {
                                                        $subject_name = array();
                                                        foreach ($GroupSubject as $sub) { 
                                                            $subject_name[] = $sub['subject_name'] .' ['.$sub['subject_code'] .']';
                                                        }
                                                        echo implode(' , ', $subject_name);
                                                        
                                                    } ?>
                                                </td>
                                            <?php }?>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>