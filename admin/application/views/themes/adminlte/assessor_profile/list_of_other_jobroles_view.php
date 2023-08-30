<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
  <!-- Content Wrapper. Contains page content -->
  <style>

  </style>
  <div class="content-wrapper">
    <section class="content-header">
    	<h1>List of other job roles</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-user"></i> Assessor Registration</li>
            <li class="active"><i class="fa fa-envelope-o"></i> List of other job roles</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Other job roles</h3>
            </div>
            <div class="box-body">

                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Application No.</th>
                            <th>Final Submission Status</th>
                            <th>Final Submission Date</th>
                            <th>Approve/Reject Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($applications as $application){ ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>Application Number <?php echo $application['assessor_registration_application_no']; ?></td>
                            <td><?php echo $application['final_submission_status'] == 1 ? "Submitted" : "Not Submitted" ?></td>
                            <td><?php echo $application['final_submission_status'] == 1 ? date("d-m-Y", strtotime($application['final_submission_time'])) : "NA"; ?></td>
                            <td><?php echo $application['process_status_id_fk'] == 5 ? "Approved" : ($application['process_status_id_fk'] == 6 ? "Rejected" : "Pending")  ?></td>
                            <td>
                            <a href="assessor_profile/list_of_other_job_role/new_view_details/<?php echo $application['assessor_registration_application_no'] ?>" class="btn btn-primary btn-xs">View Details</a>
                            <?php if($application['final_submission_status'] != 1){ ?>

                                <a href="assessor_profile/add_other_job_role/new_application_form" class="btn btn-primary btn-xs">Edit</a>
                                
                            <?php } ?>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                
            </div>
            <!-- box-footer -->
        </div>
       

        
	</section>
</div>


<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>


