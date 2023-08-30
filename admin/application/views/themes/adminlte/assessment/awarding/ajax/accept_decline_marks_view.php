<?php echo form_open('admin/assessment/awarding/batch/acceptdeclinemarks', array('id' => 'accept-decline-marks-form')) ?>
<div class="row">

    <div class="col-md-12">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>
    </div>

    <input type="hidden" class="form-control" name="id_hash" value="<?php echo $id_hash; ?>">

    <input type="hidden" class="form-control" name="status" value="<?php echo $status; ?>">

    <div class="col-md-12">
        <div class="form-group">
            <label for="comment">
                Comment
                <?php if ($status == 2) echo '<span class="text-danger">*</span>' ?>
            </label>
            <textarea class="form-control" name="comment" rows="5" id="comment"><?php echo set_value('comment'); ?></textarea>
            <?php echo form_error('comment'); ?>
        </div>
    </div>

    <div class="col-md-12 text-center">
        <?php if (!isset($updated)) { ?>
            <button type="submit" class="btn btn-success">Submit</button>
        <?php } ?>
    </div>
</div>

<?php echo form_close() ?>