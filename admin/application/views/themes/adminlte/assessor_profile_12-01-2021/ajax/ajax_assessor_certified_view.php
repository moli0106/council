 <div class="row agency_section">
    <div class="col-md-3">
        <div class="form-group">
            <label for="designation">Assessing body <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Assessing body" name="assessing_body[<?php echo $assessing_body_count ?>]">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="designation">Assessor certificate number <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Assessor certificate number" name="certificate_number[<?php echo $assessing_body_count ?>]">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="designation">Upload Doc (PDF only, Max 50KB) <span class="text-danger">*</span></label>
            <input type="file" class="form-control" placeholder="Upload Doc" name="certificate_doc_<?php echo $assessing_body_count ?>">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="designation">&nbsp;</label><br>
            <button type="button" class="btn btn-danger certificate_number_remove"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
    </div>
</div>