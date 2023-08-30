<style>
    .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }

    .approve_btn_main {
        width: 30%;
        display: inline-block;
        margin-left: 5px;
        margin-top: 5px;
    }
</style>



<?php echo form_open("admin/poly_institute/institute_list/updateStudentApproveRejectStatus", array("id" => "reapprove")); ?>

<label for="">Student Name: </label><span> <?php echo $stu_data['first_name']; ?> <?php echo $stu_data['middle_name']; ?> <?php echo $stu_data['last_name']; ?> </span><br><br>


<input type="hidden" name="std_id_hash" value="<?php echo md5($stu_data['institute_student_details_id_pk']); ?>">
<input type="hidden" name="status" id="status" value="">

 <div class="">

    <!-- <div class="row" style="display:none" id="approve_div">
        <div class="col-md-6">
            <span>
                Please select any option 
                <span class="text-danger">*</span>
                <?php echo form_error('management_quota'); ?>
            </span>
        </div>

        <div class="col-md-6 mb-6">
                <label class="radio-inline" for="jexpo_voclet_pharmacy_counselling">
                    <input type="radio" class="form-check-input" name="admission_type" id="jexpo_voclet_pharmacy_counselling" value="1"> JEXPO/VOCLET/PHARMACY Counselling
                </label>
                <label class="radio-inline" for="management_quota_no">
                    <input type="radio" class="form-check-input" name="admission_type" id="under_management_quota" value="2"> Under Management Quota
                </label>

                <label class="radio-inline" for="other_form_of_admission">
                    <input type="radio" class="form-check-input" name="admission_type" id="other_form_of_admission" value="3"> Other form of Admission
                </label>
        </div>
    </div>  -->


     <div class="row" style="display:none" id="div_class">
        <div class="col-md-10">
            <div class="form-group">
                <label class="" for="">Remarks : </label>

                <textarea class="form-control" placeholder="Please Enter Rejection Note" name="remarks" id="remarks"
                    autocomplete="off" value=""></textarea>
            </div>
        </div>

    </div> 

    <div class="row" style="margin-left: 11em;">
      <div class="reapprove-btn">
        <div class="approve_btn_main">
            <button type="submit" class="btn btn-success btn-block btn-flat reapprove_btn" name="submitVtcApprove" value="1">
              <i class="fa fa-thumbs-up" aria-hidden="true"></i> Re Approve
            </button>
        </div>
        
     </div>
        
    </div>
</div>

<?php echo form_close() ?>

    

