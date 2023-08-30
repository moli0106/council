<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="cssvsebatch/batch"><i class="fa fa-align-center"></i>Batch List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Batch Details</li>
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

            <!-- Left Menu -->
            <?php $this->load->view($this->config->item('theme_uri') . 'cssvse/cssvsebatch/assessment_batch/assessment_menu'); ?>
            <!-- Left Menu -->

            <div class="col-md-9">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student List</h3>
                        <div class="box-tools pull-right">
                            <div class="has-feedback">

                            </div>
                        </div>

                    </div>

                    <div class="box-body no-padding">
                        <div class="pull-right">
                        </div>
                    </div>


                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Reg. Number</th>
                                    <th>Guardian Name</th>
                                    <th>Date Of Birth</th>
                                    <th>District</th>
                                    <th>State</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                <?php if (count($stdList) > 0) { ?>
                                    <?php foreach ($stdList as $key => $value) { ?>
                                        <tr id="<?php echo md5($value['student_id_pk']); ?>">
                                            <td> <?php echo ++$count; ?>.</td>
                                            <td><?php echo $value['first_name']; ?> <?php echo $value['middle_name']; ?> <?php echo $value['last_name']; ?></td>
                                            <td><?php echo $value['registration_number']; ?></td>
                                            <td><?php echo $value['guardian_name']; ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($value['date_of_birth']));  ?></td>
                                            <td><?php echo $value['district_name']; ?></td>
                                            <td><?php echo $value['state_name']; ?></td>


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

                <!-- <div class="box-footer no-padding"> -->

            </div>
        </div>



    </section>

</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>