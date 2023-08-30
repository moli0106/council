<label for="">Batch Code: </label><span> <?php echo $batch_details['user_batch_id']?></span><br><br>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="" for="">Deleted Date : </label>
            <span><?php echo date('d-m-Y', strtotime($batch_details['archive_time']))?></span><br>

            <label class="" for="">Remarks : </label>
            <span><?php echo $batch_details['delete_remarks']?></span>

        </div>
    </div>
</div>