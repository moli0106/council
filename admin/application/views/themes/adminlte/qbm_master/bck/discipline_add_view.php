<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Discipline</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Discipline Add</li>
        </ol>
    </section>

    <section class="content">
        <?php if(isset($status)){ ?>
            <div class="alert alert-<?php echo $status ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message ?>
            </div>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Discipline Add</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/qbm_master/discipline/add') ?>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Course *</label>
                                <select class="form-control select2" style="width: 100%;" name="course_id">
                                    <option value="">-- Select Course --</option>
                                    <?php foreach($course_list as $course){ ?>
                                    <option value="<?php echo $course['course_id_pk'] ?>"
                                        <?php echo set_select('course_id',$course['course_id_pk']) ?>>
                                        <?php echo $course['course_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('course_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Discipline Name *</label>
                                <input type="text" class="form-control" name="discipline_name" id="discipline_name"
                                    value="<?php echo set_value('discipline_name'); ?>" placeholder="Enter discipline name">
                                <?php echo form_error('discipline_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Discipline Code *</label>
                                <input type="text" class="form-control" name="discipline_code" id="discipline_code"
                                    value="<?php echo set_value('discipline_code'); ?>" placeholder="Enter discipline code">
                                <?php echo form_error('discipline_code'); ?>
                            </div>
                        </div>
                    </div>
				
                
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-info btn-block">Submit</button>
                        </div>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

<script>
    $('.select2').select2();
</script>