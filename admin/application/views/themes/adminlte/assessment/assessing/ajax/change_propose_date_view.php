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



<?php echo form_open("admin/assessment/assessing/batch/change_propose_date", array("id" => "propose_date_form")); ?>

<label for="">Batch Code: </label><span> <?php echo $batch_details['user_batch_id']; ?></span><br><br>

<input type="hidden" name="batch_id_hash" value="<?php echo $batch_details['assessment_batch_id_pk']; ?>">

<div class="">


    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label class="" for="">Assessment Start Date : </label>

                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="common_input_div">
                        <input type="text" name="start_date" class="form-control date-picker-class required" placeholder="DD-MM-YYYY" readonly="true" value="<?php if ($batch_details['batch_start_date'])
                                                                                                                                                                    echo date("d-m-Y", strtotime($batch_details['batch_start_date']));
                                                                                                                                                                ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="form-group">
                <label class="" for="">Assessment End Date : </label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="common_input_div">
                        <input type="text" name="end_date" class="form-control date-picker-class required" placeholder="DD-MM-YYYY" readonly="true" value="<?php if ($batch_details['batch_end_date'])
                                                                                                                                                                echo date("d-m-Y", strtotime($batch_details['batch_end_date']));
                                                                                                                                                            ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="form-group">
                <label class="" for="">Proposed Assessment Date : </label>

                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="common_input_div">
                        <input type="text" name="propose_date" class="form-control date-picker-class required" placeholder="DD-MM-YYYY" readonly="true" value="<?php if ($batch_details['proposed_assessment_date'])
                                                                                                                                                                    echo date("d-m-Y", strtotime($batch_details['proposed_assessment_date']));
                                                                                                                                                                ?>">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">

            <button type="submit" class="btn btn-warning btn-block btn-flat" id="uptd-propose-date">Update Propose Date</button>
        </div>
    </div>
</div>

<?php echo form_close() ?>

<script>
    $(".date-picker-class").datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    });
</script>