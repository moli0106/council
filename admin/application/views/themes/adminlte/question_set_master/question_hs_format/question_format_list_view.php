<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .modal-lg {
        width: 80% !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Questions Format for HS</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Questions Format for HS</li>
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
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    Questions Format of HS
                </h3>
                <div class="box-tools">
                    <a href="<?php echo base_url('admin/question_set_master/question_hs_format/add'); ?>" class="btn btn-sm btn-block btn-flat btn-success">
                        <i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; Add Questions Format
                    </a>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Month & Year</th>
                                <th>Semester</th>
                                <!-- <th>Discipline</th> -->
                                <th>Subject</th>
                                <th>Question Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tBody-questionFormatList">
                            <?php
                            if (count($question_set_list)) {
                                $i = $offset;
                                foreach ($question_set_list as $key => $question_set) { ?>

                                    <tr id="<?php echo md5($question_set['question_format_main_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $question_set['course_name']; ?></td>
                                        <td><?php echo $question_set['month_year']; ?></td>
                                        <td><?php echo $question_set['semester_name']; ?></td>
                                        <!-- <td><?php //echo $question_set['discipline_name']; ?> [<?php //echo $question_set['discipline_code']; ?>]</td> -->
                                        <td><?php echo $question_set['subject_name']; ?> [<?php echo $question_set['subject_code']; ?>]</td>
                                        <td><?php echo $question_set['question_code']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/question_set_master/question_hs_format/details/' . md5($question_set['question_format_main_id_pk'])); ?>" class="btn btn-info btn-sm btn-flat">
                                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                                            </a>
                                            <?php if ($question_set['question_set_status'] == 1) { ?>
                                            <a href="<?php echo base_url('admin/question_set_master/question_hs_format/downloadQuestion/' . md5($question_set['question_format_main_id_pk'])); ?>" class="btn bg-navy btn-sm btn-flat">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </a>
                                            <?php }?>
                                        </td>
                                    </tr>

                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer" style="text-align: center">
                <?php echo $page_links ?>
            </div>

            <div class="box-footer"></div>
        </div>
    </section>

</div>

<div class="modal modal-success fade" id="modal-question-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Question Details</h4>
            </div>
            <div class="modal-body question-details-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>