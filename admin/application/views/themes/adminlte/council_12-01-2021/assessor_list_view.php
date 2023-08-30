<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessor List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Assessor List</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Assessor List</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Assessor Name</th>
                            <th>PAN No.</th>
                            <th>Mobile No.</th>
                            <th>Assessor Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($assessors as $assessor){ ?>
                        <tr>
                            <td><?php echo $offset + $i; ?></td>
                            <td><?php echo $assessor['fname'] ?> <?php echo $assessor['mname'] ?> <?php echo $assessor['lname'] ?></td>
                            <td><?php echo $assessor['pan'] ?></td>
                            <td><?php echo $assessor['mobile_no'] ?></td>
                            <td><?php echo $assessor['assessor_code'] == NULL ? '<span class="label label-danger">Form B not filled</span>' : $assessor['assessor_code']; ?></td>
                            <td><?php echo $assessor['process_name'] == NULL ? "NA" : $assessor['process_name']; ?></td>
                            <td>
                                <a href="council/assessor_list/view_details/<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs">View</a>
                                <?php if($assessor['process_status_id_fk'] == 4) { ?>
                                <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs approve_assessor" data-toggle="modal" data-target="#myModal">Approve</a>
                                <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-danger btn-xs reject_assessor" data-toggle="modal" data-target="#myModal">Reject</a>
                                <?php } elseif($assessor['process_status_id_fk'] == 5) { ?>
                                <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-danger btn-xs reject_assessor" data-toggle="modal" data-target="#myModal">Reject</a>
                                <?php } elseif($assessor['process_status_id_fk'] == 6) { ?>
                                    <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs approve_assessor" data-toggle="modal" data-target="#myModal">Approve</a>

                                <?php } else { ?>
                                <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs approve_assessor" data-toggle="modal" data-target="#myModal">Approve</a>
                                <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-danger btn-xs reject_assessor" data-toggle="modal" data-target="#myModal">Reject</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php $i++;  } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>