<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Student Payment</li>
            <li class="active"><i class="fa fa-align-center"></i>Payment Proceed</li>
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
                <h3 class="box-title">Proceed To Pay</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">

            <div class="col-md-12">   
 <div class="row">
		
        <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            
			
			
			
            <div>
            <p class="lead"><label for="">Group Name :</label><?php echo $group_details['group_name']?> [<?php echo $group_details['group_code']?>]</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9">Amount Per Student</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> 200/-</td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Total No Of Student</td>
                            <td class="col-md-3">15</td>
                        </tr>
                        
                        
                        <tr>
                           
                            <td class="text-right"><h2><strong>Total: </strong></h2></td>
                            <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> 3000/-</strong></h2></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            
			
			<div class="row">
                <div class="col-12" style="float: right;">
                    <a href = "<?php echo base_url('admin/vtc_student/student_payment'); ?>" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <button type="button" class="btn btn-success float-right"><i class="fa fa-check"></i> Confirm
                        Payment
                    </button>
                    
                </div>
                
				<!-- <div class="receipt-header receipt-header-mid receipt-footer">
					<div class="col-xs-8 col-sm-8 col-md-8 text-left">
						<div class="receipt-right">
							<p><b>Date :</b> 15 Aug 2016</p>
							<h5 style="color: rgb(140, 140, 140);">Thanks for shopping.!</h5>
						</div>
					</div>
					
				</div> -->
            </div>
			
        </div>    
	</div>
</div>
            </div>

        </div>


    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>