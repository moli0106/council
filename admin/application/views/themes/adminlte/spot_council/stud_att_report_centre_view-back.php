<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<style>
    .star {
        color: red;
        font-size: 14px;
    }

    .mtop20 {
        margin-top: 20px;
    }

    .mbottom20 {
        margin-bottom: 20px;
    }

    .mright20 {
        margin-right: 20px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Centre Wise Student List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Centre Wise Student List</li>
        </ol>
    </section>
    <section class="content">
        <?php if (isset($status)) { ?>

            <div class="alert alert-<?php echo $status ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message ?>
            </div>

        <?php } ?>

        <?php if ($this->session->flashdata('status') !== null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('status') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $this->session->flashdata('alert_msg') ?>
        </div>
    <?php } ?>

        <!-- Search Domain by Birendra Singh on 25-02-2021 -->
        <div class="box">

            <!-- END of Search Domain -->
            <div class="box-header with-border">
                <h3 class="box-title">Centre Wise Student List
                    <!-- <a target="_blank" href="<?php echo base_url('admin/spot_council/student_data_list/download_admit_card_online_application_student/'); ?>" class="btn btn-info btn-sm" title="Admit Card"><i class="fa fa-download"></i></a> -->
                </h3>

                <br /><br /><br />
                <h3 class="box-title" style="color:green;"><b> Centre Wise Student List (Attandance List)</b></h3>

                <!-- <a href="<?php echo base_url('admin/spot_council/stud_att_report_centre/download_report1'); ?>" > <button type="button" class="btn btn-primary ">  Pdf1 </button></a>
                <a href="<?php echo base_url('admin/spot_council/stud_att_report_centre/download_report2'); ?>" ><button type="button" class="btn btn-info  ">  Pdf 2 </button></a>
                <a href="<?php echo base_url('admin/spot_council/stud_att_report_centre/download_report3'); ?>" ><button type="button" class="btn btn-info  ">  Pdf 2 </button></a> -->
                <?php echo form_open('admin/spot_council/stud_att_report_centre/') ?>
                <div class="row">
                    <div class="col-md-5">
                        <label for="academic_year">Centre List</label>
                        <select class="form-control select2 required" style="width: 100%;" name="centre_name" id="centre_name">
                            <option value="">-- Select Centre Name --</option>
                            <?php foreach ($centre as $list) { ?>
                                <option value="<?php echo $list['centre_id_pk'] ?>" <?php echo set_select('centre_name', $list['centre_id_pk']) ?>>
                                    <?php echo $list['centre_name'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('centre_name'); ?>
                    </div>

                    <div class="col-md-5">
                        <label for="academic_year">Course Name</label>
                        <select class="form-control select2 required" style="width: 100%;" name="etype_name" id="etype_name">
                            <option value="">-- Select Course Name --</option>
                            <?php foreach ($courses as $etlist) { ?>
                                <option value="<?php echo $etlist['exam_type_id_pk'] ?>" <?php echo set_select('etype_name', $etlist['exam_type_id_pk']) ?>>
                                    <?php echo $etlist['exam_type_name'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('etype_name'); ?>
                    </div>

                    <div class="col-md-2" style="margin-top:5px;">
                        <br />
                        <!-- stu_centre_wise_seat_allocation -->
                        <input type="submit" class="btn btn-info " value="Generate Pdf" />
                    </div>
                </div>

                <?php echo form_close() ?>
 <!-- for second pdf *********************************************************************-->
  <br /><br /><br />
                <h3 class="box-title" style="color:green;"><b> Centre Wise Student List (Descriptive Roll)</b></h3>

            
                <?php echo form_open('admin/spot_council/stud_att_report_centre/download_report2') ?>
                <div class="row">
                    <div class="col-md-5">
                        <label for="academic_year">Centre List</label>
                        <select class="form-control select2 required" style="width: 100%;" name="centre_id" id="centre_id">
                            <option value="">-- Select Centre Name --</option>
                            <?php foreach ($centre as $list) { ?>
                                <option value="<?php echo $list['centre_id_pk'] ?>" <?php echo set_select('centre_id', $list['centre_id_pk']) ?>>
                                    <?php echo $list['centre_name'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('centre_id'); ?>
                    </div>

                    <div class="col-md-5">
                        <label for="academic_year">Course Name</label>
                        <select class="form-control select2 required" style="width: 100%;" name="etype_id" id="etype_id">
                            <option value="">-- Select Course Name --</option>
                            <?php foreach ($courses as $etlist) { ?>
                                <option value="<?php echo $etlist['exam_type_id_pk'] ?>" <?php echo set_select('etype_id', $etlist['exam_type_id_pk']) ?>>
                                    <?php echo $etlist['exam_type_name'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('etype_id'); ?>
                    </div>

                    <div class="col-md-2" style="margin-top:5px;">
                        <br />
                        <!-- stu_centre_wise_seat_allocation -->
                        <input type="submit" class="btn btn-info " value="Generate Pdf" />
                    </div>
                </div>

                <?php echo form_close() ?> 

<!-- for third pdf *************************************************-->

 <br /><br /><br />
                <h3 class="box-title" style="color:green;"><b> Centre Wise Student List (For Seat Number)</b></h3>

                <?php echo form_open('admin/spot_council/stud_att_report_centre/download_report3') ?>
                <div class="row">
                    <div class="col-md-5">
                        <label for="academic_year">Centre List</label>
                        <select class="form-control select2 required" style="width: 100%;" name="centre_id_fk" id="centre_id_fk">
                            <option value="">-- Select Centre Name --</option>
                            <?php foreach ($centre as $list) { ?>
                                <option value="<?php echo $list['centre_id_pk'] ?>" <?php echo set_select('centre_id_fk', $list['centre_id_pk']) ?>>
                                    <?php echo $list['centre_name'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('centre_id_fk'); ?>
                    </div>

                    <div class="col-md-5">
                        <label for="academic_year">Course Name</label>
                        <select class="form-control select2 required" style="width: 100%;" name="etype_id_fk" id="etype_id_fk">
                            <option value="">-- Select Course Name --</option>
                            <?php foreach ($courses as $etlist) { ?>
                                <option value="<?php echo $etlist['exam_type_id_pk'] ?>" <?php echo set_select('etype_id_fk', $etlist['exam_type_id_pk']) ?>>
                                    <?php echo $etlist['exam_type_name'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('etype_id_fk'); ?>
                    </div>

                    <div class="col-md-2" style="margin-top:5px;">
                        <br />
                        <!-- stu_centre_wise_seat_allocation  -->
                        <input type="submit" class="btn btn-info " value="Generate Pdf" />
                    </div>
                </div>

                <?php echo form_close() ?> 
                
            </div>
            <br>

            <div class="box-footer">
                <?php echo $page_links ?>
            </div>
        </div>
        <!-- END of Search Domain -->
    </section>
    <!-- Modal -->

</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>