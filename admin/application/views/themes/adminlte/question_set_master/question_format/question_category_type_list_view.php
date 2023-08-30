<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .modal-lg {
        width: 80% !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question category type list</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Question category type List</li>
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
                <h3 class="box-title">Questions Format Details</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Course:</th>
                            <td><?php echo $question_set['course_name'] ?></td>
                            <th>Semester:</th>
                            <td><?php echo $question_set['semester_name'] ?></td>
                        </tr>
                        <tr>
                            <th>Discipline:</th>
                            <td><?php echo $question_set['discipline_name'] ?> [<?php echo $question_set['discipline_code'] ?>]</td>
                            <th>Subject:</th>
                            <td><?php echo $question_set['subject_name'] ?> [<?php echo $question_set['subject_code'] ?>]</td>
                        </tr>
                        <tr>
                            <th>Question Code:</th>
                            <td><?php echo $question_set['question_code'] ?></td>
                            <th>Month & Year:</th>
                            <td><?php echo $question_set['month_year'] ?></td>
                        </tr>
                        <tr>
                            <th>Time Allowed:</th>
                            <td><?php echo $question_set['time_allowed'] ?> Hours</td>
                            <th>Full Marks:</th>
                            <td><?php echo $question_set['full_marks'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    Question category type List
                </h3>
            </div>

            <div class="box-body">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Questions Title/Heading</th>
                                <th>Question Category/Type [Marks]</th>
                                <th>No of Questions to be Attempt</th>
                                <th>No of Questions to be Set</th>
                                <th>Marks of Each Questions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($question_category_list)) { ?>
                                <?php $i = 0; ?>
                                <?php foreach ($question_category_list as $key => $question_category) { ?>
                                    <tr id="<?php echo md5($question_category['question_format_map_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $question_category['question_heading']; ?></td>
                                        <td><?php echo $question_category['question_type_name']; ?></td>
                                        <td><?php echo $question_category['no_of_question_attamp']; ?></td>
                                        <td><?php echo $question_category['no_of_question_to_be_set']; ?></td>
                                        <td><?php echo $question_category['question_mark']; ?></td>
                                        <td>
                                            <?php if ($question_category['question_set_status'] == 0) { ?>
                                                <button data-id="<?php echo md5($question_category['question_format_map_id_pk']); ?>" class="btn btn-success btn-xs btn-flat assignQuestion">Assign Question</button>
                                            <?php } ?>
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
            </div>

            <div class="box-footer"></div>
        </div>
    </section>

</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>