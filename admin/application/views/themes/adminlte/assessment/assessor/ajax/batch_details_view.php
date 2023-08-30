<style>
    .red .active a,
    .red .active a:hover {
        border-radius: 3px;
        background-color: #00a65a !important;
        border-top-color: #00a65a !important;
    }

    .profile-user-img {
        margin: 0 auto;
        width: 30px;
        padding: 0px;
        border: 0px solid #d2d6de;
    }
</style>

<div class="row">

    <input type="hidden" id="batch-id" value="<?php echo md5($batch_details['assessment_batch_id_pk']); ?>">

    <div class="col-md-12">
        <div class="nav-tabs-custom">

            <ul id="myTabs" class="nav nav-pills nav-justified red" role="tablist" data-tabs="tabs">
                <li class="active"><a href="#tab_batch" data-toggle="tab"><strong>Batch Details</strong></a></li>
                <li><a href="#tab_tc" data-toggle="tab"><strong>TC Details</strong></a></li>
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
            </div>

        </div>
    </div>
</div>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Trainee List</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body" style="height: 230px; overflow-y: scroll;" id="custom-scrollbar">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Council Trainee Code</th>
                    <th>User Trainee Code</th>
                    <th>Mobile</th>
                    <th>DOB</th>
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
                        <td><?php echo date('d-m-Y', strtotime($tranee['trainee_dob'])); ?></td>
                        <td><?php echo $tranee['trainee_district_name']; ?></td>
                    </tr>

                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>