<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<style>
  .instructions_list li:before {    
    font-family: 'FontAwesome';
    content: '\f0a4';
    margin:0 5px 0 -15px;
    color: #f00;
  }
</style>

<input type="hidden" id="myUrl" value="<?php echo base_url("admin/assessor_exam_corner/online_exam/testScreen/".md5($examDetails['batch_ems_id_pk']))?>">
<input type="hidden" id="myBatchId" value="<?php echo md5($examDetails['batch_ems_id_pk']) ?>">

<div class="content-wrapper">

  <section class="content-header">
    <h1>Assessment Details </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li></i>Exam Corner</li>
      <li class="active"><i class="fa fa-key"></i>Online Exam</li>
    </ol>
  </section>

  <section class="content">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Batch Details :</h3>
        <div class="box-tools pull-right"></div>
      </div>
      <div class="box-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td><strong>Exam Type : </strong></td>
              <td><?php echo $examDetails['question_type_name']?></td>
              <td><strong>Exam Mode : </strong></td>
              <td><?php echo $examDetails['assessment_mode_name']?></td>
            </tr>
            <tr>
              <td><strong>Sector : </strong></td>
              <td colspan="3"><?php echo $examDetails['sector_name']; ?></td>
            </tr>
            <tr>
            <td><strong>Course : </strong></td>
              <td colspan="3"><?php echo $examDetails['course_name']; ?></td>
            </tr>
            <tr>
              <td><strong>Exam Date : </strong></td>
              <td><?php echo date('d-m-Y',strtotime($examDetails['end_date'])).' (<i>'.date('l',strtotime($examDetails['end_date'])).'</i>)';?></td>
              <td colspan="2" align="center">
                <?php echo '<i class="text-success">All the best for exam.!!</i>'; ?>
              </td>
            </tr>                       
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">General Instructions :</h3>
        <div class="box-tools pull-right"></div>
      </div>
      <div class="box-body">
        <ul class="instructions_list">
          <li><span></span><strong>Total no of Questions:50</strong></li>
          <li><span></span><strong>Total duration of examination is 1 hr.</strong></li>
          <li><span></span><strong>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the examination will end by itself. You will not be required to end or submit your examination. </strong></li>
          <li><span></span><strong>All questions are mandatory</strong></li>                     
          <li><span></span><strong>Each question carry 2 mark, no negative marks.</strong></li>
        </ul> 
      </div>
    </div>
  </section>

  <section class="content">
    <div class="callout callout-danger">
      <h4>Notes : </h4>
      <ul>
        <li><span></span><strong>Click the 'Save & End Test' button given in the bottom of this page to Submit your answers.</strong></li>
        <li><span></span><strong>Don't press Back Button or Refresh the page.</strong></li>
		<li><span></span><strong>If you press Back Button or Refresh the page Your exam treated as abnormally exit.</strong></li>
      </ul>
    </div>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-4 col-md-offset-4 text-center end-exam" <?php if($examDetails['exam_status'] == 0) echo'style="display: none"'; ?>>
        <a href="<?php echo base_url('admin/assessor_exam_corner/online_exam'); ?>" class="btn btn-block btn-info">
          <i class="fa fa-chevron-left" aria-hidden="true"></i> Go to Back
        </a>
      </div>

      <?php if($examDetails['exam_status'] == 0) { ?>
        <div class="col-md-12 text-center start-exam">
          <input type="checkbox" id="myCheck"> <label for="myCheck"><strong> I have read and understood the instructions.</strong></label>
        </div>
        <div class="col-md-3 col-md-offset-9 start-exam">
          <button class="btn btn-block btn-success readyToBegin">I am ready to begin</button>
        </div>
      <?php } ?>
      
    </div>
  </section>

</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
