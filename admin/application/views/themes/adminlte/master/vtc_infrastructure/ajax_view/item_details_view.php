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

<div class="row">
   

    <div class="box-body">
        <?php echo form_open('admin/master/infrastructure/updateInfrastructureItem/'. md5($itemDetails['infrastructure_item_id_pk'])) ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Infrastructure Item Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="item_name"
                        value="<?php echo $itemDetails['item_name']; ?>" placeholder="Enter Infrastructure Item">
                    <?php echo form_error('item_name'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Infrastructure Category <span class="text-danger">*</span></label>
                    <select class="form-control required" style="width: 100%;" name="category_name" id="category_name">
                        <option value="" hidden="true">Select Infrastructure Category</option>
                        <option value="1" <?php if($itemDetails['category_name'] == 1){echo "selected";} ?>>Vocational Paper Laboratory</option>
                        <option value="2" <?php if($itemDetails['category_name'] == 2){echo "selected";} ?>>Other Common Laboratory</option>
                    </select>
                    <?php echo form_error('category_name'); ?>
                </div>
            </div>

            
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success btn-block btn-flat" id = "update-infrastructure-item-btn"
                    >
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    Update Infrastructure Item
                </button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>