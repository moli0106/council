<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
function response_status_color($id = NULL)
{
    switch ($id) {
        case 1:
            echo "bg-orange";
            break;
        case 2:
            echo "bg-teal";
            break;
        case 3:
            echo "bg-maroon";
            break;
        case 4:
            echo "bg-aqua";
            break;
        case 5:
            echo "bg-navy";
            break;
        case 6:
            echo "bg-yellow";
            break;
        case 7:
            echo "bg-fuchsia";
            break;
        case 8:
            echo "bg-aqua";
            break;
        case 9:
            echo "bg-green";
            break;
        case 10:
            echo "bg-red";
            break;
        case 11:
            echo "bg-olive";
            break;
        case 12:
            echo "bg-teal";
            break;
        default:
            echo NULL;
    }
}
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
        <div class="row">

            <div class="col-md-4">
                <?php $this->load->view($this->config->item('theme_uri') . 'cssvse/cssvsebatch/assessment_batch/assessment_menu'); ?>
            </div>

            <div class="col-md-8">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-users"></i> Batch Details</h3>
                        <div class="box-tools pull-right"></div>
                    </div>

                    <div class="box-body">
                        <div style="font-size: 13px;">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Batch Code : </strong>
                                    <?php echo $batchDetails['user_batch_id']; ?>
                                    <strong class="pull-right">CSSVSE </strong>
                                </li>
                                <li class="list-group-item">
                                    <strong>Sector Name : </strong>
                                    <?php echo $batchDetails['sector_name']; ?> [<?php echo $batchDetails['sector_code']; ?>]
                                </li>
                                <li class="list-group-item">
                                    <strong>Course Name : </strong>
                                    <?php echo $batchDetails['course_name']; ?> [<?php echo $batchDetails['course_code']; ?>]
                                </li>
                                <li class="list-group-item">
                                    <strong>Batch Status: </strong>
                                    <span class="badge <?php echo response_status_color($batchDetails['process_id_fk']); ?> process-name">
                                        <?php echo $batchDetails['process_name']; ?>
                                    </span>
                                </li>
                            </ul>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Batch Start Date : </strong>
                                    <?php echo date('d-m-Y', strtotime($batchDetails['batch_start_date'])); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Batch End Date : </strong>
                                    <?php echo date('d-m-Y', strtotime($batchDetails['batch_end_date'])); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Tentative Date : </strong>
                                    <?php echo date('d-m-Y', strtotime($batchDetails['batch_tentative_date'])); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Prefered Assessment Date 1 : </strong>
                                    <?php
                                    if (isset($batchDetails['prefered_assessment_date_1'])) {
                                        echo date('d-m-Y', strtotime($batchDetails['prefered_assessment_date_1']));
                                    }
                                    ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Prefered Assessment Date 2 : </strong>
                                    <?php
                                    if (isset($batchDetails['prefered_assessment_date_1'])) {
                                        echo date('d-m-Y', strtotime($batchDetails['prefered_assessment_date_1']));
                                    }
                                    ?>
                                </li>
                            </ul>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Assessor Name : <?php echo $batchDetails['assessor_name']; ?></strong>
                                </li>
                                <li class="list-group-item">
                                    <strong>Assessor Contact Number : <?php echo $batchDetails['assessor_mobile_no']; ?> [<i><?php echo $batchDetails['assessor_email']; ?></i>]</strong>
                                </li>
                                <li class="list-group-item">
                                    <strong>
                                        Proposed Assessment Date :
                                        <?php
                                        $date = explode(' ', $batchDetails['proposed_assessment_date']);
                                        echo $date[0];
                                        ?>
                                    </strong>
                                </li>
                                <li class="list-group-item">
                                    <strong>Assessment Completed Date : --</strong>
                                </li>
                                <!-- <li class="list-group-item">
                                    <strong>Marksheet Generated Date : --</strong>
                                </li> -->
                                <!-- <li class="list-group-item">
                                    <strong>Certificate Generated Date : --</strong>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-users"></i> Student List</h3>
                        <div class="box-tools pull-right"></div>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Reg. Number</th>
                                        <th>Mobile Number</th>
                                        <th>Guardian Name</th>
                                        <th>Date Of Birth</th>
                                        <th>Class</th>
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
                                                <td><?php echo $value['mobile']; ?></td>
                                                <td><?php echo $value['guardian_name']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($value['date_of_birth']) {
                                                        echo date("d-m-Y", strtotime($value['date_of_birth']));
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $value['class_name']; ?></td>
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
                </div>
            </div>

        </div>
    </section>

</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>