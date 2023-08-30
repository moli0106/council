<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .card {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }
</style>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">VTC LOGIN</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">VTC</a></li>
                        <li class="breadcrumb-item active">ACKNOWLEDGEMENT</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5">
    <div class="container">

        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <hr>
        <h5 class="text-center">
            <strong>ACKNOWLEDGEMENT</strong>
        </h5>
        <hr>
        <div class="row">
            <div class="col-md-6 ">
                <div class="card border-secondary mb-3">
                    <div class="card-header">Download Acknowledgement Slip</div>
                    <div class="card-body text-dark">
                        SUCCESSFULLY REGISTERED AND DOWNLOAD THE ACKNOWLEDGEMENT SLIP <a href="<?php echo base_url('/online_application_various_courses/registration/std_acknowledgement_pdf_download/'.$std_id_hash);?>" ?> CLICK HERE</a>
                    </div> 
                </div>

                
            </div>
            <?php if($stdDetails['course_id_fk'] == 1 || $stdDetails['course_id_fk'] == 2){?>

                

                <div class="col-md-6 ">
                    <div class="card border-secondary mb-3">
                        <div class="card-header">Online Application Fee</div>
                        <div class="card-body text-dark">
                        <?php echo form_open_multipart("sbiepay/proceed_to_pay"); ?>
                
                            <input type="hidden" value="3" name="payment_type">
                            <input type="hidden" value="<?php echo $stdDetails['student_details_id_pk']?>" name="stake_details_id_fk">
                            <br><button type="submit"  class="btn btn-info btn-sm">Proceed To Pay</button>
                        <?php echo form_close() ?>
                        </div> 
                    </div>

                    
                </div>
            <?php }?>
        </div>
    </div>
</section>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>



</body>