<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         List of Questions
      </h1>
        <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">List of Questions</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
		<?php if(isset($success_code) and $success_code == 1){?>
        <pre class="bg-success" style="text-align: center; color:#007500;">
        <?php echo $success_message;?>
        </pre>
        <?php } ?>
        <?php if(isset($success_code) and $success_code == 0){?>
        <pre class="bg-danger" style="text-align: center; color:#D00;">
        <?php echo $success_message;?>
        </pre>
        
        <?php } ?> 
        
       <?php
          echo form_open('admin/question/manage_question',array("id"=> "question_list")) ?>
				 <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Name of Programme &nbsp;<font color="red">*</font></label>
                            </div>
                            <div class="col-sm-4">
                                <label>Course Name &nbsp;<font color="red">*</font></label>
                            </div>
                            <div class="col-sm-4">
                                <label>Semester Name &nbsp;<font color="red">*</font></label>
                            </div>
                            
                        </div>
                      <div class="row">
                        <div class="col-sm-4">
                        <select class="form-control" name="degree_name" id="degree_name">
                  <option value="">---Please Select Programme---</option>
                    <?php foreach ($degrees as $degree) { ?>
						<?php if($this->input->method(TRUE) == 'POST'){ ?>
								
                                <option value="<?php echo $degree->code;?>" <?php echo set_select('degree_name',$degree->code);?>> <?php echo $degree->degree_name; ?></option>
                               
                                <?php } elseif($this->input->method(TRUE) == 'GET'){?>
                               
                                <option value="<?php echo $degree->code;?>" <?php echo set_select('degree_name',$degree->code);?>> <?php echo $degree->degree_name; ?></option>
                            <?php } }?>
                </select>
                            <span class="error_info" id="degree_name_msg"></span>
                            <font color="red"><?php echo form_error('degree_name'); ?></font>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="course_name" id="course_name">
                  <option value="">---Please Select Course Name---</option>
                    <?php foreach($courses as $course){?>
                            <?php if($this->input->method(TRUE) == 'POST'){?>
                            
                           
                             <option value="<?php echo $course->code;?>" <?php echo set_select('course_name',$course->code);?>> <?php echo $course->course_name; ?></option>
                            
                            <?php } elseif($this->input->method(TRUE) == 'GET'){ ?>
                            
                            
                            <?php }}?>
                </select>
                            <span class="error_info" id="course_name_msg"></span>
                            <font color="red"><?php echo form_error('course_name'); ?></font>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="semester_name" id="semester_name">
                  <option value="">---Please Select Semester Name---</option>
                   <?php foreach($semesters as $semester){?>
                            <?php if($this->input->method(TRUE) == 'POST'){?>
                            
                              <option value="<?php echo $semester->code;?>" <?php echo set_select('semester_name',$semester->code);?>> <?php echo $semester->semester_name; ?></option>
                            
                            <?php } elseif($this->input->method(TRUE) == 'GET'){?>
                            
                            <?php }}?>
                </select>
                            <span class="error_info" id="semester_name_msg"></span>
                            <font color="red"><?php echo form_error('semester_name'); ?></font>
                        </div>
                        
                  </div>
                </div>
                	<div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Subject Name &nbsp;<font color="red">*</font></label>
                            </div>
                            <div class="col-sm-4">
                                <label>Module Name &nbsp;<font color="red">*</font></label>
                            </div>
                            <div class="col-sm-4">
                                <label>Level Name &nbsp;<font color="red">*</font></label>
                            </div>
                            
                        </div>
                      <div class="row">
                        <div class="col-sm-4">
                        <select class="form-control" name="subject_name" id="subject_name">
                  <option value="">---Please Select Subject Name---</option>
                   <?php foreach($subjects as $subject){?>
                            <?php if($this->input->method(TRUE) == 'POST'){?>
                            
                              <option value="<?php echo $subject->code;?>" <?php echo set_select('subject_name',$subject->code);?>> <?php echo $subject->subject_name; ?></option>
                            
                            <?php } elseif($this->input->method(TRUE) == 'GET'){?>
                            
                            <?php }}?>
                </select>
                            <span class="error_info" id="degree_name_msg"></span>
                            <font color="red"><?php echo form_error('degree_name'); ?></font>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="module_name" id="module_name">
                  <option value="">---Please Select Module Name---</option>
                    <?php foreach($modules as $module){?>
                            <?php if($this->input->method(TRUE) == 'POST'){?>
                            
                           
                             <option value="<?php echo $module->code;?>" <?php echo set_select('module_name',$module->code);?>> <?php echo $module->module_name; ?></option>
                            
                            <?php } elseif($this->input->method(TRUE) == 'GET'){ ?>
                            
                            
                            <?php }}?>
                </select>
                            <span class="error_info" id="module_name_msg"></span>
                            <font color="red"><?php echo form_error('module_name'); ?></font>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="level_name" id="level_name">
                  <option value="">---Please Select Level Name---</option>
                    <?php foreach ($levels as $level) { ?>
						<?php if($this->input->method(TRUE) == 'POST'){?>
								
                                <option value="<?php echo $level->code;?>" <?php echo set_select('level_name',$level->code);?>> <?php echo $level->level_name; ?></option>
                                
                                <?php } elseif($this->input->method(TRUE) == 'GET'){?>
                                
                            <?php } }?>
                </select>
                            <span class="error_info" id="level_name_msg"></span>
                            <font color="red"><?php echo form_error('level_name'); ?></font>
                        </div>
                        
                  </div>
                </div>
                </div>
                
				 <div class="form-group">
                	<div class="row" >
                    	<div class="col-md-12" align="center">
                        	<button type="submit" class="btn btn-success btn-flat " name="btn_form_submit" id="btn_form_submit">Submit</button>
                        </div>
                    </div>

                </div>
                
        
      <?php echo form_close(); if((isset($_POST['btn_form_submit']) and isset($questions)) or(isset($degree_name) and isset($course_name) and isset($semester_name) and isset($subject_name) and isset($module_name)  and isset($level_name) and isset($questions)) or isset($questions)){
		 // $_SESSION['degree_name'] = $degree_name;
		 // $_SESSION['course_name'] = $course_name;
		 // $_SESSION['subject_name'] = $subject_name;
		 // $_SESSION['level_name'] = $level_name;
		  
		   ?>  
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->
          <div class="box box box-warning">
             
            
            <!-- /.box-header -->
            <div class="box-body">
           		<div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>List Of Questions</h2></div>
                    <!--<div class="col-sm-4">
                        <div class="search-box">
                            <i class="material-icons">&#xE8B6;</i>
                            <input type="text" class="form-control" placeholder="Search&hellip;">
                        </div>
                    </div>-->
                </div>
            </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="example">
                <thead>
                    <tr class="bg-primary">
                        <th>Sl. No</th>
                        <th align="center"> Question </th>
                        <th align="center"> Option A </th>
                        <th align="center"> Option B </th>
                        <th align="center"> Option C </th>
                        <th align="center"> Option D </th>
                        <th align="center"> Correct Answer </th>
                        <th align="center"> Status </th>
                        <th align="center"> Action </th>
                    </tr>
                </thead>
                <tbody>
                 <?php if (count($questions) > 0){
                  $i = 0; foreach($questions as $question) { ?>
                    <tr>
                  <td><?php echo ($i+1).'.'; ?></td>
                  <td><?php echo $question['question']; ?></td>
                  <td><?php echo $question['option1']; ?></td>
                  <td><?php echo $question['option2']; ?></td>
                  <td><?php echo $question['option3']; ?></td>
                  <td><?php echo $question['option4']; ?></td>
                  <td><?php echo $question['right_answer']; ?></td>
                  
                  <td><?php if($question['view_status'] == '1'){echo "Active"; }else{ echo "Deactive";} ;?></td>

                  	<td>
                        <a href="question/Managequestion/edit_question/<?php echo $question['question_no'];?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-forward"></span> Edit</a>
                        
                      <!--  <a class='btn btn-danger btn-xs' href="#" data-toggle="modal" data-target="#rejectModal<?php echo $i;?>"><span class="glyphicon glyphicon-trash"></span> Delete</a> -->
                        
                  </td>
                   
                </tr>
               
            
                    <?php
					  
					  $i++; } } else { ?>
                    <tr>
                    <td colspan="12" align="center"><font color="#990000" >  No Data Found !!! </font></td>
                    </tr>
                    <?php } }?>
                </tbody>
            </table>
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
     
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>