<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="assessment/awarding/batch"><i class="fa fa-users"></i> Assessment Batch List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Certificate</li>
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
                <h3 class="box-title">Certificate List</h3>
                <div class="box-tools pull-right">
                    <!-- <a href="" class="btn bg-maroon btn-flat disabled download-all-marksheet"><i class="fa fa-download"></i> Download All Marksheet</a>
                    <a href="" class="btn bg-navy btn-flat disabled download-all-certificate"><i class="fa fa-download"></i> Download All Certificate</a>
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover fail-assessor-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Trainee Name</th>
                            <th>Council Code</th>
                            <th>User Code</th>
                            <th>Mobile No.</th>
                            <!-- <th>Marksheet</th> -->
                            <th>Certificate</th>
                            <!-- <th></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($traineeList)) { ?>
                            <?php $count = 0; ?>
                            <?php foreach ($traineeList as $key => $trainee) { ?>

                                <tr id="<?php echo md5($trainee['assessment_trainee_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $trainee['trainee_full_name']; ?></td>
                                    <td><?php echo $trainee['council_trainee_code']; ?></td>
                                    <td><?php echo $trainee['user_trainee_id']; ?></td>
                                    <td><?php echo $trainee['trainee_mobile_no']; ?></td>
                                 
                                    <td>
                                        <?php if ($trainee['exam_result'] == 1) { ?>
                                            <a target="_blank" href="<?php echo base_url('admin/vtc_student_batch/batch/download_certificate/' . md5($trainee['assessment_trainee_id_pk'])); ?>" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>
                                        <?php } ?>
                                    </td>
                                    <!-- <td>
                                        <label>
                                            <input type="checkbox" class="form-controll" name="assessor[]">
                                        </label>
                                    </td> -->
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
            <div class="box-footer"></div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<script>
    $(document).ready(function() {
        $(".checkbox-toggle").click(function() {
            var clicks = $(this).data('clicks');
            if (clicks) {
                $(".fail-assessor-list input[type='checkbox']").each(function() {
                    this.checked = false;
                });
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');

                $('.download-all-marksheet').addClass('disabled');
                $('.download-all-certificate').addClass('disabled');
            } else {
                $(".fail-assessor-list input[type='checkbox']").each(function() {
                    this.checked = true;
                });
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');

                $('.download-all-marksheet').removeClass('disabled');
                $('.download-all-certificate').removeClass('disabled');
            }
            $(this).data("clicks", !clicks);
        });
    });
</script>