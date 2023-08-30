<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<html>
<head>

	<base href="<?php echo base_url(); ?>admin/" />
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
  <title><?php echo $this->title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/css/bootstrap.min.css"> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Extra CSS -->
  <!-- jQuery 3 -->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
  <?php foreach($this->css_head as $hcss){ ?>
  <link rel="stylesheet" href="<?php echo $hcss; ?>">
  <?php } ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>dist/css/skins/_all-skins.css">
  
  <style>
	.question_space
	{
		font-family: 'calibri';
		font-size: 15px;
		font-weight:bold;
		text-transform:uppercase;
				
		
	}
	
	.options
	{
		font-family: 'calibri';
		font-size: 15px;
		text-transform:none;
	}
        .exam_info
	{
		font-family: 'calibri';
		font-size: 15px;
		font-weight:bold;
		text-transform:uppercase;
		
	}
  </style>
  </head>

  <body>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Online Assesment System V1.0</h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
  </section>
  
  <section class="content">
    <div class="container-fluid">
      
        
        <?php
        if(isset($degree_code))
        {
          $degree_name = get_degree_name($degree_code);
          $course_name = get_course_name($course_code);
          $subject_name = get_subject_name($subject_code);
          $level_name = get_level_name($level_code);
        }
    ?>
      <div class="panel">
        
        <!-- basic details of exam begins here... -->
        <div class="panel-heading">
            <div class="box box-warning">
          <table class="table table-bordered exam_info">
                <tbody>
                  <tr>
                    <td>Degree :</td>
                    <td id="degree" style="padding-left: 100px; font-weight: bold;"><?php echo $degree_name;?></td>
                    <td align="left">Exam Date :</td>
                    <td align="left" style="padding-left: 100px; font-weight: bold;">
                        <?php 
                            if(isset($exam_date))
                            {
                                echo $exam_date;
                            }
                            else
                            {
                                echo date('d.m.Y');
                            }
                        ?>
                    
                    </td>
                  </tr>
                  <tr>
                    <td>Course :</td>
                    <td id="course" style="padding-left: 100px; font-weight: bold;"><?php echo $course_name;?></td>
                    <td align="left">Candidate Name :</td>
                    <td align="left" style="padding-left: 100px; font-weight: bold;"><?php echo $this->session->userdata('stake_holder_details');?></td>
                  </tr>
                  <tr>
                    <td>Subject :</td>
                    <td style="padding-left: 100px; font-weight: bold;"><?php echo $subject_name; ?></td>
                    <td align="left">Difficulty Level :</td>
                    <td align="left" style="padding-left: 100px; font-weight: bold;"  name="<?php echo $level_val;?>" id="level"><?php echo $level_name; ?></td>
                  </tr>                  
                </tbody>
              </table>
            </div>
        </div>
        
        
        <div align="center" style="font-family:calibri;">
            <a href="./online_exam_corner/Online_exam/" class="btn btn-primary"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Home</a>
        </div>
                
       <!-- basic details of exam ends here... -->
       
       
       <!-- question and options display space begins here... -->
       	
            <div class="panel-body">
            <table class="table" id="table">
            <tbody> 
            <?php 
			
            
				if(isset($correct_answers))
				{
					$counter = 1;
					
					foreach($correct_answers as $ca)
					{
			?>
                        <tr>
                        	<td class="question_space" style="border-style:none;"><b><?php echo "Question ".$counter++.' . '. $ca['question'];?></b></td>
						</tr>
                        <tr>
                            <td class=".options"><?php echo "A"." . ".$ca['option1'];?></td>
						</tr>
                        
                        <tr><td class=".options" style="border-style:none;"><?php echo "B"." . ".$ca['option2'];?></td></tr>
                        <tr><td class=".options" style="border-style:none;"><?php echo "C"." . ".$ca['option3'];?></td></tr>
                        <tr><td class=".options" style="border-style:none;"><?php echo "D"." . ".$ca['option4'];?></td></tr>
                             
                        <tr>
                            <td style="border-style: none; font-weight: bold; color:#093;">
                            <?php 
                                    echo "Correct Answer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                    if($ca['right_answer'] == 'A')
                                    {
                                            echo $ca['option1'];
                                    }
                                    else if($ca['right_answer'] == 'B')
                                    {
                                            echo $ca['option2'];
                                    }
                                    else if($ca['right_answer'] == 'C')
                                    {
                                            echo $ca['option3'];
                                    }
                                    else if($ca['right_answer'] == 'D')
                                    {
                                            echo $ca['option4'];
                                    }
                                ?>
                            </td>
                        </tr>
           <?php
					}
				}
			?>   
            </tbody>
            </table>
            </div>
        </div>        
    </div>
    </section>
    </div>
  </body>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>