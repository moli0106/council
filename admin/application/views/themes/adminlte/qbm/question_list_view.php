<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .modal-lg {
        width: 80% !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Questions Bank Module</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="qbm/questions/subjects"><i class="fa fa-book"></i> Subject List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Questions List</li>
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
                    <strong>Question Category/Type Details</strong>
                </h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/qbm/questions/add'); ?>" class="btn btn-sm btn-block btn-flat btn-success">
                        <i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; Add Questions
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row" id="questionCategoryList">
                    <?php foreach ($questionCategoryList as $key => $value) { ?>
                        <div class="col-md-6">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-circle-o text-red"></i>
                                        <?php echo $value['question_type_name']; ?> <b>[<?php echo $value['semester_name']; ?>]</b>
                                        <span class="pull-right"><?php echo $value['min_no_of_question']; ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    <strong>Questions List</strong>
                </h3>
                <div class="box-tools" style="width: 30%;">
                    <input type="hidden" id="subject_id_hash" value="<?php echo $subject_id_hash; ?>">
                    <div class="row">
                        <div class="col-md-6" id="forwardQuestionDiv"></div>
                        <div class="col-md-6">
                            <select class="form-control" name="qb_list_semester_id" id="qb_list_semester_id">
                                <option value="" hidden="true">Select Semester</option>
                                
                                <?php foreach ($semesterList as $key => $value) { ?>
                                    <option value="<?php echo $value['semester_id_pk']; ?>">
                                        <?php echo $value['semester_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr class="bg-success">
                                <th>#</th>
                                <th>Semester</th>
                                <th>Subject</th>
                                <th>Topic/Chapter</th>
                                <th>Question Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tBody-questionList" style="font-size: 13px;">
                            <?php $count = 0; ?>
                            <?php if (!empty($questionList)) { ?>
                                <?php foreach ($questionList as $key => $value) { ?>
                                    <tr id="<?php echo md5($value['question_id_pk']); ?>">
                                        <td><?php echo ++$count; ?>.</td>
                                        <td><?php echo $value['semester_name']; ?></td>
                                        <td><?php echo $value['subject_name']; ?> [<?php echo $value['subject_code']; ?>]</td>
                                        <td><?php echo $value['topics_chapter_name']; ?></td>
                                        <td><?php echo $value['question_type_name']; ?> [<?php echo $value['question_mark']; ?>]</td>
                                        <td>
                                            <button class="btn bg-navy btn-xs btn-flat view-question-details" data-toggle="modal" data-target="#modal-question-details">Details</button>
                                            <?php if($subject_cat_id['sub_cat_id_fk']!=1){?>
												<button class="btn btn-info btn-xs btn-flat add-multi-lang-question" data-toggle="modal" data-target="#modal-question-details">Multi Lang.</button>
                                            <?php }?>
                                            <button class="btn btn-danger btn-xs btn-flat remove-question">Remove</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="11" align="center" class="text-danger">No Data Found...</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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