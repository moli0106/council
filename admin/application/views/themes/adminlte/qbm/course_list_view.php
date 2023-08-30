<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Questions Bank Module</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Course List</li>
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
                <h3 class="box-title">
                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                    <strong>Course List</strong>
                </h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/qbm/questions/add'); ?>" class="btn btn-sm btn-block btn-flat btn-success">
                        <i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; Add Questions
                    </a>
                </div>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">

                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                <?php if (!empty($courseList)) { ?>
                                    <?php foreach ($courseList as $course) { ?>
                                        <tr id="<?php echo md5($course['course_id_pk']); ?>">
                                            <td><?php echo ++$count; ?>.</td>
                                            <td><?php echo $course['course_name'] ?></td>
                                            <td><?php echo $course['semester_name'] ?></td>
                                            <td>
                                                <a href="<?php echo base_url('admin/qbm/questions/subjects/' . md5($course['course_id_pk'])); ?>?sem=<?php echo md5($course['semester_id_pk']); ?>" class="btn bg-navy btn-xs btn-flat">
                                                    View Subjects
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr class="text-danger">
                                        <td align="center" colspan="4">No Data Found...</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <!-- <div class="box-footer"></div> -->
        </div>
    </section>

</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>