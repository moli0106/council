<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation Discipline Streem Map</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation Discipline Streem Map List</li>
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
                <h3 class="box-title">Add Discipline Streem Map</h3>
                <div class="box-tools pull-right"></div>
            </div>

            <div class="box-body">
                <?php echo form_open('admin/master/affiliation_discipline_streem_map') ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="discipline_id">Select Discipline <span class="text-danger">*</span></label>
                            <select class="form-control" name="discipline_id" id="discipline_id">
                                <option value="" hidden="true">Select Discipline Name</option>
                                <?php foreach ($disciplineList as $discipline) { ?>
                                    <option value="<?php echo $discipline['discipline_id_pk'] ?>" <?php echo set_select('discipline_id', $discipline['discipline_id_pk']) ?>>
                                        <?php echo $discipline['discipline_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('discipline_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="streem_name_id">Select Streem Name <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="streem_name_id[]" id="streem_name_id" multiple="multiple">
                                <option value="" hidden="true">Select Streem Name</option>
                                <?php foreach ($streemNameList as $streemName) { ?>
                                    <option value="<?php echo $streemName['streem_name_id_pk'] ?>" <?php echo set_select('streem_name_id[]', $streemName['streem_name_id_pk']) ?> >
                                        <?php echo $streemName['streem_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('streem_name_id[]'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-center"><br>
                        <button type="submit" class="btn btn-success">Add Affiliation Discipline Streem Map</button>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Affiliation Discipline Streem Map List</h3>
                <div class="box-tools pull-right">
                    <!-- <a href="<?php echo base_url('admin/master/assessment_marks/add_assessment_marks'); ?>" class="btn btn-block btn-info">
                        <i class="fa fa-book"></i> Add Assessment Marks
                    </a> -->
                </div>
            </div>
            <div class="box-body">
                <!-- <table class="table table-hover"> -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Discipline Name</th>
                            <th>Streem Name</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($mapList)) {
                            $count = 0;
                            foreach ($mapList as $key => $val) { ?>

                                <tr id="<?php echo md5($val['discipline_streem_map_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td>
                                        <?php echo $val['discipline_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $val['streem_name']; ?>
                                       
                                    </td>
                                    
                                    <!-- <td>
                                        <a href="<?php echo base_url('admin/master/assessment_marks/nos_details/' . md5($course['course_id_fk'])) ?>" class="btn btn-sm btn-success">View NoS Details</a>
                                    </td> -->
                                    <!-- <td>
                                        <button type="button" class="btn btn-danger btn-sm deleteAffiSubjectMaster">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td> -->
                                </tr>

                            <?php }
                        } else { ?>

                            <tr>
                                <td colspan="3" align="center" class="text-danger">No Data Found...</td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer" style="text-align: center"></div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>