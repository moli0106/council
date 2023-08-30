
<?php echo form_open('admin/affiliation/details/change_mob_no',array("id" => "mobile_data")) ?>
<div class="form-group row">

    <input type="hidden" name="vtc_details_id" id="vtc_details_id" value="<?php echo $vtc_details['vtc_details_id_pk']; ?>">

    <label for="hoi_mobile_no" class="col-sm-3 col-form-label">HOI Mobile No. <span class="text-danger">*</span></label>
    <div class="col-sm-6">
        <input type="number" name="hoi_mobile_no" id="mob_no"  class="form-control" value="<?php echo $vtc_details['hoi_mobile_no']; ?>">
    </div>

    <!-- <button type="submit" class="btn btn-primary mb-2">Change Mobile No</button> -->

</div>

<div class="row">

    <div class="col-md-4"></div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary mb-2" id = "change_vtc_mob_no">
            
        Change Mobile No
        </button>
    </div>
</div>

<?php echo form_close() ?>
