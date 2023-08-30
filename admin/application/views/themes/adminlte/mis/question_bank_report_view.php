<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Bank Report</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Question Bank Report</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Question Bank Report</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/mis/question_bank_report',array('autocomplete'=> 'off')); ?>
                <div class="row">
                <div class="col-md-4">
                    <label for="sector_id">Sector</label>
                        <select class="form-control select2" style="width: 100%;" name="sector_id" id="sector_id">
                            <option value="">-- Select Sector --</option>
                            <?php foreach($sectors as $sector){ ?>
                            <option value="<?php echo $sector['sector_id_pk'] ?>"
                                <?php echo set_select('sector_id',$sector['sector_id_pk']) ?>>
                                <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)</option>
                            <?php } ?>
                        </select>
                </div>
                <div class="col-md-4">
                    <label class="" for="">Course </label>
                    <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                        <option value="">-- Select Course --</option>
                        <?php foreach($courses as $course){ ?>
                            <?php  if($this->input->method(TRUE) == "POST"){ ?>
                        <option value="<?php echo $course['course_id_pk'] ?>"
                            <?php echo set_select('course_id',$course['course_id_pk']) ?>>
                            <?php echo $course['course_name'] ?></option>
                        <?php } } ?>
                    </select>
            
                    <?php echo form_error('course_id'); ?>
                </div>
                <div class="col-md-4">
                    <label class="" for="">Name of Programme </label>
                    <select class="form-control select2" style="width: 100%;" name="programme_id">
                        <option value="">-- Select Programme --</option>
                        <?php foreach($programmes as $programme){ ?>
                        <option value="<?php echo $programme['programme_id_pk'] ?>"
                            <?php echo set_select('programme_id',$programme['programme_id_pk']) ?>>
                            <?php echo $programme['programme_name'] ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('programme_id'); ?>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Question for </label>
                            <select class="form-control select2" style="width: 100%;" name="question_for_id" id="question_for_id">
                                <option value="">-- Select Question for --</option>
                                <?php foreach($questions_for as $question_for){ ?>
                                <option value="<?php echo $question_for['question_for_id_pk'] ?>"
                                    <?php echo set_select('question_for_id',$question_for['question_for_id_pk']) ?>>
                                    <?php echo $question_for['question_for_name'] ?></option>
                                <?php } ?>
                            </select>
                    
                            <?php echo form_error('question_for_id'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Question Type</label>
                            <select class="form-control select2" style="width: 100%;" name="question_type_id" id="question_type_id">
                                <option value="">-- Select Question Type --</option>
                                <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                <?php if($this->input->post('question_for_id')==2){?>
                                    <?php foreach($questions_type as $question_type){ ?>
                                <option value="<?php echo $question_type['question_type_id_pk'] ?>"
                                    <?php echo set_select('question_type_id',$question_type['question_type_id_pk']) ?>>
                                    <?php echo $question_type['question_type_name'] ?></option>
                                    <?php }?>
                                <?php }else{?>
                                    <?php foreach($questions_type_trainee as $questions_trainee){ ?>
                                <option value="<?php echo $questions_trainee['question_type_id_pk'] ?>"
                                    <?php echo set_select('question_type_id',$questions_trainee['question_type_id_pk']) ?>>
                                    <?php echo $questions_trainee['question_type_name'] ?></option>
                                    <?php }?>

                                <?php }?>
                                <?php }?>
                                
                            </select>
                            <?php echo form_error('question_type_id'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="inputtp">&nbsp;</label><br>
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>

                    <div class="col-md-2 pull-right">
                        <label for="inputtp">&nbsp;</label><br>
                        <a href="mis/question_bank_report/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a>
                    </div>
                </div>
                
                <?php echo form_close(); ?>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Sector</th>
                            <th>Course</th>
                            <th>Programme</th>
                            <th>Question For</th>
                            <th>Question Type</th>
                            <th>NOS/Module</th>
                            <th>Level</th>
                            <th>Name of Paper Setter</th>
                            <th>No. of Questions Entered</th>
                            <th>Name of Moderator</th>
                            <th>No. of Questions Moderated</th>
                            
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($question_bank))
                            {?>
                        <?php $i = 1; foreach($question_bank as $question){ ?>
                        <tr>
                            <td><?php echo $offset + $i; ?></td>
                            <td><?php echo strtoupper($question['sector_name']) ?></td>
                            <td><?php echo $question['course_name'] ?></td>
                            <td><?php echo $question['programme_name'] ?></td>
                            <td><?php echo $question['question_for_name'] ?></td>
                            <td><?php echo $question['question_type_name'] ?></td>
                            <td><?php echo ($question['question_for_id']==1) ? $question['nos_name'] : $question['module_name'];?></td>
                            <td><?php echo $question['level_name']; ?></td>
                            <td><?php echo $question['paper_setter_name'] ?></td>
                            <td><?php echo $question['questions_entered'] ?></td>
                            <td><?php echo ($question['paper_moderator_name']!='') ? $question['paper_moderator_name'] : 'N/A';?></td>
                            <td><?php echo $question['questions_moderated'] ?></td>
                            
                        </tr>

                        <?php $i++;  } ?>
                   <?php } else { ?>
                    <tr>
                        <td colspan="13" align="center" class="text-danger">No Data Found...</td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div id="myModalList" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-info">Sector & Job Role List</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Sector</th>
                            <th>Job Role</th>
                        </tr>
                    </thead>
                    <tbody id="sectorJobRoleList">
                        <tr>
                            <td colspan="3" align="center">Please wait a moment...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>

    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>