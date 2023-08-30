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
</style>



<?php echo form_open("admin/assessment/assessing/batch/deleteAssessmentBatch", array("id" => "batch_delete_form")); ?>

<label for="">Batch Code: </label><span> <?php echo $batch_details['user_batch_id']; ?></span><br><br>

<input type="hidden" name="batch_id_hash" value="<?php echo $batch_details['assessment_batch_id_pk']; ?>">

<div class="">


    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label class="" for="">Remarks : </label>

                <textarea class="form-control required" placeholder="Please Enter Remarks" name="remarks" id="remarks"
                    autocomplete="off" value=""></textarea>
            </div>
        </div>

       

        

    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-5">

            <button type="submit" class="btn btn-warning btn-block btn-flat" id="delete-assessment-batch">Delete Assessment Batch</button>
        </div>
    </div>
</div>

<?php echo form_close() ?>

