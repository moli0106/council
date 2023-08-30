<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Questions Bank Module</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <!-- <li><a href="qbm/questions/courses"><i class="fa fa-list"></i> Course List</a></li> -->
            <li class="active"><i class="fa fa-align-center"></i> Subjest List</li>
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
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <strong>Subjects List</strong>
                </h3>
                <!-- <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/qbm/questions/add'); ?>" class="btn btn-sm btn-block btn-flat btn-success">
                        <i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; Add Questions
                    </a>
                </div> -->
            </div>

            <div class="box-body">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        <?php if (!empty($subjectList)) { ?>
                            <?php foreach ($subjectList as $subject) { ?>
                                <tr id="<?php echo md5($subject['subject_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $subject['course_name'] ?></td>
                                    <td>
                                        <?php echo $subject['subject_name'] ?>
                                        [<?php echo $subject['subject_code'] ?>]
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/qbm/questions_qt?sub=' . md5($subject['subject_id_pk'])); ?>" class="btn bg-navy btn-xs btn-flat">View Questions</a>
                                        
                                        <button class="btn bg-red btn-xs btn-flat download-pdf-btn" data-toggle="modal" data-target="#modal-download-pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr class="text-danger">
                                <td align="center" colspan="8">No Data Found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="box-footer"></div>
        </div>
    </section>

</div>

<div class="modal modal-success fade" id="modal-download-pdf" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Download Pdf</h4>
            </div>
            <div class="modal-body question-sem-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>