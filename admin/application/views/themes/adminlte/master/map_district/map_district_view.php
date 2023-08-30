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
        <h1>Assessment Map District</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Master</li>
            <li class="active"><i class="fa fa-align-center"></i>Map District List</li>
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
                <h3 class="box-title">Add Map District</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/map_district') ?>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Select District <span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="district_id" id="district_id">
                                <option value="" hidden="true">Select District</option>
                                <?php foreach ($district_list as $key => $district) { ?>
                                    <option value="<?php echo $district['district_id_pk']; ?>" <?php echo set_select('district_id', $district['district_id_pk']) ?>>
                                        <?php echo $district['district_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('district_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Select Map District <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="district_map_id" id="district_map_id">
                                <option value="" disabled="true">Please select first district</option>
                            </select>
                            <?php echo form_error('district_map_id'); ?>
                        </div>
                    </div>
                    <!--<div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Enter District Priority <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="priority" value="<?php echo set_value('priority'); ?>">
                            <?php echo form_error('priority'); ?>
                        </div>
                    </div>-->
                    <div class="col-md-3 text-center">
                        <div class="form-group">
                            <label class="" for="">&nbsp;</label><br>
                            <button type="submit" class="btn btn-info">Submit Map District</button>
                        </div>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Map District List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>District</th>
                            <th>Map District</th>
                            <!--<th>Priority</th>-->
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($mapped_district_list)) {
                            $i = $offset;
                            foreach ($mapped_district_list as $key => $district) { ?>

                                <tr id="<?php echo md5($district['district_map_id_pk']); ?>">
                                    <td><?php echo ++$i; ?>.</td>
                                    <td><?php echo $district['district_name_main']; ?></td>
                                    <td><?php echo $district['district_name']; ?></td>
                                
                                    <!-- <td></td> -->
                                </tr>

                            <?php }
                        } else { ?>

                            <tr>
                                <td colspan="2" align="center" class="text-danger">No Data Found...</td>
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