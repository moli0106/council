<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation</li>
            <li class="active"><i class="fa fa-align-center"></i>Courses List</li>
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
                <h3 class="box-title">Courses List</h3>
                <div class="box-tools pull-right">
                    <?php if ($vtcDetails['final_submit_status'] != 0) { ?>
                        <a href="<?php echo base_url('admin/affiliation/courses/add'); ?>" class="btn btn-success btn-sm">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add Courses
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php if (!empty($vtcDetails)) { ?>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Name</th>
                                <th>Discipline</th>
                                <th>Group / Trade</th>
                                <th>Class</th>
                                <!-- <th>Subject Category</th> -->
                                <th>Subject</th>
                                <th>Action</th>
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
                                        <td><?php echo $value['group_name']; ?> [<?php echo $value['group_code']; ?>]</td>
                                        <td>
                                            <?php if ($value['class_name'] == 1){echo 'XI';}elseif ($value['class_name'] == 2) {
                                                echo 'XII';
                                            } ?>
                                        </td>
                                        <!-- <td><?php echo $value['subject_category_name'] ?></td> -->

                                        <td style="width:30%">
                                            <?php if (!empty($value['subject'])) {
                                                $subject = array();
                                                foreach ($value['subject'] as $sub) { 
                                                    $subject[] = $sub['subject_name'] .' ['.$sub['subject_code'] .']';
                                                }
                                                echo implode(' , ', $subject);
                                                
                                            } ?>
                                        </td>
                                        
                                        <td>
                                            <a href="<?php echo base_url('admin/affiliation/courses/detail/' . md5($value['vtc_course_id_pk'])); ?>" class="btn btn-info btn-sm">
                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </a>
                                            <?php //if ($vtcDetails['final_submit_status'] == 0) { ?>
                                                <!-- <a href="<?php echo base_url('admin/affiliation/courses/detail/' . md5($value['vtc_course_id_pk'])); ?>" class="btn btn-success btn-sm">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a> -->
                                                <!-- <button type="button" class="btn btn-danger btn-sm deletteVtcTeacher">
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
            <?php } else { ?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your Basic Details is not completed yet.
                </div>
            <?php } ?>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>