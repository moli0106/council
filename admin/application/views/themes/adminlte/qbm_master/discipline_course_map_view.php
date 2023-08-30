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
        <h1>Discipline Course Map</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-user"></i> Discipline Course Map</li>
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
                <h3 class="box-title">Discipline Course Map</h3>
            </div>
            <div class="box-body">

                <?php echo form_open('admin/qbm_master/discipline/discipline_course_map') ?>
                <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Course *</label>
                                <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                                    <option value="">-- Select Course --</option>
                                    <?php foreach($course_list as $course){ ?>
                                    <<option value="<?php echo $course['course_id_pk'] ?>"
                                        <?php echo set_select('course_id',$course['course_id_pk']) ?>>
                                        <?php echo $course['course_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('course_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="" for="">Discipline *</label>
                                <select class="form-control select2" style="width: 100%;" name="discipline_id">
                                    <option value="" hidden="true">Select Discipline</option>
                                    <?php 
                                        if(count($disciplineList))
                                        {
                                            foreach($disciplineList as $discipline){ ?>
                                                
                                                <option value="<?php echo $discipline['discipline_id_pk'] ?>" 
                                                    <?php echo set_select('discipline_id', $discipline['discipline_id_pk']) ?>>
                                                    <?php echo $discipline['discipline_name'] ?> (<?php echo $discipline['discipline_code'] ?>)
                                                </option>
                                            <?php } 
                                        } else { echo'<option value="" disabled="true">No Data Found...</option>'; }
                                    ?>
                                </select>
                                <?php echo form_error('discipline_id'); ?>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-2 pull-right">
                        <div class="form-group" style="text-align: center;">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-info btn-block">Map Course Discipline</button>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                <?php foreach ($course_discipline_map_list as $key => $value) { ?>
                                    <tr id="<?php echo md5($value['course_discipline_map_id_pk']); ?>">
                                        <td><?php echo ++$count; ?>.</td>
                                        <td><?php echo $value['course_name']; ?></td>
                                        <td><?php echo $value['discipline_name']; ?> [<?php echo $value['discipline_code']?>]</td>
                                        
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
<script>
    $('.select2').select2();
</script>    