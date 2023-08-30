<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Uploaded HS Question</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Uploaded HS List</li>
        </ol>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('status') !== null){ ?>
            <div class="alert alert-<?=$this->session->flashdata('status')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('alert_msg')?>
            </div>
        <?php } ?>
            
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Uploaded HS List</h3>
                <div class="box-tools pull-right">
                <?php if($this->session->userdata('stake_id_fk')==18){?>
                    <a href="<?php echo base_url('admin/question_set_master/upload_hs_question/add') ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Upload HS Question
                    </a>
                <?php }?>    
					
                </div>
            </div>

            <!-- <div class="box-body">
            <?php echo form_open("admin/council/job_role_app",array('id'=>"search")); ?>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Subject *</label>
                            <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject_id">
                                <option value="">-- Select Subject --</option>
                                <?php foreach($subjectList as $subject){ ?>
                                <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                <option value="<?php echo $subject['subject_id_pk'] ?>"
                                    <?php echo set_select('subject_id',$subject['subject_id_pk']) ?>>
                                    <?php echo $subject['subject_name'] ?> [<?php echo $subject['subject_code'] ?>]</option>
                                <?php } }?>
                            </select>
                            <?php echo form_error('subject_id'); ?>
                        </div>
                    </div>
					
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pan_no">Submission Date</label>
                            <input type="text" name="submit_date" id="submit_date" value="<?php echo set_value('submit_date')?>" class="form-control" placeholder="dd-mm-yyyy" readonly>
                            <?php echo form_error('submit_date'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <span for="">&nbsp;</span><br>
                        <button type="submit" class="btn btn-primary">Search</button>
                        
                    </div>
                    <div class="col-md-3"></div>
                </div>
            <?php echo form_close(); ?>
            </div> -->
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Academic Year</th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Question</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($questionList))
                            {
                                $i = $offset;
                                foreach ($questionList as $key => $question) { ?>

                                    <tr id="<?php echo md5($question['hs_question_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $question['academic_year'];?></td>
                                        <td><?php echo $question['course_name'];?></td>
                                        <td><?php echo $question['subject_name'].' ['.$question['subject_code'].']'; ?></td>
                                        <td>
                                        <?php if($this->session->userdata('stake_id_fk')==15){?>
                                            <a href="<?php echo base_url('admin/question_set_master/upload_hs_question/download_uploaded_pdf/' . md5($question['hs_question_id_pk'])); ?>" class="btn btn-sm btn-info"><i class="fa fa-download" aria-hidden="true"></i> PDF File</a>
                                        <?php }?>
                                            <?php if($this->session->userdata('stake_id_fk')==18){?>
                                                <a href="<?php echo base_url('admin/question_set_master/upload_hs_question/send_question_paper/' . md5($question['hs_question_id_pk'])); ?>" class="btn btn-sm btn-success"><i class="fa fa-send-o" aria-hidden="true"></i> Send Question</a>
                                            <?php }?>

                                        </td>
                                        
                                    </tr>

                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="9" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer" style="text-align: center">
                <?php echo $page_links ?>
            </div>
        </div>
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>