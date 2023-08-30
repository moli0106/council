<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .highlight {
        padding: 9px 14px;
        margin-bottom: 14px;
        background-color: #f7f7f9;
        border: 1px solid #e1e1e8;
        border-radius: 4px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Group/Trade Discipline Map</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-user"></i> Group/Trade Discipline Map</li>
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
                <h3 class="box-title">Group/Trade Discipline Map</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/qbm_master/group_trade/course_disc_group_trade_map') ?>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="course_id">Select Course Name <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="course_id" id="course_id">
                                        <option value="" hidden="true">-- Select Course --</option>
                                        <?php foreach ($courseNameList as $courseName) { ?>
                                            <option value="<?php echo $courseName['course_id_pk'] ?>" <?php echo set_select('course_id', $courseName['course_id_pk']) ?>>
                                                <?php echo $courseName['course_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('course_id'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="discipline_id">Select Discipline <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="discipline_id" id="discipline_id">
                                        <option value="" hidden="true">-- Select Discipline --</option>
                                        <?php foreach ($disciplineList as $discipline) { ?>
                                            <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                            <option value="<?php echo $discipline['discipline_id_pk'] ?>" <?php echo set_select('discipline_id', $discipline['discipline_id_pk']) ?>>
                                                <?php echo $discipline['discipline_name'] ?> [<?php echo $discipline['discipline_code'] ?>]
                                            </option>
                                        <?php } } ?>
                                    </select>
                                    <?php echo form_error('discipline_id'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="course_id">Select Group/Trade <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="group_trade_id" id="group_trade_id">
                                        <option value="" hidden="true">-- Select Group/Trade --</option>
                                        <?php foreach ($groupList as $group) { ?>
                                            <option value="<?php echo $group['group_trade_id_pk'] ?>" <?php echo set_select('group_trade_id', $group['group_trade_id_pk']) ?>><?php echo $group['group_trade_name'] ?> [<?php echo $group['group_trade_code'] ?>]
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('group_trade_id'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <label>&nbsp;</label><br> <button type="submit" class="btn btn-success form-batch-btn">Map Group/Trade</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
                <div class="box-body">
                    <div class="highlight">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Course</th>
                                    <th>Discipline</th>
                                    <th>Group/Trade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                <?php foreach ($group_dis_map_list as $key => $value) { ?>
                                    <tr id="<?php echo md5($value['discipline_group_trade_map_id_pk']); ?>">
                                        <td><?php echo ++$count; ?>.</td>
                                        <td><?php echo $value['course_name']; ?></td>
                                        <td><?php echo $value['discipline_name']; ?> [<?php echo $value['discipline_code']?>]</td>
                                        <td><?php echo $value['group_trade_name']; ?> [<?php echo $value['group_trade_code']?>]</td>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>
   