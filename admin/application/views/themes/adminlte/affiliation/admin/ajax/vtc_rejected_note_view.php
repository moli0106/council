
<label for="">VTC Name: </label><span> <?php echo $vtcDetails['vtc_name']; ?></span><br><br>
<label for="">VTC Code: </label><span> <?php echo $vtcDetails['vtc_code']; ?></span><br><br>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="" for="">Rejected Date : </label>
            <span><?php echo date('d-m-Y', strtotime($vtcDetails['approve_reject_time']))?></span><br>

            <label class="" for="">Remarks : </label>
            <span><?php echo $vtcDetails['vtc_rejection_note']?></span>

        </div>
    </div>
</div>

    

