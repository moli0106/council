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
                        <li class="breadcrumb-item"><a href="#">Registration Affiliation Apply</a></li>
                        <li class="breadcrumb-item active"> Renewal</li>
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
        <div class="card border-primary mb-3">
            <div class="card-header">Institute Affiliation Apply / Renewal</div>
            <div class="card-body text-dark">
                
            
        <div class="col-md-4"><label for="registration_for">
        
            <strong>Registration For</strong><span class="text-danger">*</span></label>
          
            <select name="registration_for" id="registration_for" class="form-control">
                <option value="" hidden="true">Select Anyone</option>
                <option value="1" <?php echo set_select('registration_for', '1'); ?>>VTC/STTC Registration</option>
                <option value="2" <?php echo set_select('registration_for', '2'); ?>>Polytechnic Registration</option>
            </select>
            <?php echo form_error('registration_for'); ?>
        </div>

        <div class="vtcRegView" <?php if ((set_value('registration_for') == 1 ) || (set_value('registration_for') == NULL)) echo 'style="display: none;"'; ?>>

        <?php $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/affiliation_reg_view'); ?>
        </div>

        <div class="polyRegView" <?php if ((set_value('registration_for') == 2 ) || (set_value('registration_for') == NULL)) echo 'style="display: none;"'; ?>>
        <?php $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/polytechnic_reg_view'); ?>
        </div>
        
                
               
            </div>
        </div>
    </div>
</section>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>


