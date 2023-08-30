<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Affiliation</li>
            <li><a href="affiliation/vtc"><i class="fa fa-align-center"></i> Course & Teachers / Instructor List</a></li>
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
                            <?php echo $vtcDetails['vtc_name']; ?>
                            [<?php echo $vtcDetails['vtc_code']; ?>]
                        </li>
                                                                                                                            
                    </ul>
                    
                </div>
                <!-- Left Menu -->
            

                <div class="col-md-3">
                    <div class="box box-success">
                        <div class="box-header with-border">

                            <h3 class="box-title">Academic Year</h3> <span class="label label-success"><?=$vtcDetails['academic_year'];?></span>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a href="#basicDetails" data-toggle="tab">Basic Details</a></li>

                                <li class=""><a href="#courseSelection" data-toggle="tab">Course Selection</a></li>

                                <?php if ($vtcDetails['academic_year'] != '2021-22'){?>
                                    <li class=""><a href="#subjectSelection" data-toggle="tab"> Subject Selection</a></li>
                                <?php }?>
                                
                                <li class=""><a href="#teachersInstructor" data-toggle="tab">Teachers / Instructor</a></li>
                                
                                <li class=""><a href="#studentDetails" data-toggle="tab">Student Details</a></li>

                                <?php if ($vtcDetails['academic_year'] != '2021-22'){?>

                                <li class=""><a href="#paperLabDetails" data-toggle="tab"></i> Vocational Paper Laboratory</a>

                                
                                <li class=""><a href="#otherCmnLabDetails" data-toggle="tab"> Other Common Laboratory</a></li>

                                <li class=""><a href="#classRoomDetails" data-toggle="tab"> Class Room Details</a></li>

                                <li class=""><a href="#otherInfraDetails" data-toggle="tab"> Other Infrastructure Details</a></li>

                                <li class=""><a href="#computerLabDetails" data-toggle="tab"> Computer Lab Details</a></li>

                                <li class=""><a href="#agriDisciplineDetails" data-toggle="tab"> Agriculture Discipline Details</a></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Left Menu -->
                <div class="tab-content">

                     <!-- Basic details View -->
                    <div class="col-md-9 active tab-pane"  id="basicDetails">

                        <?php $this->load->view($this->config->item('theme_uri') . 'affiliation/admin/vtc_details/basic_details_view'); ?>

                    </div> 
                    
                    <!-- Student Details View -->
                    <div class="col-md-9 tab-pane"  id="studentDetails">

                        <?php $this->load->view($this->config->item('theme_uri') . 'affiliation/admin/vtc_details/student_details_view'); ?>

                    </div>  

                    <!-- Teacher Details View -->
                    <div class="col-md-9 tab-pane"  id="teachersInstructor">

                        <?php $this->load->view($this->config->item('theme_uri') . 'affiliation/admin/vtc_details/teacher_instractor_view'); ?>

                    </div>
                    
                    <!-- Course Selection View -->
                    <div class="col-md-9 tab-pane"  id="courseSelection">

                        <?php $this->load->view($this->config->item('theme_uri') . 'affiliation/admin/vtc_details/course_selection_view'); ?>

                    </div>

                    <!-- Subject Selection View -->
                    <div class="col-md-9 tab-pane"  id="subjectSelection">

                        <?php $this->load->view($this->config->item('theme_uri') . 'affiliation/admin/vtc_details/subject_selection_view'); ?>

                    </div>
                    
                    <!-- Paper Lab View -->
                    <div class="col-md-9 tab-pane"  id="paperLabDetails">

                        <?php $this->load->view($this->config->item('theme_uri') . 'affiliation/admin/vtc_details/vocational_paper_lab_view'); ?>

                    </div>

                    <!-- Other Common Lab View -->
                    <div class="col-md-9 tab-pane"  id="otherCmnLabDetails">
                        
                        <?php $this->load->view($this->config->item('theme_uri') . 'affiliation/admin/vtc_details/other_cmn_lab_view'); ?>

                    </div>

                    <!-- Class Room Details View -->
                    <div class="col-md-9 tab-pane"  id="classRoomDetails">
                        
                        <?php $this->load->view($this->config->item('theme_uri') . 'vtc_infrastructure/final_submit/class_room_details_view'); ?>

                    </div>

                    <!-- Other Ifrastructure Details View -->
                    <div class="col-md-9 tab-pane"  id="otherInfraDetails">
                        
                        <?php $this->load->view($this->config->item('theme_uri') . 'vtc_infrastructure/final_submit/other_infra_details_view'); ?>

                    </div>

                    <!-- Computer Lab Details View -->
                    <div class="col-md-9 tab-pane"  id="computerLabDetails">
                        
                        <?php $this->load->view($this->config->item('theme_uri') . 'vtc_infrastructure/final_submit/computer_lab_details_view'); ?>

                    </div>

                    <!-- Computer Lab Details View -->
                    <div class="col-md-9 tab-pane"  id="agriDisciplineDetails">
                        
                        <?php $this->load->view($this->config->item('theme_uri') . 'vtc_infrastructure/final_submit/agri_discipline_details_view'); ?>

                    </div>

                </div>

        
            </div>
        </div>

        <!-- Show nearby VTC List -->
        <?php $this->load->view($this->config->item('theme') . 'affiliation/nearby_vtc_list_view') ?>
        <!-- Show nearby VTC List -->
    </section>

</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>