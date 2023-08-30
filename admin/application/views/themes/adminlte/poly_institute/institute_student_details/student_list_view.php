<div class="box box-success" style="padding: 2px 8px 8px 8px;">
   
<div class="box-header with-border">
        <h3 class="box-title">Student Details</h3>
       <div class="box-tools pull-right"> 
        <input type="hidden" value="<?php echo $institute_id_fk; ?>" id="institute_id_fk">
        <button class='std_reg_certificate_btn'> Reg No Generate For 1st Year</button>
        <button class='std_reg2_certificate_btn'>Reg No Generate For 2nd Year</button>
        </div> 

    </div>
    <div class="box-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Exam Type</th>
                    <th>Discipline Name</th>
                    <th>Reg No</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Aadhar No</th>
                    <th>Date of Birth</th>
                    <th>Status</th>
                     <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                <?php if (count($studentUnderInstitute) > 0) { ?>
                <?php  foreach ($studentUnderInstitute as $key => $value) { ?>
                <tr id="<?php echo md5($value['institute_student_details_id_pk']); ?>">
                    <td><?php echo ++$count; ?>.</td>
                    <!--  22-03-2023 -->
                    <td><?php echo $value['name_for_std_reg']; ?></td>
                    <td><?php echo $value['discipline_name']; ?></td>
                    <td><?php echo $value['reg_certificate_number']; ?></td>
                    <!--  -->
                    <td><?php echo $value['first_name']; ?> <?php echo $value['middle_name']; ?> <?php echo $value['last_name']; ?></td>
                    <td><?php echo $value['mobile_number']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo $value['aadhar_no']; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($value['date_of_birth'])); ?></td>
                    <td>
                        <?php if( $value['approve_reject_status']== 1){?>
                                Approved
                         <?php }else if($value['approve_reject_status']== 2) { ?>
                            Re Approved <?php ?>

                                    <?php }else if($value['approve_reject_status']== 0) { ?>
                                    Reject <?php } ?>

                            <!-- Added by Moli on 24-05-2023 -->
                            <br>
                            <?php if( $value['reg_cancel_status']== 1){?>
                                <small class="label label-danger">Cancel Registration</small>
                            <?php }?>


                        <!-- added by Moli -->
                        <br>
                        <?php if( $value['council_approvedreject_status']== 0 && $value['council_approvedreject_status']!= null){?>
                            <small class="label label-danger">Council De-active</small>
                        <?php }?> 
                        <br>
                        <?php if( $value['eligible_for_exam']== 1){?>
                            <small class="label label-success">Eligible</small>
                        <?php }?>
                        <!-- added by Moli -->
                    </td>
                     <td>
                     <?php // if($student_data['approve_reject_status'] == '') {?>

                     <button class="btn btn-sm btn-warning re-approve-modal" data-id="<?php echo md5($value['institute_student_details_id_pk'])?>" data-toggle="modal" data-target="#re-approve-modal" title="Re Appprove"><i class="fa fa-level-up" aria-hidden="true"></i>Re Approved</button>
                     
                     <!-- Addede by Moli on 24-05-2023 -->
                    <?php if( $value['reg_cancel_status']== 0){?>
                        <button class="btn btn-sm btn-danger cancel_reg_modal" data-id="<?php echo md5($value['institute_student_details_id_pk'])?>" data-toggle="modal" data-target="#cancel_reg_modal" title="Cancel Registration"><i class="fa fa-times" aria-hidden="true"></i></button>
                    <?php }else{?>
                        
                        <button class="btn btn-sm btn-primary modal-reject-note bg-maroon" data-id="<?php echo md5($value['institute_student_details_id_pk'])?>" data-toggle="modal" data-target="#modal-reject-note" title="View Reject Note"><i class="fa fa-eye" aria-hidden="true"></i>Rejected Note</button>

                    <?php }?>
                     <?php if($value['approve_reject_status'] == 0) {?>
                                <button class="btn btn-sm btn-primary modal-reject-note bg-maroon" data-id="<?php echo md5($value['institute_student_details_id_pk'])?>" data-toggle="modal" data-target="#modal-reject-note" title="View Reject Note"><i class="fa fa-eye" aria-hidden="true"></i>Rejected Note</button>
                            <?php }?>
                     <a class="btn btn-info btn-xm" title = Details href="<?php  echo base_url('admin/poly_institute/institute_list/student_own_details/'.md5($value['institute_student_details_id_pk'])); ?>" > <i class="fa fa-folder-open-o" aria-hidden="true"></i></a></td>
                   
				  <!--Abhijit on 18-03-2023-->
				  <td>
					<?php
						if($value['council_approvedreject_status'] == 1 || $value['council_approvedreject_status'] == '') {
							echo'<button class="btn btn-sm btn-danger changeStatus"   data-name="Deactivate">
								<i class="fa fa-power-off" aria-hidden="true"></i>
							</button>';
						}    
						elseif($value['council_approvedreject_status'] == 0) {
							echo'<button class="btn btn-sm btn-success changeStatus" data-name="Activate">
								<i class="fa fa-power-off" aria-hidden="true"></i>
							</button>';
						}    
					?>
					</td>
                </tr>
                <?php  } ?>
                <?php } else { ?>
                <tr>
                    <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Added by moli on 23-05-23 -->
    <div class="modal modal-info" id="cancel_reg_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Cancel Registration</h4>
            </div>
            <div class="modal-body std_reg_data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


    <div class="modal modal-info" id="re-approve-modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Student Approve / Reject</h4>
                </div>
                <div class="modal-body re-approve-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
                
                    

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
</div>