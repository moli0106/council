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



<?php echo form_open("admin/vtc_student/student_reg/updateStudentApproveRejectStatus", array("id" => "approve_reject_form")); ?>

<label for="">Student Name: </label><span> <?php echo $student_data['first_name']; ?> <?php echo $student_data['middle_name']; ?> <?php echo $student_data['last_name']; ?> </span><br><br>


<input type="hidden" name="std_id_hash" value="<?php echo md5($student_data['student_id_pk']); ?>">
<input type="hidden" name="status" id="status" value="">

<div class="">


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
      <div class="approve_btn">
        <div class="approve_btn_main">
            <button type="submit" class="btn btn-success btn-block btn-flat approve-btn" name="submitVtcApprove" value="1">
              <i class="fa fa-thumbs-up" aria-hidden="true"></i>  Approve
            </button>
        </div>
        <div class="approve_btn_main">
            <button type="submit" class="btn btn-danger btn-block btn-flat reject-btn" name="submitVtcReject" value="2">
                <i class="fa fa-ban" aria-hidden="true"></i>  Reject
            </button>

        </div>
     </div>
        
    </div>
</div>

<?php echo form_close() ?>

    

