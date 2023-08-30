<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Affiliation</li>
            <li><a href="affiliation/vtc"><i class="fa fa-align-center"></i> Institute List</a></li>
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
                            <?php echo $basicDetails['institute_name']; ?>
                            [<?php echo $basicDetails['institute_code']; ?>]
                        </li>
                                                                                                                            
                    </ul>
                    
                </div>
                <!-- Left Menu -->
            

                <div class="col-md-3">
                    <div class="box box-success">
                        <div class="box-header with-border">

                            <h3 class="box-title">Affiliation Year</h3> <span class="label label-success"><?=$basicDetails['affiliation_year'];?></span>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a href="#basicDetails" data-toggle="tab">Basic Details</a></li>

                                <li class=""><a href="#courseSelection" data-toggle="tab">Intake Details</a></li>

                               
                                
                                <li class=""><a href="#teachersInstructor" data-toggle="tab">Teachers Details</a></li>
                                
                                <li class=""><a href="#roomDetails" data-toggle="tab">Room Details</a></li>

                               

                                <li class=""><a href="#labDetails" data-toggle="tab"></i> Laboratories Details</a>

                                
                                <li class=""><a href="#libraryDetails" data-toggle="tab"> Library Details</a></li>

                                <li class=""><a href="#feesDetails" data-toggle="tab"> Fees received per Individual Student</a></li>

                                <li class=""><a href="#mandatoryDetails" data-toggle="tab"> Mandatory Requirements</a></li>

                                <li class=""><a href="#docDetails" data-toggle="tab"> Uploaded Doc</a></li>

                                <?php if($basicDetails['institute_category_id_fk'] == 4) {?>
                                    <li class=""><a href="#payDetails" data-toggle="tab"> Payment Details</a></li>
                                <?php }?>

                                
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Left Menu -->
                <div class="tab-content">

                     <!-- Basic details View -->
                    <div class="col-md-9 active tab-pane"  id="basicDetails">

                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/basic_details_view'); ?>

                    </div> 
                    
                    <!-- Student Details View -->
                    <div class="col-md-9 tab-pane"  id="roomDetails">

                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/room_details_view'); ?>

                    </div>  

                    <!-- Teacher Details View -->
                    <div class="col-md-9 tab-pane"  id="teachersInstructor">

                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/teacher_instractor_view'); ?>

                    </div>
                    
                    <!-- Course Selection View -->
                    <div class="col-md-9 tab-pane"  id="courseSelection">

                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/intake_details_view'); ?>

                    </div>

                    <!-- Subject Selection View -->
                    <div class="col-md-9 tab-pane"  id="labDetails">

                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/lab_details_view'); ?>

                    </div>
                    
                    <!-- Paper Lab View -->
                    <div class="col-md-9 tab-pane"  id="libraryDetails">

                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/library_details_view'); ?>

                    </div>

                    <!-- Other Common Lab View -->
                    <div class="col-md-9 tab-pane"  id="feesDetails">
                        
                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/fees_details_view'); ?>

                    </div>

                   
                    <!-- Other Ifrastructure Details View -->
                    <div class="col-md-9 tab-pane"  id="mandatoryDetails">
                        
                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/mandatory_details_view'); ?>

                    </div>

                    <!-- Computer Lab Details View -->
                    <div class="col-md-9 tab-pane"  id="docDetails">
                        
                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/doc_details_view'); ?>

                    </div>

                     <!-- Payment Details View For Private-->
                     <div class="col-md-9 tab-pane"  id="payDetails">
                        
                        <?php $this->load->view($this->config->item('theme_uri') . 'polytechnic_affiliation/admin/ins_details/payment_details_view'); ?>

                    </div>

                   

                </div>

        
            </div>
        </div>

        
    </section>

</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>