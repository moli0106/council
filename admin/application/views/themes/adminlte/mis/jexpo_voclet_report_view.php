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
        <h1>Jexpo Voclet Report</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-book"></i> Jexpo Voclet Report</li>
        </ol>
    </section>
    <section class="content">

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Jexpo Voclet Report</h3>
                <div class="box-tools pull-right">
                <?php if(($this->session->userdata('stake_id_fk') == 10) || ($this->session->userdata('stake_id_fk') == 11)) { ?>
                    <a href="<?php echo base_url('admin/mis/jexpo_voclet_report/download'); ?>" class="btn btn-sm btn-success">
                        <i class="fa fa-download" aria-hidden="true"></i>
                        Download Report
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                    </a>
                <?php } ?>
                </div>
            </div>
            <div class="box-body">
                <?php if($this->session->userdata('stake_id_fk') == 9) { ?>
                <?php echo form_open('admin/mis/jexpo_voclet_report', array('autocomplete' => 'off')); ?>
                <div class="highlight">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exam_type">Exam Type</label>
                            <select class="form-control" name="exam_type" id="exam_type">
                                <option value="" hidden="true">Select Exam Type</option>
                                <?php if (!empty($examTypelList)) { ?>
                                    <?php foreach ($examTypelList as $key => $value) { ?>
                                        <option value="<?php echo $value['exam_type_id_pk'] ?>" <?php echo set_select('exam_type', $value['exam_type_id_pk']) ?>>
                                            <?php echo $value['exam_type_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" hidden="true">No Data Found</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="" for="subject">Subject</label>
                            <select class="form-control" name="subject" id="subject">
                                <option value="" hidden="true">Select Subject</option>
                                <?php if (!empty($subjectList)) { ?>
                                    <?php foreach ($subjectList as $key => $value) { ?>
                                        <option value="<?php echo $value['subject_id_pk'] ?>" <?php echo set_select('subject', $value['subject_id_pk']) ?>>
                                            <?php echo $value['subject_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">Select Exam Type First...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                        <div class="col-md-3">
                            <label class="" for="question_level">Question Level</label>
                            <select class="form-control" name="question_level" id="question_level">
                                <option value="" hidden="true">Select Question Level</option>
                                <?php if (!empty($questionLevelList)) { ?>
                                    <?php foreach ($questionLevelList as $key => $value) { ?>
                                        <option value="<?php echo $value['level_id_pk'] ?>" <?php echo set_select('question_level', $value['level_id_pk']) ?>>
                                            <?php echo $value['level_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" hidden="true">No Data Found</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('programme_id'); ?>
                        </div>
                        <div class="col-md-3">
                            <br>
                            <button type="submit" name="search" value="<?php echo md5(100); ?>" class="btn btn-info btn-sm">
                                <i class="fa fa-search" aria-hidden="true"></i> Search
                            </button>

                            <button type="submit" name="download" value="<?php echo md5(200); ?>" class="btn btn-success btn-sm">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                Download Report
                                <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <?php } ?>
                <table class="table table-hover">
                    <thead>
                        <tr class="success">
                            <th>#</th>
                            <th>Exam Type</th>
                            <th>Subject</th>
                            <th>Question Level</th>
                            <th>Name of Paper Setter</th>
                            <th>No. of Questions Entered</th>
                            <th>Name of Moderator</th>
                            <th>No. of Questions Moderated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($jexpoVocletReport)) { ?>
                            <?php $count = $offset; ?>
                            <?php foreach ($jexpoVocletReport as $key => $jexpo) { ?>
                                <tr>
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $jexpo['exam_type_name']; ?></td>
                                    <td><?php echo $jexpo['subject_name']; ?></td>
                                    <td><?php echo $jexpo['level_name']; ?></td>
                                    <td><?php echo $jexpo['creator_name']; ?></td>
                                    <td><?php echo $jexpo['total_question']; ?></td>
                                    <td><?php echo $jexpo['moderator_name']; ?></td>
                                    <td><?php echo $jexpo['questions_moderated']; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr class="danger">
                                <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<script>
    $(document).ready(function() {
        $(document).on('change', '#exam_type', function() {
            var exam_type = $(this).val();

            $.ajax({
                    type: 'GET',
                    url: 'mis/jexpo_voclet_report/getSubject',
                    dataType: 'json',
                    data: {
                        exam_type: exam_type
                    }
                })
                .done(function(response) {
                    $('#subject').html(response);
                })
                .fail(function() {
                    console.log('error');
                });
        });
    });
</script>