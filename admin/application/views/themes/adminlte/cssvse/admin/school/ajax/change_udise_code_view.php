<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }

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

<?php echo form_open_multipart("admin/cssvse/cssvse_school/update_udise_code"); ?>
<input type="hidden" name="student_id_hash" value="<?php echo implode(",", $stdIdArray) ?>">
<input type="hidden" name="school_id_hash" value="<?php echo $schoolId; ?>">

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">UDISE Code</label>
                    <input min="1" type="number" name="udise_code" value="" class="form-control required" placeholder="Enter UDISE Code">
                </div>
            </div>

            <div class="col-md-12">
                <label></label>
                <button type="submit" class="btn btn-warning btn-block btn-flat" id="chng-udise-btn">submit</button>
            </div>

        </div>
    </div>
</div>
<?php echo form_close() ?>