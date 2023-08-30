<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>VTC Infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> VTC Infrastructure</li>
            <li><a href="cssvse/cssvse_school"><i class="fa fa-align-center"></i> Final Submit Details</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <!-- Left Menu -->
           

            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border">

                        <h3 class="box-title">Pages</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#paperLabDetails" data-toggle="tab">Vocational Paper Laboratory</a>

                            <li class=""><a href="#otherCmnLabDetails" data-toggle="tab"> Other Common Laboratory</a></li>

                            <li class=""><a href="#classRoomDetails" data-toggle="tab"> Class Room Details</a></li>

                            <li class=""><a href="#otherInfraDetails" data-toggle="tab"> Other Infrastructure Details</a></li>

                            <li class=""><a href="#computerLabDetails" data-toggle="tab"> Computer Lab Details</a></li>

                            <li class=""><a href="#agriDisciplineDetails" data-toggle="tab"> Agriculture Discipline Details</a></li>

                            <?php if (!empty($paperLabData) && !empty($commonLabData) && !empty($classRoomData) && !empty($labSizeData) && !empty($otherData) && !empty($computerLabData)) { ?>
                                <?php if ($vtcDetails['second_final_submit_status'] == 0) { ?>
                                    <li><a href="#finalsubmit" data-toggle="tab">Final Submit</a></li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div> -->

                    <div class="box-body no-padding">
                   
                   <ul class="timeline nav nav-pills nav-stacked">
                       <!-- timeline time label -->
                       
                       <!-- /.timeline-label -->
                       <!-- timeline item -->
                       <li class="active">
                           <i class="fa <?php echo (!empty($paperLabData)&&($checkPaperLabDataCount == 'match')) ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                           <div class="timeline-item">
                               <h3 class="timeline-header">
                                   <a href="#paperLabDetails" data-toggle="tab"> Vocational Paper Laboratory</a>
                               </h3>
                           </div>
                       </li>
                       <li>
                           <i class="fa <?php echo (!empty($commonLabData) && $checkCommonLabHsDiscipline == 'match') ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                           <div class="timeline-item">
                               <h3 class="timeline-header">
                                   <a href="#otherCmnLabDetails" data-toggle="tab"> Other Common Laboratory</a>
                               </h3>
                           </div>
                       </li>

                       <li>
                           <i class="fa <?php echo !empty($classRoomData) ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                           <div class="timeline-item">
                               <h3 class="timeline-header">
                                   <a href="#classRoomDetails" data-toggle="tab"> Class Room Details</a>
                               </h3>
                           </div>
                       </li>

                       <li>
                           <i class="fa <?php echo !empty($otherData) ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                           <div class="timeline-item">
                               <h3 class="timeline-header">
                                   <a href="#otherInfraDetails" data-toggle="tab"> Other Infrastructure Details</a>
                               </h3>
                           </div>
                       </li>

                       <li>
                           <i class="fa <?php echo !empty($computerLabData) ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                           <div class="timeline-item">
                               <h3 class="timeline-header">
                                   <a href="#computerLabDetails" data-toggle="tab"> Computer Lab Details</a>
                               </h3>
                           </div>
                       </li>

                       <li>
                           &nbsp;<i class="fa <?php echo !empty($agriData) ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                           <div class="timeline-item">
                               <h3 class="timeline-header">
                                   <a href="#agriDisciplineDetails" data-toggle="tab"> Agriculture Discipline Details</a>
                               </h3>
                           </div>
                       </li>

                       <!-- /added By MOLI on 21-05-2023 -->

                        <li>
                           &nbsp;<i class="fa <?php //echo !empty($agriData) ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                           <div class="timeline-item">
                               <h3 class="timeline-header">
                                   <a href="#payAffiliationFees" data-toggle="tab"> Pay For Affiliation</a>
                               </h3>
                           </div>
                        </li>

                        <li>

                        <?php //if (($checkPaperLabDataCount == 'match') && ($checkCommonLabHsDiscipline == 'match')  && !empty($classRoomData) && !empty($labSizeData) && !empty($otherData) && !empty($computerLabData)) { ?>
                            <?php if ($vtcDetails['second_final_submit_status'] == 1) { ?>

                                <i class="fa fa-check bg-green"></i>
                            <?php }else{?>
                                            
                                <i class="fa fa-close bg-red"></i>
                                        
                            <?php } ?>
                           
                            <div class="timeline-item">
                          
                               <?php //if ($vtcDetails['second_final_submit_status'] == 0) { ?>
                                   
                                   <h3 class="timeline-header">
                                       <a href="#finalsubmit" data-toggle="tab">Final Submit</a>
                                   </h3>
                               <?php //} ?>

                           
                            </div>
                        </li>
                   
                       <!-- END timeline item -->
                   </ul>
               
                   <!--timeline end -->
               
               </div>


                    

                </div>
            </div>
            <!-- Left Menu -->
            <div class="tab-content">

                <!-- Added by Moli on 21-05-2023  -->
                <div class="col-md-9 tab-pane"  id="payAffiliationFees">

                    <?php $this->load->view($this->config->item('theme_uri') . 'vtc_infrastructure/final_submit/affiliation_payment_view'); ?>

                </div>
                
                <!-- Paper Lab View -->
                <div class="col-md-9 active tab-pane"  id="paperLabDetails">

                    <?php $this->load->view($this->config->item('theme_uri') . 'vtc_infrastructure/final_submit/vocational_paper_lab_view'); ?>

                </div>

                <!-- Other Common Lab View -->
                <div class="col-md-9 tab-pane"  id="otherCmnLabDetails">
                    
                    <?php $this->load->view($this->config->item('theme_uri') . 'vtc_infrastructure/final_submit/other_cmn_lab_view'); ?>

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

                <!-- Final Submit View -->

                <div class="col-md-9 tab-pane" id="finalsubmit">
                    <div class="box box-success" style="padding: 2px 8px 8px 8px;">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>
                            <div class="box-tools pull-right"></div>
                        </div>
                        <div class="box-body">
                            <div class="row" style="margin-top: 50px; margin-bottom: 50px;">
                                <div class="col-md-4 col-md-offset-4">

                                    <?php if($agriDisciplineExist == 'yes'){?>

                                        <?php if ($vtcDetails['second_final_submit_status'] == 0) { ?>
                                            <?php if (($checkPaperLabDataCount == 'match') && ($checkCommonLabHsDiscipline == 'match') && !empty($classRoomData) && !empty($labSizeData) && !empty($otherData) && !empty($computerLabData) && !empty($agriData)) { ?>
                                                <button type="button" class="btn btn-success btn-block" id="secondFinalSubmitBtn">Final Submit</button>
                                            
                                            <?php }else{?>
                                            

                                                <strong>
                                                <p style="color: red;">Please fill up all fields</p>
                                                </strong>     
                                            
                                            <?php } ?>
                                        <?php }?>

                                    <?php }else{?>

                                        <?php if ($vtcDetails['second_final_submit_status'] == 0) { ?>
                                            <?php if (($checkPaperLabDataCount == 'match') && ($checkCommonLabHsDiscipline == 'match') && !empty($classRoomData) && !empty($labSizeData) && !empty($otherData) && !empty($computerLabData)) { ?>
                                                <button type="button" class="btn btn-success btn-block" id="secondFinalSubmitBtn">Final Submit</button>
                                                
                                            <?php }else{?>
                                            

                                                <strong>
                                                <p style="color: red;">Please fill up all fields</p>
                                                </strong>     
                                            
                                            <?php } ?>
                                        <?php }?>
                                    <?php }?>
                                
                                    
                                    
                                    <?php if ($vtcDetails['second_final_submit_status'] == 1) { ?>

                                        <h3 class="timeline-header">
                                            <a href=<?php echo base_url('admin/vtc_infrastructure/final_submit/download_vtc_pdf/' . md5($vtcDetails['vtc_details_id_pk'])); ?>  class="block btn btn-sm btn-success bg-yellow" target="_blank" title="Download PDF">Download PDF</a>
                                        </h3>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>