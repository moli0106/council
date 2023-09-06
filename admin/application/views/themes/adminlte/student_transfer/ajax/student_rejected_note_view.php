<label for="">Student Name: </label><span> <?php echo $student_data['first_name']; ?> <?php echo $student_data['middle_name']; ?> <?php echo $student_data['last_name']; ?> </span><br><br>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="" for="">Rejected Date : </label>
            <span><?php echo date('d-m-Y', strtotime($student_data['transfer_verify_reject_time']))?></span><br>

            <label class="" for="">Remarks : </label>
            <span><?php echo $student_data['transfer_reject_note']?></span>

        </div>
    </div>
</div>