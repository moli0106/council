<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Subject</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Subject Add</li>
        </ol>
    </section>

    <section class="content">
        <?php if(isset($status)){ ?>
            <div class="alert alert-<?php echo $status ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message ?>
            </div>
        <?php } ?>

        <div class="col-md-10 col-md-offset-1">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Subject Add</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/qbm_master/subject/add') ?>
                    
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Discipline *</label>
                                <select class="form-control select2" style="width: 100%;" name="discipline_id" id="discipline_id">
                                    <option value="">-- Select Discipline --</option>
                                    <?php foreach($disciplineList as $discipline){ ?>
                                    <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                    <option value="<?php echo $discipline['discipline_id_pk'] ?>"
                                        <?php echo set_select('discipline_id',$discipline['discipline_id_pk']) ?>>
                                        <?php echo $discipline['discipline_name'] ?></option>
                                    <?php } }?>
                                </select>
                                <?php echo form_error('discipline_id'); ?>
                            </div>
                        </div>
                    </div>    
                            <?php 
                                if($this->input->post('course_id')==1 || $this->input->post('course_id')==2){
                                    $hide_show="display:block";
                                }else{
                                    $hide_show="display:none";
                                }
                            ?>
                    <div class="row">        
                        <div class="hsvoc_hide_show" style="<?php echo $hide_show;?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="">Group/Trade *</label>
                                    <select class="form-control select2" style="width: 100%;" name="group_trade_id" id="group_trade_id">
                                        <option value="">-- Select Group/Trade --</option>
                                        <?php foreach($group_tradeList as $group_trade){ ?>
                                            <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                            <option value="<?php echo $group_trade['group_trade_id_pk']; ?>" <?php echo set_select('group_trade_id', $group_trade['group_trade_id_pk']); ?>><?php echo $group_trade['group_trade_name']; ?></option>
                                        <?php } }?>
                                    </select>
                                    <?php echo form_error('group_trade_id'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="">Subject Category *</label>
                                    <select class="form-control select2" style="width: 100%;" name="sub_group_id">
                                        <option value="">-- Select Subject Category --</option>
                                        <?php foreach($sub_group_list as $sub_group){ ?>
                                        <option value="<?php echo $sub_group['subject_group_id_pk'] ?>"
                                            <?php echo set_select('sub_group_id',$sub_group['subject_group_id_pk']) ?>>
                                            <?php echo $sub_group['subject_group_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('sub_group_id'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                        <?php 
                                if($this->input->post('course_id')==3 || $this->input->post('course_id')==4){
                                    $hide_show="display:block";
                                }else{
                                    $hide_show="display:none";
                                }
                        ?>
                    <div class="row">
                        <div class="poly_hide_show" style="<?php echo $hide_show;?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="">Semester/Year *</label>
                                    <select class="form-control select2" style="width: 100%;" name="sam_year_id" id="sam_year_id">
                                        <option value="">-- Select Semester/Year --</option>
                                        <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                        <?php foreach($semesterList as $semester){ ?>
                                            <option value="<?php echo $semester['semester_id_pk']; ?>" <?php echo set_select('sam_year_id', $semester['semester_id_pk']); ?>><?php echo $semester['semester_name']; ?></option>
                                        <?php } } ?>
                                    </select>
                                    <?php echo form_error('sam_year_id'); ?>
                                </div>
                            </div>
                        </div>    

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Subject Name *</label>
                                <input type="text" class="form-control" name="subject_name" id="subject_name"
                                    value="<?php echo set_value('subject_name'); ?>" placeholder="Enter subject name">
                                <?php echo form_error('subject_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Subject Code *</label>
                                <input type="text" class="form-control" name="subject_code" id="subject_code"
                                    value="<?php echo set_value('subject_code'); ?>" placeholder="Enter subject code">
                                <?php echo form_error('subject_code'); ?>
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
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>