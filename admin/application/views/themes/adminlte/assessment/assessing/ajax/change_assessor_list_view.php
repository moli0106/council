<div class="row">
    <div class="col-md-12">
        <input type="hidden" class="form-control" id="change-assessor-id-hash" name="id_hash" value="<?php echo $id_hash; ?>">
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="comment">Select Assessor for Batch</label>
            <select class="form-control select2" name="assessor_id" id="change-assessor-assessor-id" style="width: 100%;">
                <option value="" hidden="true">Select Assessor for Batch</option>
                <?php foreach ($assessorList as $key => $assessor) { ?>
                    <option value="<?php echo $assessor['assessor_registration_details_pk']; ?>">
                        <?php echo $assessor['fname'] . ' ' . $assessor['mname'] . ' ' . $assessor['lname']; ?>
                        [Mob.: <?php echo $assessor['mobile_no']; ?> -- Pan: <?php echo $assessor['pan']; ?>]
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <strong>Note : </strong>
        <span>Here only those Assessor will be listed who is</span>
        <ul style="color: #F44336;">
            <li>Vacent on that Purposed Assessment Date.</li>
            <li>Belong with Preferred/TC District including Clubing (mapping) Ddistrict.</li>
            <li>Assessor didn't mark Inability for any Batches on that Purposed Assessment Date.</li>
        </ul>
    </div>
</div>