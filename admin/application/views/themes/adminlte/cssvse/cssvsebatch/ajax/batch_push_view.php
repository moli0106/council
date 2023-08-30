<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Batch Details</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <?php echo form_open_multipart('admin/cssvsebatch/batch/batchPushToCouncil/' . $id_hash, array('id' => 'form-batch-push')) ?>
                <input type="hidden" name="batch_id" value="<?php echo $id_hash; ?>" readonly="true">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group">
                            <label for="">Prefered Assessment Date 1 <span class="text-danger">*</span></label>
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input class="form-control prefered-assessment-date-1" name="date_1" placeholder="dd/mm/yyyy" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group">
                            <label for="">Prefered Assessment Date 2 <span class="text-danger">*</span></label>
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input class="form-control prefered-assessment-date-2" name="date_2" placeholder="dd/mm/yyyy" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label for="schoolEmail">&nbsp;</label>
                            <button type="button" class="btn btn-sm btn-success btn-flat btn-block" id="btn-batch-push">
                                <i class="fa fa-folder-open-o" aria-hidden="true"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="box-footer"></div>
        </div>
    </div>
</div>