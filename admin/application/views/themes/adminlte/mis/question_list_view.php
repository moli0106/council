<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<style>
.mbotm20 {margin-bottom:20px;}
.imgcard {width:450px; height: 300px; overflow: hidden;}
.imgcard img {width: 100%; height: 100%;}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Questions List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Questions List</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Questions List</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/mis/question_list',array('autocomplete'=> 'off')); ?>
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

                    <!--<div class="col-md-2 pull-right">
                        <label for="inputtp">&nbsp;</label><br>
                        <a href="mis/question_bank_report/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a>
                    </div>-->
                </div>
                
                <?php echo form_close(); ?>
            </div> 
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            
                            <th> Question Category</th>
                            <th> Question Details</th>
                            <!-- <th> Status </th> -->
                            <?php //if($this->session->stake_id_fk==7){?>
                            <th style="width: 7%;"> Action </th>
                            <?php //}?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($questions as $question){ ?>
                        <tr id="<?php echo md5($question['question_id_pk']); ?>">
                            <td><?php echo $offset + $i; ?></td>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item"><b>Sector :</b> <?php echo $question['sector_name']; ?></li>
                                    <li class="list-group-item"><b>Course :</b> <?php echo $question['course_name']; ?></li>
                                    <li class="list-group-item"><b>Name of Programme :</b> <?php echo $question['programme_name']; ?></li>
                                    <li class="list-group-item"><b>Question for :</b> <?php echo $question['question_for_name']; ?>&nbsp;&nbsp;<b>Question Type :</b> <?php echo $question['question_type_name']; ?></li>
                                    
                                    <?php if($question['question_for_id']==1){?>
                                        <li class="list-group-item"><b>NoS Name :</b> <?php echo $question['nos_name']; ?>&nbsp;&nbsp;<b>Level :</b> <?php echo $question['level_name']; ?></li>
                                    <?php }else{?>
                                        <li class="list-group-item"><b>Module Name :</b> <?php echo $question['module_name']; ?>&nbsp;&nbsp;<b>Level :</b> <?php echo $question['level_name']; ?></li>
                                    <?php }?>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item"><p class="mbotm20"><b>Question :</b> <?php echo $question['question']; ?> </p>
                                    <li class="list-group-item"><a href="<?php echo md5($question['question_id_pk']); ?>" class="btn btn-info btn-xs btn-block question_view" data-toggle="modal" data-target="#myModal" style="width: 40%;"><i class="fa fa-eye"></i> View Question</a>
                                    </li>
                                    
                                    <li class="list-group-item"><b>Status :</b> 
                                        <?php
                                            if($question['process_status_id_fk'] == 0)
                                                echo'<small class="label label-warning">Pending</small>';
                                            elseif($question['process_status_id_fk'] == 5)
                                                echo'<small class="label label-success">Approved</small>';
                                            else
                                                echo'<small class="label label-danger">Rejected</small>';
                                        ?>
                                    </li>
                                </ul>
                            </td>

                            
                            
                            <td>
                                <?php
                                    if($this->session->stake_id_fk==7){
                                    if($question['process_status_id_fk'] == 0) {?>
                                        <button class="btn btn-sm btn-success changeStatus" data-name="approveReject">
                                            <i class="fa fa-check-circle " aria-hidden="true"></i>
                                        </button>

                                        <a href="question/manage_question/edit/<?php echo md5($question['question_id_pk'])?>"><button class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o " aria-hidden="true"></i></button></a>

                                        <?php if($question['bengali_lan_quesstion_status'] == 1){?>
                                            <a href="question/manage_question/add_bengali_question/<?php echo md5($question['question_id_pk'])?>"><button class="btn btn-sm btn-info"><i class="fa fa-eye " aria-hidden="true"> Bangali</button></i></a>
                                        <?php }?>
                                   <?php } 
                                }   
                                ?>
                                <?php if($this->session->stake_id_fk==6){?>
                                <a href="question/manage_question/add_bengali_question/<?php echo md5($question['question_id_pk'])?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus " aria-hidden="true"> Bangali</button></i></a>
                                <?php }?>
                                
                            </td>
                        </tr>
                        <?php $i++;  } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
    
</div>



<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">
	
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title modal_title">Modal Header</h4>
	      </div>
	      <div class="modal-body" id="modal_view">
	       
	      </div>
	      <div class="modal-footer">
          	<!-- <button type="button" class="btn btn-primary print_details_tp">Print</button> -->
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	
	  </div>
	</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>