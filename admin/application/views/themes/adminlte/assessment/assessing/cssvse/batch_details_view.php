<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
function response_status_color($id = NULL)
{
    switch ($id) {
        case 1:
            echo "bg-teal";
            break;
        case 2:
            echo "bg-fuchsia";
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
            echo "bg-orange";
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

<style>
    .list-group-item {
        padding: 5px 8px !important;
    }

    .modal-lg {
        width: 80% !important;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        color: #fff;
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

<style>
    .red .active a,
    .red .active a:hover {
        border-radius: 3px;
        background-color: #00a65a !important;
        border-top-color: #00a65a !important;
    }

    .profile-user-img {
        margin: 0 auto;
        width: 50px;
        padding: 0px;
        border: 0px solid #d2d6de;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>CSSVSE Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>CSSVSE Assessment Batch List</li>
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

            <input type="hidden" id="batch-id" value="<?php echo md5($batch_details['assessment_batch_id_pk']); ?>">

            <div class="col-md-12">
                <div class="nav-tabs-custom">

                    <ul id="myTabs" class="nav nav-pills nav-justified red" role="tablist" data-tabs="tabs">
                        <li class="active"><a href="#tab_batch" data-toggle="tab"><strong>Batch Details</strong></a></li>
                        <!-- <li><a href="#tab_tp" data-toggle="tab"><strong>TP Details</strong></a></li> -->
                        <li><a href="#tab_tc" data-toggle="tab"><strong>TC Details</strong></a></li>
                        <?php if ($this->session->userdata('stake_id_fk') == 12) { ?>
                            <?php if (!empty($assessor_details)) { ?>
                                <li><a href="#tab_assessor" data-toggle="tab"><strong>Assessor Details</strong></a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_batch">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong>Vertical Code : </strong>
                                            <?php echo $batch_details['vertical_code']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Vertical Code : </strong>
                                            <?php echo $batch_details['vertical_name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Assessment Scheme Name : </strong>
                                            <?php echo $batch_details['assessment_scheme_name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Batch Code : </strong>
                                            <?php echo $batch_details['user_batch_id']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Sector Name : </strong>
                                            <?php echo $batch_details['sector_name']; ?>
                                            [<?php echo $batch_details['sector_code']; ?>]
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Course Name : </strong>
                                            <?php echo $batch_details['course_name']; ?>
                                            [<?php echo $batch_details['course_code']; ?>]
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-calendar" aria-hidden="true"></i> Council Assign Date : </strong>
                                            <?php echo date('d-m-Y', strtotime($batch_details['entry_time'])); ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-calendar" aria-hidden="true"></i> Tentative Assessment Date : </strong>
                                            <?php echo date('d-m-Y', strtotime($batch_details['batch_tentative_assessment_date'])); ?>
                                        </li>
                                        <?php if ($this->session->userdata('stake_id_fk') == 2) { ?>
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Preferred Assessment Date 1 : </strong>
                                                <?php echo date('d-m-Y', strtotime($batch_details['prefered_assessment_date_1'])); ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Preferred Assessment Date 2 : </strong>
                                                <?php echo date('d-m-Y', strtotime($batch_details['prefered_assessment_date_2'])); ?>
                                            </li>
                                        <?php } ?>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-calendar" aria-hidden="true"></i> Proposed Assessment Date : </strong>
                                            <?php if ($batch_details['proposed_assessment_date'])
                                                echo date('d-m-Y', strtotime($batch_details['proposed_assessment_date']));
                                            ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Assessment Status : </strong>
                                            <?php if ($batch_details['process_id_fk'] == 7) { ?>
                                                <small class="label label-warning pull-right process_name"><?php echo $batch_details['process_name']; ?></small>
                                            <?php }
                                            if ($batch_details['process_id_fk'] == 8) { ?>
                                                <small class="label label-info pull-right process_name"><?php echo $batch_details['process_name']; ?></small>
                                            <?php }
                                            if ($batch_details['process_id_fk'] == 9) { ?>
                                                <small class="label label-success pull-right process_name"><?php echo $batch_details['process_name']; ?></small>
                                            <?php } ?>
                                            <!-- <small class="label label-warning pull-right"><?php echo $batch_details['process_name']; ?></small> -->
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-location-arrow" aria-hidden="true"></i> Preferred District : </strong>
                                            <?php if ($batch_details['preferred_district_name'] != NULL)
                                                echo $batch_details['preferred_district_name'];
                                            else echo 'N/A';
                                            ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-map-marker" aria-hidden="true"></i> Preferred Location : </strong>
                                            <?php if ($batch_details['preferred_location'] != NULL)
                                                echo $batch_details['preferred_location'];
                                            else echo 'N/A';
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_tp">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong>TP Name : </strong>
                                            <?php echo $batch_details['council_tp_name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Council TP Code : </strong>
                                            <?php echo $batch_details['council_tp_code']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>User TP Code : </strong>
                                            <?php echo $batch_details['user_tp_institute_id']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>TP Type : </strong>
                                            <?php echo $batch_details['tp_type']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>TP Mobile : </strong>
                                            <?php echo $batch_details['tp_mobile_no']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>TP Email : </strong>
                                            <?php echo $batch_details['tp_email']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>SPOC Name : </strong>
                                            <?php echo $batch_details['tp_spoc_name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>SPOC Mobile : </strong>
                                            <?php echo $batch_details['tp_spoc_mobile_no']; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong>SPOC Email : </strong>
                                            <?php echo $batch_details['tp_spoc_email']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Address : </strong>
                                            <?php echo $batch_details['tp_address']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Pincode : </strong>
                                            <?php echo $batch_details['tp_pincode']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Landmark : </strong>
                                            <?php echo $batch_details['tp_landmark']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>State : </strong>
                                            <?php echo $batch_details['tp_state_name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>District : </strong>
                                            <?php echo $batch_details['tp_district_name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Municipality Name : </strong>
                                            <?php echo $batch_details['tp_block_municipality_name']; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_tc">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong>TC Name : </strong>
                                            <?php echo $batch_details['council_tc_name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Council TC Code : </strong>
                                            <?php echo $batch_details['council_tc_code']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>User TC Code : </strong>
                                            <?php echo $batch_details['user_tc_code']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>TC Mobile : </strong>
                                            <?php echo $batch_details['tc_mobile_no']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>TC Email : </strong>
                                            <?php echo $batch_details['tc_email']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>State / District : </strong>
                                            <?php echo $batch_details['tc_state_name']; ?>
                                            [ <?php echo $batch_details['tc_district_name']; ?> ]
                                        </li>
                                        <!-- <li class="list-group-item">
                                            <strong>SPOC Name : </strong>
                                            <?php echo $batch_details['tc_spoc_name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>SPOC Mobile : </strong>
                                            <?php echo $batch_details['tc_spoc_mobile_no']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>SPOC Email : </strong>
                                            <?php echo $batch_details['tc_spoc_email']; ?>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <strong>Pincode : </strong>
                                            <?php echo $batch_details['tc_pincode']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Address : </strong>
                                            <?php echo $batch_details['tc_address']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Landmark : </strong>
                                            <?php echo $batch_details['tc_landmark']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Municipality Name : </strong>
                                            <?php echo $batch_details['tc_block_municipality_name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Latitude : </strong>
                                            <?php echo $batch_details['tc_latitude']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Longitude : </strong>
                                            <?php echo $batch_details['tc_longitude']; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <?php if ($this->session->userdata('stake_id_fk') == 12) { ?>
                            <?php if (!empty($assessor_details)) { ?>
                                <div class="tab-pane" id="tab_assessor">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <strong>Assessor Name : </strong>
                                                    <?php echo $assessor_details['fname'] . ' ' . $assessor_details['lname']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Code : </strong>
                                                    <?php echo $assessor_details['assessor_code']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Mobile : </strong>
                                                    <?php echo $assessor_details['mobile_no']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Email : </strong>
                                                    <?php echo $assessor_details['email_id']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Pancard : </strong>
                                                    <?php echo $assessor_details['pan']; ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <strong>Assessor State : </strong>
                                                    <?php echo $assessor_details['state_name']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor District : </strong>
                                                    <?php echo $assessor_details['district_name']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Pincode : </strong>
                                                    <?php echo $assessor_details['pin']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Proposed Assessment Date : </strong>
                                                    <?php echo date('d-m-Y', strtotime($assessor_details['purpose_assessment_date'])); ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Assign Date : </strong>
                                                    <?php echo date('d-m-Y', strtotime($assessor_details['entry_time'])); ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <strong>Proposed Assessment Date</strong>
                                                    <span class="label label-info">
                                                        <strong><?php echo date('d-m-Y', strtotime($assessor_details['purpose_assessment_date'])); ?></strong>
                                                    </span>
                                                    <?php echo $assessor_details['assessor_assign_notes']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Approved Date / Note : </strong>
                                                    <?php
                                                    if ($assessor_details['assessor_confirm_date'] != '') {
                                                        echo '
                                                                <span class="label label-info">
                                                                    <strong>' .
                                                            date('d-m-Y', strtotime($assessor_details['assessor_confirm_date']))
                                                            . '</strong>
                                                                </span>' .
                                                            $assessor_details['assessor_confirm_notes'];
                                                    }
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Trainee List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body" style="height: 500px; overflow-y: scroll;" id="custom-scrollbar">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Council Trainee Code</th>
                            <th>User Trainee Code</th>
                            <th>Mobile</th>
                            <th>District</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($tranee_details as $key => $tranee) { ?>

                            <tr id="<?php echo md5($tranee['assessment_trainee_id_pk']); ?>">
                                <td><?php echo ++$i; ?>.</td>
                                <td>
                                    <?php if ($tranee['trainee_image'] != NULL) { ?>
                                        <img class="profile-user-img img-responsive img-circle" src="data:image/png;base64,<?php echo $tranee['trainee_image']; ?>" alt="Trainee Picture">
                                    <?php } else { ?>
                                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('admin/themes/adminlte/assets/image/user-profile.png'); ?>" alt="Trainee Picture">
                                    <?php } ?>
                                </td>
                                <td><?php echo $tranee['trainee_full_name']; ?></td>
                                <td><?php echo $tranee['council_trainee_code']; ?></td>
                                <td><?php echo $tranee['user_trainee_id']; ?></td>
                                <td><?php echo $tranee['trainee_mobile_no']; ?></td>
                                <td><?php echo $tranee['trainee_district_name']; ?></td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>