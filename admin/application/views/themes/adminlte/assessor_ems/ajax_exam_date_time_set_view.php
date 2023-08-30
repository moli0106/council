<style>
	.star{
		color: #F00;
		font-size : 18px;
	}
	.modal-header {
    background: #29B6D6;
    color: #FFF;
}
.modal-footer {
    background: #29B6D6;
    color: #FFF;
}
</style>
<ul class="list-group">
    <li class="list-group-item">Batch Start Date: <b><?php echo date("d/m/Y", strtotime($batch_details[0]['start_date'])); ?></b></li>
    <li class="list-group-item">Batch Start Time.: <b><?php echo date("H:i", strtotime($batch_details[0]['start_time'])); ?></b></li>  
	<li class="list-group-item">Batch End Date: <b><?php echo date("d/m/Y", strtotime($batch_details[0]['end_date'])); ?></b></li>
    <li class="list-group-item">Batch End Time.: <b><?php echo date("H:i", strtotime($batch_details[0]['end_time'])); ?></b></li>  
      
</ul>
<?php if(isset($code)){ ?>
    <?php if($code == '1'){ $class = 'alert-success'; } else{ $class = 'alert-warning'; }?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert <?php echo $class; ?> text-center">
                <span><b><?php echo $msg; ?></b></span>
            </div>
        </div>
    </div>
<?php } else{?>
	<?php echo form_open(base_url('admin/assessor_ems/assessor_batch/confirm_set_exam_time'), array('id'=>'set_exam_time_form'))?>
        <div class="row">
            <div class="col-md-6">
				<div class="form-group">
					<label>Exam Date : <span class="text-danger">*</span></label>
					<input type="text" value="<?php echo set_value("exam_start_date"); ?>" class="form-control pull-right startdate" id="exam_start_date" name="exam_start_date" placeholder="DD/MM/YYYY" autocomplete="off" readonly>
					<?php echo form_error('exam_start_date'); ?>
				</div>
			</div>  
			<div class="col-md-6 bootstrap-timepicker">
				<div class="form-group">
					<label class="" for="">Exam Start Time (24 Hrs Format)<span class="text-danger">*</span></label>
					<input type="text" value="<?php echo set_value('exam_start_time'); ?>" class="form-control pull-right timepicker" id="exam_start_time" name="exam_start_time" readonly>
					<?php echo form_error('exam_start_time'); ?>
				</div>
			</div>  	
        </div>
        <div class="row">
            <div class="col-sm-12">
                <span style="color:#F00; font-size:16px; font-weight:bold;">Are you sure? Do you want to set Exam Date and Exam Time?</span>
            </div>
        </div>
        <input type="hidden" name="batch_id_hash" id="batch_id_hash" value="<?php echo md5($batch_details[0]['batch_ems_id_pk']);?>">
    <?php echo form_close(); ?>
<?php } ?>
<?php if($this->input->method(TRUE) == 'POST'){ ?>
	<?php if(isset($code) && $code == 1){ ?>
		<script type="text/javascript">
        $(document).ready(function(evt){
				
                var bacth_hash = "<?php echo md5($batch_details[0]['batch_ems_id_pk']); ?>";
				$(".confirm_set_time").remove();
				$("#set_exam_time_"+bacth_hash).remove();
				$("#span_"+bacth_hash).html('Deactivated');
				$("#enter_c_target_"+bacth_hash).remove();
            });
        </script>
	<?php } ?>
    <?php if(isset($code) && $code == 0){ ?>
		<script type="text/javascript">
        $(document).ready(function(evt){
                var bacth_hash = "<?php echo md5($batch_details[0]['batch_ems_id_pk']); ?>";
				$(".confirm_set_time").remove();
            });
        </script>
	<?php } ?>
<?php } ?>

<?php if($this->input->method(TRUE) == 'GET'){ ?>
	<?php if(isset($code) && $code == 0){ ?>
		<script type="text/javascript">
        $(document).ready(function(evt){
                var bacth_hash = "<?php echo md5($batch_details[0]['batch_ems_id_pk']); ?>";
				$(".confirm_set_time").remove();
            });
        </script>
	<?php } ?>
<?php } ?>