<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>Poly Institute</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Poly Institute</li>
            <li><a href="affiliation/vtc"><i class="fa fa-align-center"></i> Institute Data</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Details</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="header pull-left">
                            <i class="fa fa-university"></i>
                            <?php echo $institute_name; ?>
                            [<?php echo $institute_code; ?>]
                        </li>
                                                                                                                            
                    </ul>
                    
                </div>
                <!-- Left Menu -->
            

                <div class="col-md-3">
                    <div class="box box-success">
                        <div class="box-header with-border">

                            <!-- <h3 class="box-title">Academic Year</h3> <span class="label label-success"><?=$vtcDetails['academic_year'];?></span>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div> -->
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a href="#basicDetails" data-toggle="tab">Student Details</a></li>

                              
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Left Menu -->
                <div class="tab-content">

                     <!-- Basic details View -->
                    <div class="col-md-9 active tab-pane"  id="basicDetails">

                        <?php $this->load->view($this->config->item('theme_uri') . 'poly_institute/institute_student_details/student_list_view'); ?>

                    </div> 
                    
                      

                    
                    
                    

                   
                    
                    
                  

                    

                </div>

        
            </div>
        </div>

        
    </section>

</div>

<?php  ?>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>