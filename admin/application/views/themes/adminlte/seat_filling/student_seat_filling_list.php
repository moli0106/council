<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>


<div class="container-fluid">
 <div class="content-wrapper">
    <section class="content-header">
        <h1>Student Choice Filling</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Choice Filling</li>
        </ol>
    </section>

  <div class="row mt-4 margin-top">


    
     <br>           
    <div class="col-sm-12 shadow ov"> 
	      <table class="table table-striped bg-white mt-2 print_details">
	        <thead>
	          <tr class="bg-info"> 
	            <th>SL</th>
	            <th>Priority</th>
	            <th>Institute Name</th>
	            <th>Course</th>
	            <th>Type</th>
	          </tr>
	        </thead>
	        <tbody id="sample_table">
	          <?php
              $i=1;
	          foreach($all_data as $row){
	            ?>
	          <tr>
                    <td><span class="sn"><?php echo $i++ ?></span>.</td>
                    <td><?php echo $row['priority'] ?></td>
                    <td><?php echo $row['institute_name'] ?></td>
                    <td><?php echo $row['course_name'] ?></td>
                    <td><?php echo $row['type'] ?></td>
	            </tr>
	          <?php
	           }
	          ?>
	        </tbody>
	      </table>


    </div>

    <div class="box-footer">
               
        <button type="button" class="btn btn-primary print">Print</button>
        
    </div>
         
      </div>
    </div> 
  </div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>