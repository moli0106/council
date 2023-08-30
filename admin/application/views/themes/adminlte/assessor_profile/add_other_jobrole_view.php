<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
  <!-- Content Wrapper. Contains page content -->
  <style>
      .course_sector_block, .work_exp_section, .experience_section, .agency_section{
    padding:10px 0px 10px 0px;
    margin-bottom:10px;
    border:2px solid #CCC;
      }
      .btn-space {
    margin-right: 5px;
    }
  </style>
  <div class="content-wrapper">
    <section class="content-header">
    	<h1>Add other jobrole</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-user"></i> Assessor Registration</li>
            <li class="active"><i class="fa fa-envelope-o"></i> Add other jobrole</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add other jobrole</h3>
            </div>
            <div class="box-body">

            <?php if($this->mood ==  1){ ?>
                
                <div class="alert alert-info">
                    <?php echo  $this->application_message; ?>
                </div>

                <?php echo form_open("admin/assessor_profile/add_other_job_role/new_application") ?>
                <input type="hidden" name="app_no" id="" class="form-control" value="<?php echo $this->application_no; ?>">
                
                
                <button type="submit" class="btn btn-primary">Apply for new application</button>

                <?php echo form_close(); ?>
                
                
            <?php } elseif($this->mood ==  2) { ?>
                <div class="alert alert-warning">
                    <?php echo  $this->application_message; ?>
                </div>
            <?php } elseif($this->mood ==  3) { ?>
                <div class="alert alert-warning">
                    <?php echo  $this->application_message; ?>
                </div>
            <?php } elseif($this->mood ==  4) { 
                 redirect("admin/assessor_profile/add_other_job_role/new_application_form");
             } elseif($this->mood ==  5) { ?>
                <div class="alert alert-warning">
                    <?php echo  $this->application_message; ?>
                </div>
            <?php } ?>
            </div>
            <!-- box-footer -->
        </div>
       

        
	</section>
</div>


<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>


