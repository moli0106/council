<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>

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

<div class="content-wrapper">
    <section class="content-header">
        <h1>SBI Response</h1>
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
                <h3 class="box-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error Response List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <?php echo form_open("admin/sbiepay/response/updatestdPaymentResponse", array("id" => "sbi_response_form")); ?>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="payment_type_id_fk">Select Payment Type <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="payment_type_id_fk" id="payment_type_id_fk">
                                    <option value="" hidden="true">Select Payment Type</option>
                                    <!-- <option value="2" <?php echo set_select('payment_type_id_fk', '1')?>>Student Reg Fee</option> -->
                                    <option value="6" <?php echo set_select('payment_type_id_fk', '5')?>>Other Diploma Student Reg Fee</option>

                                </select>
                                <?php echo form_error('payment_type_id_fk'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">From Date : </label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="common_input_div">
                                        <input type="text" name="from_date" class="form-control date-picker-class required" placeholder="DD-MM-YYYY" readonly="true" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">To Date : </label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="common_input_div">
                                        <input type="text" name="to_date" class="form-control date-picker-class required" placeholder="DD-MM-YYYY" readonly="true" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">

                            <button type="submit" class="btn btn-warning btn-block btn-flat" id="upd_sbi_response">Update Response</button>
                        </div>
                    </div>
                <?php echo form_close() ?>
				
				
				<?php echo form_open("admin/sbiepay/response/upd_merchant_no") ?>
				<input type="text" name="csrf_council" >
				<input type="text" name="moli_merchant_id" >
				<input type="submit" class="btn btn-warning btn-block btn-flat">Update Status</input>
				
				<?php echo form_close() ?>
            </div>
            <div class="box-footer"></div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>
<script type="text/javascript">
    $(".date-picker-class").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $(document).on('click', '#upd_sbi_response', function(e) {
        e.preventDefault();
        // alert('jjj');
        var error = 0;

        $(this).closest('form').find('input').each(function() {
            if ($(this).hasClass('required')) {
                if ($(this).val() == '') {
                    $(this).removeClass('green-border');
                    $(this).addClass('red-border');
                    ++error;
                } else {
                    $(this).removeClass('red-border');
                    $(this).addClass('green-border');
                }
            }
        });

        var action_page = $("#sbi_response_form").attr("action");

        Swal.fire({
            title: 'Warning!<br>Are you sure?',
            text: "You want to get Response.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Do it!',
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Please wait a moment!',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
						$.ajaxSetup({async:false});
                        // $("#sbi_response_form").submit();
                        $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: action_page,
                                data: $("#sbi_response_form").serialize(),
                            })
                            .done(function(response) {
                                console.log(response.merchant_id);
                                var data = response.merchant_id;
								console.log(data.length);
								var myarray = [];
								
								for (var i = 0; i < data.length; i++) {
                                    //const rest = data[i];
                                    //var queryRequest = '|1001954|'+rest+'|450';
                                    const rest = data[i].transaction_id;
                                    const amount = data[i].amount;
                                    var queryRequest = '|1001954|'+rest+'|'+amount;
									//console.log(queryRequest);
                                    $.post("https://www.sbiepay.sbi/payagg/statusQuery/getStatusQuery",
										{
										  queryRequest: "|1001954|"+rest+"|"+amount,
										  aggregatorId: "SBIEPAY",
										  merchantId:"1001954"
										},
										function(data,status){
										  //alert("Data: " + data + "\nStatus: " + status);
										  myarray.push(data);
										});
										
										//wait(1000);
                                    
                                }
								console.log(myarray);
								console.log( Object.assign({}, myarray));
								
								//var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
								
								$("input[name=csrf_council]").val(response.csrf_token);
								$("input[name=moli_merchant_id]").val(JSON.stringify(myarray));
								$.ajaxSetup({async:false});
								$.post( "sbiepay/response/upd_merchant_no", { transaction_id: Object.assign({}, myarray) })
								 .done(function( data1 ) {
									 //alert( "Data Loaded: " + data );
									 console.log(data1);
									 Swal.fire('Success!', 'Data successfully updated.!', 'success');
								});
								
								
								
								
								
                                
								
                                    


                                // if (response == 'done') {
                                //     $('#modal-delete-assessment-batch').modal('toggle');

                                //     $("#" + id_hash).find('.process-name').text('Assessment Batch Deleted').removeClass('bg-orange').addClass('bg-red');
                                //     $("#" + id_hash).find('.modal-delete-assessment-batch').remove();

                                //     Swal.fire('Success!', 'Assessment batch successfully deleted.!', 'success');
                                // }
                            })
                            .fail(function(res) {
                                Swal.fire('Warning!', 'Oops! Unable to get Data, Please try again later.', 'warning');
                            });
                    }
                })
            }
        });
   
    })


</script>