<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<style>
.star {
    color: red;
    font-size: 14px;
}

.mtop20 {
    margin-top: 20px;
}

.mbottom20 {
    margin-bottom: 20px;
}

.mright20 {
    margin-right: 20px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Data List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Data List</li>
        </ol>
    </section>
    <section class="content">
        <?php if (isset($status)) { ?>

        <div class="alert alert-<?php echo $status ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message ?>
        </div>

        <?php } ?>

        <!-- Search Domain by Birendra Singh on 25-02-2021 -->
        <div class="box">

            <!-- END of Search Domain -->
            <div class="box-header with-border">
                <h3 class="box-title">Student data List</h3>
                <!-- <div style="margin-left:1000px">
                <a href="spot_council/student_data_list/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a> </div>

                <div style="margin-left:1000px;"> <a href="spot_council/student_data_list/merit_list_pdf"><button type="button" class="btn btn-info" title="pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button></a>  
                -->

                <!-- </div> -->
                <!-- Added by Moli on 25-03-2023 -->
                <div class="box-tools pull-right">
                    <div class="has-feedback">
                        <button type="button" class="btn bg-maroon btn-flat btn-sm mark_std_eligibility">Mark Eligible Student</button>
                    </div>
                </div>

                <div class="box-tools pull-right">
                   
                </div>
            </div>
            <br>
            <div class="box-body">
                <!-- added on 27-02-2023 -->
                <?php echo form_open("admin/institute_student/student_list",array('id'=>"search")); ?>
           <div class="row">
              <div class="col-md-6">
                        <label for="pan">Aadhaar Number</label>
                        <input type="text" name="aadhar" id="aadhar" value="<?php echo set_value('aadhar'); ?>" class="form-control" placeholder="Aadhaar">
                        
                </div>

                <div class="col-md-2">
                        <span for="">&nbsp;</span><br>
                        <button type="submit" class="btn btn-primary">Search</button>
                        
                </div>
           </div> 
           <?php echo form_close(); ?>
           <br><br> 

<!-- end -->
                <?php //if (count($student_data_list)) { 
				if (count($student_data_list)){
				?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Candidate Name</th>
                            <th>Guardian's Name </th>
                            <th>Course</th>
                            <th>Aadhar No</th>
                            <th>Exam Type</th>
                            <!-- <th>Gender</th> -->
                            <th>Status</th>
                            <th>Admission Type</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $offset + 1;
                            foreach ($student_data_list as $student_data) {
                                    //echo '<pre>'; print_r($student_data['eligible_for_exam']); die;
                            ?>
                        <tr>
                            <td>
                                <?php if ($vtc_id == 4179){ ?>
                                <?php if(($student_data['approve_reject_status'] == 1) && ($student_data['council_approvedreject_status']== 1 || $student_data['council_approvedreject_status']== null) && ($student_data['eligible_for_exam']!= 1)){?>
                                    <input type="checkbox" name="std_id_pk" class="checkStd" value="<?php echo ($student_data['institute_student_details_id_pk']); ?>">
                                <?php }?>
                                <?php }?>
                                <?php echo $i ?>
                            </td>
                            <td><?php echo $student_data['first_name'] ?> <?php echo $student_data['middle_name'] ?> <?php echo $student_data['last_name'] ?></td>
                            <td><?php echo $student_data['guardian_name'] ?></td>
                            <td><?php echo $student_data['discipline_name'] ?></td>
                            <td><?php echo $student_data['aadhar_no'] ?></td>
                            <td><?php echo $student_data['name_for_std_reg'] ?></td>

                           <!--  <td><?php echo $student_data['gender_description'] ?></td> -->
                            <td>
                             <?php if( $student_data['approve_reject_status']== 1){?>
                                Approved
                         <?php }else if($student_data['approve_reject_status']== 2) { ?>
                            Re Approved <?php ?>

                                    <?php }else if($student_data['approve_reject_status']== 0) { ?>
                                    Reject <?php } ?>

                                    <!-- added by Moli -->
                                    <br>
                                    <?php if( $student_data['council_approvedreject_status']== 0 && $student_data['council_approvedreject_status']!= null){?>
                                        <small class="label label-danger">Council De-active</small>
                                    <?php }?> 
                                    <br>
                                    <?php if( $student_data['eligible_for_exam']== 1){?>
                                        <small class="label label-success">Eligible</small>
                                    <?php }?>
                                    <!-- added by Moli -->
                                </td>

                            <td>
                            <?php if( $student_data['admission_type']== 1){?>
                                JEXPO/VOCLET/PHARMACY Counselling
                            <?php }elseif( $student_data['admission_type']== 2){?>
                                 Under Management Quota
                            <?php   }elseif($student_data['admission_type']== 3){?>
                                Other form of Admission
                             <?php }else{
                                
                             } ?>
                            </td>
                            <td class="action_buttons">
                            <?php if($student_data['approve_reject_status'] == '' ||$student_data['approve_reject_status']== 2) {?>
                                <button class="btn btn-sm btn-warning approve-reject-modal" data-id="<?php echo md5($student_data['institute_student_details_id_pk'])?>" data-toggle="modal" data-target="#approve-reject-modal" title="Appprove or Reject"><i class="fa fa-level-up" aria-hidden="true"></i>Approve/Reject</button>
                            <?php }elseif($student_data['approve_reject_status'] == 0) {?>
                                <button class="btn btn-sm btn-primary modal-reject-note bg-maroon" data-id="<?php echo md5($student_data['institute_student_details_id_pk'])?>" data-toggle="modal" data-target="#modal-reject-note" title="View Reject Note"><i class="fa fa-eye" aria-hidden="true"></i>Rejected Note</button>
                            <?php }?>

                            <a class="btn btn-info btn-xm" title = Details href="<?php  echo base_url('admin/institute_student/student_list/studentViewByInstitute/'.md5($student_data['institute_id_fk']).'/'.md5($student_data['institute_student_details_id_pk'])); ?>" > <i class="fa fa-folder-open-o" aria-hidden="true"></i></a>

                            </td>
                        </tr>
                        <?php $i++;
                            } ?>
                    </tbody>
                </table>
                <?php  } else { ?>
                No Data Found

                <?php  } ?>


            </div>
            <div class="box-footer">
                <?php echo $page_links ?>
            </div>
        </div>
        <!-- END of Search Domain -->
    </section>
    
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<div class="modal modal-info" id="approve-reject-modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Student Approve / Reject</h4>
            </div>
            <div class="modal-body approve-reject-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-info fade" id="modal-reject-note" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Show Rejected Notes</h4>
            </div>
            <div class="modal-body reject-note-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>