<script>
    $(document).ready(function() {

        // $('.select2').select2();

        $('input:radio[name="schoolHaveHigherSecondaryEquivalent"]').change(function() {
            if ($(this).val() == 1) {
                $('.hse-div').show();
            } else {
                $('.hse-div').hide();
            }
        });

        $('input:radio[name="changeInNameAddress"]').change(function() {
            if ($(this).val() == 1) {
                $('.approvalFromCouncil-div').show();
                // $('.documentRegardingChangeOfName-div').show();
            } else {
                $('.approvalFromCouncil-div').hide();
                $('.documentRegardingChangeOfName-div').hide();
                $('.councilApprovalLetter-div').hide();
            }
        });

        $('input:radio[name="approvalFromCouncil"]').change(function() {
            if ($(this).val() == 1) {
                $('.councilApprovalLetter-div').show();
                $('.documentRegardingChangeOfName-div').hide();
            } else {
                $('.councilApprovalLetter-div').hide();
                $('.documentRegardingChangeOfName-div').show();
            }
        });

        $('input:radio[name="nearbyExistingVtc"]').change(function() {
            if ($(this).val() == 1) {
                $('.numberOfExistingVtc-div').show();
            } else {
                $('.numberOfExistingVtc-div').hide();
            }
        });

        $(document).on('change', '#vtc_type', function() {
            if ($(this).val() == 1) {
                $('.vtcCode-div').hide();
                $('.managingCommitteeResolution-div').show();
                $("#vtcName").attr("readonly", false).val('');
            } else {
                $('.vtcCode-div').show();
                $('.managingCommitteeResolution-div').hide();
                $('#vtcName').attr('readonly', true);
            }
        });

        $(document).on('blur', '.vtcCode', function() { //Modify By Moli on 13-01-2023

            var vtcCode = $(this).val();
            var registration_for = $('#registration_for').val();
            if (vtcCode != '') {
                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'We\'ll collecting the data.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {

                            $.ajax({
                                    url: "online_app/inst/vtc/affiliation/getVtcName/" + vtcCode,
                                    type: 'GET',
                                    dataType: "json",
                                    data: {registration_for : registration_for}
                                })
                                .done(function(res) {
                                    if (res != '') {
                                        $('.vtcName').val(res);
                                        Swal.close();
                                    } else {
                                        $('.vtcCode').val('');
                                        $('.vtcName').val('');
                                        Swal.fire('Warning!', 'You are not Affiliated, Please contact Council Administration.', 'warning');
                                    }
                                })
                                .fail(function(res) {
                                    $('.vtcName').val('');
                                    $('.vtcCode').val('');
                                    Swal.fire('Warning!', 'Oops! VTC Code not found.', 'warning');
                                });

                        }, 100);
                    }
                });
            }
        });

        $(document).on('change', '#vtc_type_id', function() {
            if ($(this).val() == 'Other') {
                $('.other-type-div').show();
            } else {
                $('.other-type-div').hide();
            }
        });

        $(document).on('change', '#medium_of_instruction', function() {
            if ($(this).val() == 'Other') {
                $('.other-medium-div').show();
            } else {
                $('.other-medium-div').hide();
            }
        });

        $(document).on('change', '#district', function() {
            var district = $(this).val();

            $.ajax({
                    url: "online_app/inst/vtc/affiliation/getSubDivision/" + district,
                    dataType: "JSON",
                })
                .done(function(res) {
                    $('.subDivision').html(res.subDivisionHtml);
                    $('#nodal_id_fk').html(res.nodalOfficerHtml);
                })
                .fail(function() {
                    console.log('error');
                });
        });

        $(document).on('change', '.subDivision', function() {
            var subDivision = $(this).val();

            $.ajax({
                    url: "online_app/inst/vtc/affiliation/getMunicipality/" + subDivision,
                    dataType: "JSON",
                })
                .done(function(res) {
                    $('.municipality').html(res);
                })
                .fail(function() {
                    console.log('error');
                });
        })

        $(document).on('keyup', '#numberOfExistingVtc', function() {

            var numberOfVtc = parseInt($(this).val());

            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {

                        $.ajax({
                                url: "online_app/inst/vtc/affiliation/getExistingVtcBlock/" + numberOfVtc,
                                type: 'GET',
                                dataType: "json",
                            })
                            .done(function(res) {
                                $('.existing-vtc-block').html(res);
                                $('.select2').select2();
                                Swal.close();
                            })
                            .fail(function(res) {
                                $('.existing-vtc-block').html('');
                                Swal.fire('Warning!', 'Oops! Not able to get VTC data.', 'warning');
                            });

                    }, 100);
                }
            });

        });

        $(document).on('change', '.vocationalCoursesbyExistingActiveVtc', function() {

            var vtcCourse = $(this).val();

            var select = $(this).closest('.row').find('.groupCodebyExistingActiveVtc');

            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {

                        $.ajax({
                                url: "online_app/inst/vtc/affiliation/getVtcGroupTradeCode/" + vtcCourse,
                                type: 'GET',
                                dataType: "json",
                            })
                            .done(function(res) {
                                select.html(res);
                                // $('.select2').select2();
                                Swal.close();
                            })
                            .fail(function(res) {
                                Swal.fire('Warning!', 'Oops! Not able to get Group/Trade data.', 'warning');
                            });

                    }, 100);
                }
            });

        });
    });

    // Added by Moli
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        var log = numFiles > 1 ? numFiles + ' files selected' : label;
        $(this).parents('.input-group').find(':text').val(log);
    });

    $(document).on('change', '#inst_category', function(){
        var category = $(this).val();
        // alert(category);
        if(category == 4){
            $('.private_nodal').show();
            $('.non_private_nodal').hide();
        }else{
            $('.private_nodal').hide();
            $('.non_private_nodal').show();
        }

    });
    $('.spl_category').hide();
    $(document).on('change', '#inst_spl_category', function(){
       
        var institute_category = $(this).val();
        //alert(institute_category);
        //console.log('hii');
        if(institute_category == 1){
            $('.spl_category').show();
               
        // alert(spl_category);
        $(document).on('change', '#spl_category', function(){
            var spl_category = $(this).val();
        if(spl_category == 1){
            $('.splCategoryDoc').hide();
            $('.disability_div').hide();
            $('.disadvantageGroupDiv').hide();
            
        }else if(spl_category == 2){
            $('.disability_div').show();
            $('.splCategoryDoc').show();
            $('.disadvantageGroupDiv').hide();
            
        }else if(spl_category == 3){
            $('.disability_div').hide();
            $('.splCategoryDoc').show();
            $('.disadvantageGroupDiv').show();
        }else{
            $('.splCategoryDoc').show();
            $('.disability_div').hide();
            $('.disadvantageGroupDiv').hide();
        }
    });
}else {
    $('.spl_category').hide();
             $('.disability_div').hide();
            $('.disadvantageGroupDiv').hide();
            $('.splCategoryDoc').hide();
        }

    });
</script>

