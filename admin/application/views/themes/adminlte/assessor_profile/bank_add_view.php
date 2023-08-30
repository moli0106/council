<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Assessor Bank Details</h1>
		<ol class="breadcrumb">
			<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><i class="fa fa-align-center"></i>Assessor Bank Details</li>
		</ol>
	</section>

	<section class="content">
		<?php if ($this->session->flashdata('status') !== null) { ?>
			<div class="alert alert-<?= $this->session->flashdata('status') ?>">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= $this->session->flashdata('alert_msg') ?>
			</div>
		<?php } ?>

		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Assessor Bank Details</h3>
			</div>
			<div class="box-body">
				<?php echo form_open('admin/assessor_profile/add_bank_details') ?>

				<div class="row">
					<div class="col-md-3"></div>

					<div class="col-md-3">
						<div class="form-group <?php echo (form_error('ifsc_code') != '') ? 'has-error' : false; ?>">
							<label for="">IFSC Code <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="<?php echo $assessor_bank_details['bank_ifsc']; ?>" placeholder="Enter IFSC Code">
							<?php echo form_error('ifsc_code'); ?>
						</div>
					</div>

					<?php if (empty($bank_status)) { ?>
						<div class="col-md-3">
							<label class="" for="">&nbsp;</label>
							<button type="button" class="btn btn-success btn-block btn-search-bank-details">
								<i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;Search Bank Details
							</button>
						</div>
					<?php } ?>

					<div class="col-md-3"></div>
				</div>

				<?php if (($this->input->server('REQUEST_METHOD') == "POST") || (!empty($bank_status))) { ?>
					<div class="bank-details">
					<?php } else { ?>
						<div class="bank-details" style="display: none;">
						<?php } ?>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group <?php echo (form_error('ac_holder_name') != '') ? 'has-error' : false; ?>">
									<label for="">Account holders full name<span class="text-danger">*</span></label>
									<input type="text" value="<?php echo $assessor_bank_details['bank_account_holder_name']; ?>" name="ac_holder_name" id="ac_holder_name" class="form-control" placeholder="Account holders name">
									<?php echo form_error('ac_holder_name'); ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group <?php echo (form_error('bank_account_no') != '') ? 'has-error' : false; ?>">
									<label for="">Account Number<span class="star">*</span></label>
									<input type="text" value="<?php echo $assessor_bank_details['bank_account_no']; ?>" name="bank_account_no" id="bank_account_no" class="form-control" placeholder="Account Number" maxlength="30">
									<?php echo form_error('bank_account_no'); ?>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group <?php echo (form_error('bank_name') != '') ? 'has-error' : false; ?>">
									<label for="block">Bank Name<span class="star">*</span></label>
									<input readonly type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" value="<?php echo $assessor_bank_details['bank_name']; ?>">

									<?php echo form_error('bank_name'); ?>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group <?php echo (form_error('branch_name') != '') ? 'has-error' : false; ?>">
									<label for="block">Branch Name<span class="star">*</span></label>
									<input readonly type="text" class="form-control" name="branch_name" id="branch_name" placeholder="Bank Branch" value="<?php echo $assessor_bank_details['bank_branch_name']; ?>">
									<?php echo form_error('branch_name'); ?>
								</div>
							</div>
						</div>

						<?php if (empty($bank_status)) { ?>
							<div class="row">
								<div class="col-md-4 col-md-offset-4">
									<label class="" for="">&nbsp;</label>
									<button type="submit" class="btn btn-success btn-block">Bank Details</button>
								</div>
							</div>
						<?php } ?>

						</div>
						<?php echo form_close() ?>
					</div>
			</div>
	</section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>