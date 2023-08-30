<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<style>
    #example
    {
        font-family: 'Calibri';
        font-size: 14px;
        text-align: center;
    }
   .dataTables_filter {
   width: 50%;
   float: right;
   text-align: right;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Online Assessment System v1.0 Portal  
      </h1>
        <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">List of Result</li>
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
        
        
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->
          <div class="box box box-warning">
             
            
            <!-- /.box-header -->
            <div class="box-body">
			<div class="col-sm-8"><h2>List Of Result</h2></div>
                <table class="table table-striped table-hover table-bordered" id="example">
                  <thead style="text-align: center;" class="bg-primary">
                    <tr>
                        <th width="5%">Sl. No</th>
                        <th width="10%">Degree</th>
                        <th width="10%">Course</th>
                        <th width="5%">Semester</th>
                        <th width="10%">Module</th>
                        <th width="10%">Subject</th>
                        <th width="10%">Level</th>
                        <th width="10%">Exam Date</th>
                        <th width="5%">Marks Secured</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                 <?php if (count($result_list) > 0){
                  $i = 1; foreach($result_list as $result) { ?>
                    <tr>
                    <td width="5%"><?php echo $i; ?></td>
                    <td width="10%"><?php echo $result['degree_name']; ?></td>
                    <td width="10%"><?php echo $result['course_name']; ?></td>
                    <td width="10%"><?php echo $result['semester_name']; ?></td>
                    <td width="10%"><?php echo $result['module_name']; ?></td>
                    <td width="10%"><?php echo $result['subject_name']; ?></td>
                    <td width="10%"><?php echo $result['level_name']; ?></td>
                    <td width="10%"><?php  echo $result['exam_taken_date']; ?></td>
                    <th width="5%"><?php  echo $result['marks_secured']; ?></th>
                    <td width="20%">
                         <?php
                                
                            
                        ?>
                        <button type="button" class="btn btn-warning btn-md btn_view_correct_response" id="<?php echo $result['degree_code'].":".$result['course_code'].":".$result['semester_code'].":".$result['subject_code'].":".
                                           $result['module_code'].":".
                                           $result['level_code'].":".
                                           $result['exam_questions'].":".$result['exam_taken_date'];?>" title="View Correct Answers" data-toggle="modal" data-target="#modal_correct_response"><i class="fa fa-eye" aria-hidden="true"></i></button>
                             |        
                            <a href="javascript:void()" class="btn btn-default btn-md" title="Download Certificate"><i class="fa fa-download" aria-hidden="true"></i></a>
                         <?php 
                            echo form_close();
                         ?>
                       
                    </td>
                </tr>
                    <?php
					  
					  $i++; } } else { ?>
                    <tr>
                    <td colspan="12" align="center"><font color="#990000" >  No Data Found !!! </font></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
              </div>
            
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
  
  <div class="modal fade" id="modal_correct_response" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content" style="width:50rem;">
    		<div class="modal-header">
    			<button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
      				<span aria-hidden="true">×</span>
      			</button>
        		<h4 class="modal-title">
                	<i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Stop
                </h4>
    		</div>

            <div class="modal-body">
                <p id="cnfrm_msg_marknonupgrd">
                    Do you want to view correct answers of this exam taken ?
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm pull-left" id="btn_no" name="btn_no" data-dismiss="modal">No</button>
                <?php
                   $attributes = array("name"=>"form_correct_response_request","id"=>"form_correct_response_request","autocomplete"=> "off",'onsubmit' => "validate_submit()"); // setting attributes of form
                   echo form_open('admin/online_exam_corner/Online_exam/correct_ans/',$attributes);
                ?>
                <input type="hidden" id="hidden_info" name="hidden_info">
                
                <button type="Submit" class="btn btn-warning btn-sm pull-right" id="btn_marknonupgrd" name="btn_view_correct_answer" style="display: block;">
                    Yes, Want to view correct answers
                </button>
                <?php
					echo form_close();
				?>
            </div>
    	</div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
  
<script>
  $(function () {

    $('#example').DataTable({

    })
  })
  

  $(".btn_view_correct_response").click(function(){
      
     var information = $(this).attr("id");
     
     console.log(information);
   
     if(information != null)
     {
       $("#hidden_info").val(information);
     }
     
  });
</script>