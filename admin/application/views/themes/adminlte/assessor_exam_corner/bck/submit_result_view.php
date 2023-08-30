<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<?php 
    echo "Helllo....";
?>
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
    <h1> Online Assessment System v1.0</h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
  </section>


  <?php 
  		
		if(isset($status) and $status == 1)
		{
                    
                   // print_r($exam_question_no);
  ?>
  <section class="content">
    <div class="box box-warning">
      <div class="box-header head">
      </div>

      <div class="box-body">
        <div class="row">
          <div class="custom_alert_box">
            <h2> Online Assessment System v1.0 - Result</h2>
          </div>
        </div>
         <div>                   
                    
                    <div align="center">
                    	  <div ></div>
                          <div >
                          		
                                <div>
                                    <h4 class="align-center">Number of total questions :<?php echo $total_question; ?></h4>
                                    <h4 class="align-center"> Number of attempted questions : <?php echo $question_attempt; ?></h4>
                                    <!--<h4 class="align-center"> No of correct answer : <?php //echo $correct_answer;  ?></h4>
                                    <h4 class="align-center"> Marks Obtained : <?php //echo $marks;  ?></h4>-->
                                </div>
                                <br clear="all" />
                             
                                <?php
                                
                                    $attributes = array("name"=>"form1","id"=>"dd","autocomplete"=> "off",'onsubmit' => "validate_submit()"); // setting attributes of form
                                    echo form_open('admin/online_exam_corner/Online_exam/correct_ans/',$attributes);
                                ?>		
                                
                                <div class="box-tools">
                                    <input type="hidden" name="exam_question_no"    value="<?php echo $exam_question_no; ?>">
                                </div>
                                
                                <!-- <div align="center">
                                    <button type="submit" class="btn btn-info" name="btn_view_correct_answer" id="btn_view_correct_answer">View Correct Answers</button>
                                </div> -->
                                
                                <?php echo form_close(); ?>
                          </div>

                   </div>
                   <br clear="all" /><br clear="all" />
                  
                   
</div>

      </div>
    </div>
  </section>
  <?php 
		}
  ?>

</div>


<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

