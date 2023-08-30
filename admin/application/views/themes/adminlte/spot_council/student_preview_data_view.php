<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>

<div class="content-wrapper">
<section class="content-header">
<h1>Student data </h1>
<ol class="breadcrumb">
<li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li><i class="fa fa-align-center"></i> Student data</li>
<li><a href="affiliation/vtc"><i class="fa fa-align-center"></i> Student List</a></li>
<li class="active"><i class="fa fa-align-center"></i> Details</li>
</ol>
</section>

<section class="content">
<?php if ($this->session->flashdata('status') !== null) { ?>
<div class="alert alert-<?= $this->session->flashdata('status') ?>">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?= $this->session->flashdata('alert_msg') ?>
</div>
<?php } ?>

<div class="box box-success">
<div class="box-body">

<div class="row">
<div class="col-md-12">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs pull-right">

<!-- <li class="active"><a href="#basicDetails" data-toggle="tab">Basic Details</a></li> -->
</ul>
<div class="tab-content">
<div class="active tab-pane" id="basicDetails">
   
    <input type="hidden" name="vtc_details_id_hash" value="<?php echo md5($student_data_preview['student_details_id_pk']); ?>">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-hover">
            <tbody>
            <tr>
                            <td style="text-align:center;width:25%;margin-left:55px;"><img width="130" src="data:image/jpeg;charset=utf-8;base64,<?php echo $student_data_preview[0]['picture'] ?>" alt=""><br>
                           <p></p> <p style="text-align:center;width:25%; margin-left:58px;"><img width="130" src="data:image/jpeg;charset=utf-8;base64,<?php echo $student_data_preview[0]['sign'] ?>" alt=""> </p>
                            
                           
                            <td style="width:75%" colspan="3">

                                <b>Full Name: </b><?php echo $student_data_preview[0]['candidate_name'] ?> <?php echo $assessor[0]['fname'] ?> <?php echo $assessor[0]['mname'] ?> <?php echo $assessor[0]['lname'] ?><br>
                                <b>Gender: </b><?php echo $student_data_preview[0]['gender_description'] ?><br>
                                <b>Date of birth: </b><?php echo date("d-m-Y", strtotime($student_data_preview[0]['date_of_birth'])) ?><br>
                                <b>Mobile No: </b><?php echo $student_data_preview[0]['mobile_number'] ?><br>
                                <b>Aadhar No.: </b><?php echo $student_data_preview[0]['aadhar_no'] ?><br/>
                                 <!-- <a class="btn btn-primary btn-xs" href="council/assessor_list/download_pdf/pan/<?php echo md5($assessor[0]['assessor_registration_details_pk']); ?>">Download</a><br> -->
                                <b>Caste.</b><?php echo $student_data_preview[0]['caste_name'] ?>: </b><?php echo $student_data_preview[0]['id_no_alt'] ?><br>
                            
                            </td>
                        </tr>
            </tbody>
            <tr>
                    <th width="15%">Application Form No:</th>
                    <td width="35%"><?php echo $student_data_preview[0]['application_form_no']; ?></td>
                    
                </tr>

                <tr>
                    <th width="15%">Course :</th>
                    <td width="35%"><?php echo $student_data_preview[0]['course_name']; ?></td>
                   
                    <th width="15%">Email Id:</th>
                    <td width="35%"><?php echo $student_data_preview[0]['email']; ?></td>
                </tr>
                <tr>
                    <th>Guardian's Name:</th>
                    <td><?php echo $student_data_preview[0]['guardian_name']; ?></td>
                   <th>Kanyashree</th>
                    <td><?php echo $student_data_preview[0]['kanyashree']; ?></td>
                    </tr> 
                    <tr>
                     <th>Kanyashree Unique Id:</th>
                    <td><?php echo $student_data_preview[0]['kanyashree_unique_id']; ?></td>
               
                    <th>Nationality</th>
                    
                    <td><?php echo $student_data_preview[0]['nationality_name']; ?></td> 
                    </tr>
                 
                <tr>
                    <th>Physically Challenged:</th>
                    <td><?php echo $student_data_preview[0]['handicapped']; ?></td>
                
                    <th>Religion:</th>
                    <td><?php echo $student_data_preview[0]['religion_name']; ?></td>
                   
                </tr>
                <tr>
                    <th>Qualification for Elegibility:</th>
                    <td><?php echo $student_data_preview[0]['qualification_name']; ?></td>

                    <th>Registration no (correspondance Qualification)</th>
                    <td><?php echo $student_data_preview[0]['last_reg_no']; ?></td>

                    <tr width="100%" style="color:green;font-size:20px;" ><th><u>Education</u></th></tr>
                    <th>Full Marks:</th>
                    <td><?php echo $student_data_preview[0]['fullmarks']; ?></td>
                    <th>Marks Obtained:</th>
                    <td><?php echo $student_data_preview[0]['marks_obtain']; ?></td>
                </tr>
               
                <tr>
                     <th>Percentage:</th>
                    <td><?php echo $student_data_preview[0]['percentage']; ?></td>
                    <th>CGPA:</th>
                    <td><?php echo $student_data_preview[0]['cgpa']; ?></td>
                </tr>

                <tr>
                     <th>Percentage of Marks (3rd yr Diploma / Physics / Mathematics / English):</th>
                    <td><?php echo $student_data_preview[0]['thirdyr_or_physics_or_math_result']; ?></td>
                    <th>Percentage of Marks (2nd yr / Chemistry / Physics / Science) :</th>
                    <td><?php echo $student_data_preview[0]['secondyear_or_chemistry_or_physicalscience_or_science_result']; ?></td>
                </tr>
                <tr>
                <th>Percentage of Marks (1st yr / English(H.S) / Life Science or science / Mathematics):</th>
                    <td><?php echo $student_data_preview[0]['firstyear_or_hs_english_or_lifescience_result']; ?></td>  
                </tr>
                <tr>
                    <th>Institution Name:</th>
                    <td><?php echo $student_data_preview[0]['institute_name']; ?></td>
                    <th>Year of passing:</th>
                    <td><?php echo $student_data_preview[0]['year_of_passing']; ?></td>
                </tr>

                <tr width="100%" style="color:green;font-size:20px;" ><th><u>Contact info </u></th></tr>

                <tr>
                    <th>Address:</th>
                    <td><?php echo $student_data_preview[0]['address']; ?></td>
                    <th>State:</th>
                    <td><?php echo $student_data_preview[0]['state_name']; ?></td>
                </tr>

                <tr>
                    <th>District:</th>
                    <td><?php echo $student_data_preview[0]['district_name']; ?></td>
                    <th>Sub-division:</th>
                    <td><?php echo $student_data_preview[0]['subdiv_name']; ?></td>
                </tr>
                <tr>
                <th>Police Station:</th>
                    <td><?php echo $student_data_preview[0]['police_station_name']; ?></td>
                    <th>Pincode:</th>
                    <td><?php echo $student_data_preview[0]['pincode']; ?></td>
                   
                </tr>
                
            </table>
        </div>
      <!--  <div class="col-md-4 col-md-offset-4">
            <button type="button" class="btn btn-flat btn-block bg-navy" id="updateVtcEmailBtn">Update VTC Details</button>
        </div> -->
    </div>
    <?php // echo form_close(); ?>
</div>

</div>
</div>
</div>
</div>

</div>
</div>


</section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>