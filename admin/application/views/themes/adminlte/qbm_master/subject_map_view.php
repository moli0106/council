<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Map Subject</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Map Subject</li>
        </ol>
    </section>

    <section class="content">
        <?php if(isset($status)){ ?>
            <div class="alert alert-<?php echo $status ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Map Subject</h3>
                    </div>
                    <div class="box-body">
                        <?php echo form_open('admin/qbm_master/subject/map_subject') ?>
                            
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
                                            <select class="form-control select2" style="width: 100%;" name="sub_cat_id">
                                                <option value="">-- Select Subject Category --</option>
                                                <?php foreach($sub_cat_list as $sub_cat){ ?>
                                                <option value="<?php echo $sub_cat['subject_category_id_pk'] ?>"
                                                    <?php echo set_select('sub_cat_id',$sub_cat['subject_category_id_pk']) ?>>
                                                    <?php echo $sub_cat['subject_category_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php echo form_error('sub_cat_id'); ?>
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
                                        <label class="" for="">Subject *</label>
                                        <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject_id">
                                            <option value="">-- Select Subject --</option>
                                            <?php foreach($subjects as $subject){ ?>
                                            <<option value="<?php echo $subject['subject_id_pk'] ?>"
                                                <?php echo set_select('subject_id',$subject['subject_id_pk']) ?>>
                                                <?php echo $subject['subject_name'] ?> [<?php echo $subject['subject_code'] ?>]</option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('subject_id'); ?>
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
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Subject Map List</h3>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Subject [Code]</th>
                            <th>Course</th>
                            <th>Discipline [Code]</th>
                            <th>Group/Trade [Code]</th>
                            <th>Subject Category</th>
                            <th>Semester</th>
                            <!-- <th>Action</th> -->
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($subjectList))
                            {
                                $i = 0;
                                foreach ($subjectList as $key => $subject) { ?>

                                    <tr id="<?php echo md5($subject['subject_sem_group_trade_map_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $subject['subject_name']; ?> [<?php echo $subject['subject_code']; ?>]</td>
                                        <td><?php echo $subject['course_name']; ?></td>
                                        
                                        <td><?php echo $subject['discipline_name']; ?> <b>[<?php echo $subject['discipline_code']; ?>]<b></td>
                                        <td><?php if($subject['group_trade_name']!=''){?><?php echo $subject['group_trade_name']; ?> <b>[<?php echo $subject['group_trade_code']; ?>]<b><?php }else{echo 'N/A';}?></td>
                                        <td><?php if($subject['subject_category_name']!=''){?><?php echo $subject['subject_category_name']; ?><?php }else{echo 'N/A';}?></td>
                                        <td><?php if($subject['semester_name']!=''){?><?php echo $subject['semester_name']; ?><?php }else{ echo 'N/A';}?></td>
                                        
                                        
                                        <!-- <td>
                                            <a href="<?php echo base_url('admin/qbm_master/subject/add_topics/' . md5($subject['subject_sem_group_trade_map_id_pk'])); ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-folder-open" aria-hidden="true"></i>
                                        </td> -->
                                    </tr>

                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="6" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer" style="text-align: center">
                <?php //echo $page_links ?>
            </div>
        </div>



        
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>