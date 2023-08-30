<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<style type="text/css">
  .custom_alert_box
  {
      text-align: center;
      background: #fff;
      width: 80%;
      margin: 10px auto;
      padding: 30px 0
  }
  .custom_alert_box h2
  {
      font-weight: bold;
      font-size: 26px;
  }
  .ylw
  {
  	font-size:100px;
  	color:#ffe082;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Online Assessment System v1.0</h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
  </section>

  <section class="content">
  <?php //print_r($examDetails);?>
        <?php if($data['examDetails'][0]['end_date']==date('Y-m-d')) { ?>
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> Your Exam date on <?php echo date('d-m-Y',strtotime($examDetails[0]['end_date']));?>.
                    </div>
                <?php } else { ?>
  <div class="panel panel-default">
        <div class="box box-warning">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td><strong>Sector : </strong></td>
                <td name="degree" id="degree"><?php echo $examDetails[0]['sector_name'];?></td>
              </tr>
              <tr>
                <td><strong>Course : </strong></td>
                <td name="course" id="course"><?php echo $examDetails[0]['course_name']?></td>
              </tr>
              <tr>
                <td><strong>Exam Type : </strong></td>
                <td><?php echo $examDetails[0]['question_type_name']?></td>
              </tr>
              <tr>
                <td><strong>Exam Date : </strong></td>
                <td><?php echo date('d-m-Y',strtotime($examDetails[0]['end_date']));?></td>
              </tr>                       
            </tbody>
          </table>        
        </div>
        </div>
  
    <div align="right" style="font-size:15px; color:#F3060A">
								</div>
                
        <div class="callout callout-default">
          <h4>General Instructions : </h4>

				<ul>
		               <li><span></span><strong>Total no of Questions:50</strong></li>
					   <li><span></span><strong>Total duration of examination is 1 hr 30 minutes.</strong></li>
					   <li><span></span><strong>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination. </strong></li>
                       <li><span></span><strong>All questions are mandatory</strong></li>                     
                       <li><span></span><strong>Each question carry 2 mark, no negative marks.</strong></li>
                </ul> 
        </div>
        <div class="callout callout-danger">
          <h4>Notes : </h4>
				<ul>
				   <li><span></span><strong>Click the 'Submit Test' button given in the bottom of this page to Submit your answers.</strong></li>
				   <li><span></span><strong>Don't refresh the page.</strong></li>
                </ul>
        </div>
		
		<div>
		
		 <?php
          
            $attributes = array("name"=>"form1","id"=>"form1","autocomplete"=> "off",'onsubmit' => "return validate_submit()"); // setting attributes of form
            echo form_open('admin/assessor_exam_corner/online_exam/testScreen',$attributes);?>		
            
             <div class="box-tools">
            	  <input type="hidden" name="batch_id_hash" value="<?php echo md5($examDetails[0]['batch_ems_id_pk']); ?>">
                <input type="checkbox" id="myCheck"> <strong> I have read and understood the instructions.</strong>
            </div> 
            <div align="center">
            <button type="submit" class="btn btn-info">I am ready to begin</button>
            </div>
          <?php echo form_close(); ?>
		
		

		</div>
    <?php }?>
        
        <!-- /.box -->
      </section>
    </div>
  </div>
    </div>
  </section>

</div>

<script>

	function validate_submit()
	{
			if(form1.myCheck.checked == false)
			{
			alert('You must agree to the terms first.');
			return false;
			}
	}
</script>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
