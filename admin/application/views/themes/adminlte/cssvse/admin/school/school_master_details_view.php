<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>

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
        <h1>CSS-VSE</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> CSS-VSE</li>
            <li><a href="cssvse/cssvse_school"><i class="fa fa-align-center"></i> School List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Details</li>
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
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            
                            <div class="tab-content">
                                <div class="active tab-pane" id="">
                                    
                                    <?php echo form_open_multipart("admin/cssvse/cssvse_school/schoolMasterUpdate/" . md5($SchoolMasterDetails['school_id_pk'])); ?>
                                    <div class="row">
                                        <div class="col-xs-12 table-responsive">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th width="15%">UDISE Code <span class="text-danger">*<span> :</th>
                                                    <td width="35%"><input type="number" id="udise_code" name="udise_code" min="1" class="form-control required" value="<?php echo $SchoolMasterDetails['udise_code']; ?>">
                                                    <?php echo form_error('udise_code'); ?>
                                                </td>
                                                    <th width="15%">School Name:</th>
                                                    <td width="35%"><?php echo $SchoolMasterDetails['school_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="15%">School Email <span class="text-danger">*<span> :</th>
                                                    <td width="35%"><input type="email" name="school_email" class="form-control required" value="<?php echo $SchoolMasterDetails['school_email']; ?>"></td>
                                                    <th>HOI Name:</th>
                                                    <td><?php echo $SchoolMasterDetails['hoi_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>HOI Mobile No.:</th>
                                                    <td><?php echo $SchoolMasterDetails['hoi_mobile']; ?></td>
                                                    <th>HOI email <span class="text-danger">*<span> :</th>
                                                    <td><input type="email" name="hoi_email" class="form-control required" value="<?php echo $SchoolMasterDetails['hoi_email']; ?>"></td>
                                                </tr>
                                                <tr>
                                                    
                                                    <th >Address:</th>
                                                    <td><?php echo $SchoolMasterDetails['school_address']; ?></td>

                                                    <th>District:</th>
                                                    <td><?php echo $SchoolMasterDetails['district_name']; ?></td>
                                                    
                                                </tr>
                                                <!-- <tr>
                                                    
                                                    <th >Address:</th>
                                                    <td><?php echo $SchoolMasterDetails['school_address']; ?></td>
                                                </tr> -->
                                                <tr>
                                                    
                                                    <th>State:</th>
                                                    <td><?php echo $SchoolMasterDetails['state_name']; ?></td>
                                                    <th>Municipality:</th>
                                                    <td><?php echo $SchoolMasterDetails['municipality_id_fk']; ?></td>
                                                </tr>
                                                <!-- <tr>
                                                    
                                                    <th>Pin Code:</th>
                                                    <td><?php echo $SchoolMasterDetails['panchayat']; ?></td>
                                                </tr> -->
                                                
                                                
                                                
                                            </table>
                                        </div>
                                        <div class="col-md-4 col-md-offset-4">
                                            <button type="submit" class="btn btn-flat btn-block bg-navy" id="updateSchoolMasterBtn">Update School Details</button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<script>
    $(document).on('click', '#updateSchoolMasterBtn', function (e) {
        var error = 0;

        $(this).closest('form').find('input,textarea,select').each(function () {
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

        if (error) {
            e.preventDefault();
        }
        

    });
</script>