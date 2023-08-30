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



<?php echo form_open("admin/poly_institute/institute_list/cancelStudentRegistration", array("id" => "reg_cancel_form")); ?>

<label for="">Student Name: </label><span> <?php echo $student_data['first_name']; ?> <?php echo $student_data['middle_name']; ?> <?php echo $student_data['last_name']; ?> </span><br><br>


<input type="hidden" name="std_id_hash" value="<?php echo md5($student_data['institute_student_details_id_pk']); ?>">
<div class="">

    <div class="row">
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
            <button type="submit" class="btn btn-success btn-block btn-flat reg_cancel_btn" >
              <i class="fa fa-thumbs-up" aria-hidden="true"></i>  Submit
            </button>
        </div>
        
     </div>
        
    </div>
</div>

<?php echo form_close() ?>

    

