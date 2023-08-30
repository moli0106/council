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
                    <h2 class="breadcrumb-title">Student Transfer (1st Year)</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Student Transfer (1st Year)</li>
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

        <h4>
            <strong>
               Student Application For Transfer
                <span style="color: #fd7e14;">
                    <?php //echo date('Y'); ?><?php //echo date('y', strtotime(date('Y') . "+ 1 year")); ?>
                    <?php echo $this->config->item('current_academic_year'); ?>
                </span>
            </strong>
        </h4>
        <hr>
        <div class="card border-primary mb-3">
            <div class="card-header">Student Application For Transfer</div>
            <div class="card-body text-dark">
                <?php echo form_open_multipart('polytechnic/transfer/trnsfer_registration',array('id' => 'transfer_form')) ?>
                <div class="row">


                    <input type="hidden" name="spot_id" id="spot_id">
                    <input type="hidden" name="std_id" id="std_id">

                    <!-- <div class="col-md-4">
                        <div class="col-md-8">
                            <span>
                                Transfer For
                                <span class="text-danger">*</span>
                            </span>
                            
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="1" <?php echo set_radio('transfer_for',1);?> type="radio" name="transfer_for" id="transfer_for1">
                            <label class="form-check-label" for="transfer_for1">
                                Discipline change with Institute
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" value="2" <?php echo set_radio('transfer_for',2);?> type="radio" name="transfer_for" id="transfer_for2">
                            <label class="form-check-label" for="transfer_for2">
                               Institute Change
                            </label>
                        </div>
                        <?php echo form_error('transfer_for'); ?>
                    </div> -->
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="reg_no">Registration Number <span class="text-danger">*</span></label>
                            <input id="reg_no" name="reg_no" class="form-control" type="text" value="<?php echo set_value('reg_no'); ?>">
                            <?php echo form_error('reg_no'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="std_name">Student Name <span class="text-danger">*</span></label>
                            <input id="std_name" name="std_name" class="form-control" type="text" value="<?php echo set_value('std_name'); ?>" readonly>
                            <?php echo form_error('std_name'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mobile">Mobile No <span class="text-danger">*</span></label>
                            <!-- <small><i>OTP will be send to this Mobile No.</i></small> -->
                            <input id="mobile" name="mobile" class="form-control" type="text" value="<?php echo set_value('mobile'); ?>">
                            <?php echo form_error('mobile'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="datepicker">D.O.B <span class="text-danger">*</span></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="common_input_div">
                                <input type="text" value="<?php echo set_value("dob"); ?>" class="form-control pull-right dob_range" id="dob" name="dob" placeholder="DD/MM/YYYY">
                                <input type="hidden" value="" id="std_dob">
                            </div>
                        </div>
                        <?php echo form_error('dob'); ?>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="col-md-8">
                            <span>
                                TFW
                                <span class="text-danger">*</span>
                            </span>
                            
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="1" <?php echo set_radio('tfw',1);?> type="radio" name="tfw" id="tfw_yes">
                            <label class="form-check-label" for="tfw_yes">
                                YES
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" value="0" <?php echo set_radio('tfw',0);?> type="radio" name="tfw" id="tfw_no">
                            <label class="form-check-label" for="tfw_no">
                               NO
                            </label>
                        </div>
                        <?php echo form_error('transfer_for'); ?>
                    </div> -->

                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">New Password *</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" value="<?php echo set_value('new_password'); ?>" placeholder="Enter Password">
                            <?php echo form_error('new_password'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Confirm Password *</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>" placeholder="Confirm Your Password">
                            <?php echo form_error('confirm_password'); ?>
                        </div>
                    </div> -->
                   
                </div>

                <div class="existing-vtc-block"><p class = "text-danger"><b>***Check Your Mobile No ,All Communication will be send to this Mobile No</b></p></div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label>&nbsp;</label>
                        <button id="submit" type="submit" value="submit" class="btn btn-info btn-block">Submit application</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>

<script>
    $(document).ready(function() {

        $('#dob').datepicker({
            dateFormat: 'dd/mm/yy',
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            
        });

        // $('.select2').select2();
       
        $(document).on('blur', '#reg_no', function() {

            var reg_no = $(this).val();
            if (reg_no != '') {
                var myArray = reg_no.split('');
                if(myArray[0] === 'D'){
                
                    Swal.fire({
                        title: 'Please wait a moment!',
                        html: 'We\'ll collecting the data.',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();

                            setTimeout(function() {

                                $.ajax({
                                        url: "polytechnic/transfer/getStudentName/" + reg_no,
                                        type: 'GET',
                                        dataType: "json",
                                    })
                                    .done(function(res) {
                                        if (res.data != '') {
                                            console.log(res.data);
                                            //console.log(res.data.name);
                                            $('#std_name').val(res.data.name);
                                            $('#mobile').val(res.data.mobile);
                                            $('#std_id').val(res.data.institute_student_details_id_pk);
                                            $('#spot_id').val(res.data.spotcouncil_student_details_id_fk);
                                            $('#dob').val(res.data.dob);
                                            
                                            Swal.close();
                                        } else {
                                            $('#std_name').val('');
                                            $('#mobile').val('');
                                            $('#std_id').val('');
                                            $('#spot_id').val('');
                                            Swal.fire('Warning!', 'Your Registration Number not found, Please contact Council Administration.', 'warning');
                                        }
                                    })
                                    .fail(function(res) {
                                        $('#std_name').val('');
                                        $('#mobile').val('');
                                        $('#std_id').val('');
                                        $('#spot_id').val('');
                                        Swal.fire('Warning!', 'Oops! Registration Number not found.', 'warning');
                                    });

                            }, 100);
                        }
                    });
                }else{
                    Swal.fire('Warning!', 'Oops! Registration Number Format is not correct.', 'warning');
                }
            }
        });

        // $('#transfer_form').submit(function() {
            
        //     var std_dob = $("#std_dob").val();
        //     var std_dob1 = $("#dob").val();
        //     if (new Date(std_dob) != new Date(std_dob1)) {
        //         // alert("Second value should less than first value");
        //         Swal.fire('Date of Birth mismatch')
        //         return false;
        //     } else {
                
        //         return true;
        //     }
        // });

        

       
    });

    
</script>