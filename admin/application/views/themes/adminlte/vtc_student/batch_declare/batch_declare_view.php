<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Batch Declaration</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Batch Declaration</li>

        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('status') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $this->session->flashdata('alert_msg') ?>
        </div>
        <?php } ?>

        <?php if ($vtcDetails['second_final_submit_status'] != 1) { ?>


        <div class="row">
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Batch</h3>
                    </div>



                    <div class="box-body">
                        <input type="hidden" value="<?php echo md5($vtc_id); ?>" id="vtc_id">
                        <?php echo form_open_multipart('admin/vtc_student/batch_declaration/add') ?>

                        <input id="vtcCode" name="vtcCode" class="form-control" type="hidden"
                            value="<?php echo $vtcDetails['vtc_code']; ?>">


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="current_year">Current Year <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="current_year"
                                        value="<?php echo $academic_year; ?>" readonly="true">
                                    <?php echo form_error('current_year'); ?>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="course_name_id">Select course name <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="course_name_id" id="course_name_id">
                                        <option value="" hidden="true">Select course name</option>
                                        <!--option value="1" <?php echo set_select('course_name_id', '1')?>>HS-Voc</option-->
                                        <option value="4" <?php echo set_select('course_name_id', '4')?>>VIII+ STC
                                        </option>

                                    </select>
                                    <?php echo form_error('course_name_id'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="group_id">Select Group/Trade Name <span
                                            class="text-danger">*</span></label>
                                    <?php if($this->input->method(TRUE) == "POST"){ ?>
                                    <select name="group_id" id="group_id" class="form-control">
                                        <option value="" hidden="true">Select Group/Trade</option>

                                        <?php foreach ($group as $value) {?>
                                        <option value="<?php echo $value['group_id_pk']?>"
                                            <?php echo set_select('group_id' , $value['group_id_pk']); ?>>
                                            <?php echo $value['group_name'];?> </option>
                                        <?php }?>

                                    </select>
                                    <?php }else { ?>
                                    <select name="group_id" id="group_id" class="form-control">
                                        <option value="" hidden="true">Select Group/Trade</option>
                                        <option value="" disabled="true">Select course name first...</option>
                                    </select>
                                    <?php }?>
                                    <?php echo form_error('group_id'); ?>
                                </div>
                            </div>






                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <label for="batch_start_date">Batch Start Date<span class="text-danger">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="common_input_div">
                                        <input type="text" value="<?php echo set_value("batch_start_date"); ?>"
                                            class="form-control pull-right batch_datepicker" id="batch_start_date"
                                            name="batch_start_date" placeholder="DD/MM/YYYY" autocomplete="off">
                                    </div>
                                </div>
                                <?php echo form_error('batch_start_date'); ?>
                            </div>

                            <div class="col-md-4">
                                <label for="batch_end_date">Batch End Date<span class="text-danger">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="common_input_div">
                                        <input type="text" value="<?php echo set_value("batch_end_date"); ?>"
                                            class="form-control pull-right batch_datepicker" id="batch_end_date"
                                            name="batch_end_date" placeholder="DD/MM/YYYY" autocomplete="off">
                                    </div>
                                </div>
                                <?php echo form_error('batch_end_date'); ?>
                            </div>

                            
                        </div>
                        <div class="row">

                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-center">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-success btn-block btn-sm">Submit Batch Declaration</button>
                            </div>

                        </div>

                        <?php echo form_close() ?>
                    </div>


                </div>
            </div>
        </div>








        <?php } else { ?>
        <div class="alert alert-warning alert-dismissible">
            <h4><i class="icon fa fa-warning"></i> Warning !</h4>
            Please complete and submit Affiliation Part II first.
        </div>
        <?php } ?>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>