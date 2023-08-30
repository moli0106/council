<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }

    .datepicker {
        background-color: white;
    }
</style>

<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">Online Application</h2>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active"> Various Courses / Online Application Preview form</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<style>
    .course_sector_block,
    .work_exp_section,
    .experience_section,
    .agency_section {
        padding: 10px 0px 10px 0px;
        margin-bottom: 10px;
        border: 2px solid #CCC;
    }
</style>


<div class="container">
    <?php if ($this->session->flashdata('status') !== null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('status') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $this->session->flashdata('alert_msg') ?>
        </div>
    <?php } ?>

    <div class="row">

        <div class="col-md-12">
            <h3>Various Courses / Online Application Preview form</h3>
            <p class="text-danger">***Please Check Your Preview, If any wrong Information then Click <b>" Edit Preview Form "</b> Button </p>
            <p class="text-danger"> Otherwise click <b>"Final Submit Button"</b> for Final Submit ***</p>
        </div>

    </div>
    <hr>
    <?php //$std_id = $stdDetails['student_details_id_pk']; ?>
    <?php //echo form_open_multipart("online_application_various_courses/registration/finalSubmit/" . md5($std_id), array("id" => "online_application_reg_form")); ?>

    <h4>Basic Information</h4>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="designation">Course Applied For <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="courses" id="courses" value="<?php echo $stdDetails['exam_type_name']; ?>" readonly>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="fullname">Name <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo $stdDetails['candidate_name']; ?>" name="fullname" id="fullname" class="form-control" placeholder="Name" readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="stdEmail">Email <span class="text-danger">*</span></label>
                <!-- <small><i>Login credentials will be send to VTC email.</i></small> -->
                <input id="stdEmail" name="stdEmail" class="form-control" type="email" value="<?php echo $stdDetails['email']; ?>" readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="stdMobileNo">Mobile No. <span class="text-danger">*</span></label>
                <!-- <small><i>OTP will be send to Mobile No.</i></small> -->
                <input type="number" id="stdMobileNo" name="stdMobileNo" class="form-control" value="<?php echo $stdDetails['mobile_number']; ?>" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="designation">Guardian's Name<span class="text-danger">*</span></label>
                <input type="text" value="<?php echo $stdDetails["guardian_name"]; ?>" name=" guardian_name" id="guardian_name" class="form-control" placeholder="Guardian's name" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="gender">Gender <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $stdDetails["gender_description"]; ?>" readonly>


            </div>
        </div>

    </div>
    <div class="row">
        <?PHP if ($stdDetails['kanyashree'] == 'yes') { ?>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="kanyashree">Kanyashree<span class="text-danger">*</span></label>
                    <br />
                    <?php
                    // echo "<pre>";
                    // print_r($stdDetails['kanyashree']);
                    ?>
                    <input type="text" class="form-control" name="kanyashree" id="kanyashree_no" value=<?php echo $stdDetails["kanyashree"]; ?> readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="kanyashree">Unique ID<span class="text-danger">*</span></label><br />
                     
                     <label> <input type="text" class="form-control" name="kanyashree_unique_id" id="kanyashree_no" value="<?php echo $stdDetails["kanyashree_unique_id"]; ?>" readonly>

                </div>
            </div>
        <?PHP } ?>




        <div class="col-md-3">
            <div class="form-group">
                <label for="designation">Nationality <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nationality" id="nationality" value="<?php echo $stdDetails["nationality_name"]; ?>" readonly>

            </div>
        </div>




        <!-- added by avijit 08-02-2023-->
        <div class="col-md-3">
            <div class="form-group">
                <label for="designation">Udise Code <span class="text-danger"></span></label>
                <input type="number" value="<?php echo $stdDetails["udise_code"]; ?>" name="udise_code" readonly id="udise_code" class="form-control" placeholder="Udise Code." style="text-transform: uppercase;">
            </div>
        </div>
        <!--- end----->

    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="category">Category <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="category" id="category" value="<?php echo $stdDetails["caste_name"]; ?>" readonly>

                </select>
                <?php echo form_error('category'); ?>
            </div>
        </div>

        <!-- Added by Moli -->
        <div class="col-md-4 caste_doc_div" <?php if (($stdDetails['caste_id_fk'] == 1) || ($stdDetails['caste_id_fk'] == NULL)) echo 'style="display: none;"'; ?>>
                            
            <div class="form-group">
                <label class="" for="caste_doc">
                Upload Caste Document 
                    <span class="text-danger">*</span>
                    <!-- <br> -->
                    <small>(.PDF only, Max 100KB)</small>
                </label>

                <?php if($stdDetails['caste_doc'] !='') {?>

                    <small><a target="_blank"href="online_application_various_courses/registration/download_caste_doc/<?php echo md5($stdDetails['student_details_id_fk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-download" style="font-size:18px"> </i></a></small>
                <?php } ?>

                
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="designation">Physically Challenged<span class="text-danger">*</span></label>
                <br />
                <input type="text" class="form-control" name="handicapped" readonly value="<?php echo $stdDetails["handicapped"]; ?>">

            </div>
        </div>

        <!-- added by moli -->

        <div class="col-md-4 phy_challenged_doc_div" <?php if (($stdDetails['handicapped'] == 'no') || ($stdDetails['handicapped'] == NULL)) echo 'style="display: none;"'; ?>>
                            
            <div class="form-group">
                <label class="" for="phy_challenged_doc">
                Upload P.C Certificate 
                    <span class="text-danger">*</span>
                    <!-- <br> -->
                    <small>(.PDF only, Max 200KB)</small>
                </label>
                <?php if($stdDetails['phy_challenged_doc'] !='') {?>

                    <small><a target="_blank"href="online_application_various_courses/registration/download_handicap_doc/<?php echo md5($stdDetails['student_details_id_fk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-download" style="font-size:18px"> </i></a></small>
                <?php } ?>

                
               
            </div>
        </div>

        <div class="col-md-3">
            <label for="datepicker">D.O.B <span class="text-danger">*</span></label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="common_input_div">
                    <input type="text" value="<?php echo  date('d-m-Y', strtotime($stdDetails['date_of_birth'])); ?>" class="form-control pull-right datepicker" id="dob" readonly name="dob">
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="designation">Religion <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="religion" id="religion" value="<?php echo $stdDetails["religion_name"]; ?>" readonly>

            </div>
        </div>

    </div>





    <!-- for extra 4 fields for jexpo and voclet course by Sudesna -->
    <?php if ($stdDetails['exam_type_id_fk'] == 1 || $stdDetails['exam_type_id_fk'] == 2 || $stdDetails['exam_type_id_fk'] == 4 || $stdDetails['exam_type_id_fk'] == 7 || $stdDetails['course_id_fk'] == 6 || $stdDetails['course_id_fk'] == 5) { ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="designation">Land Loser<span class="text-danger">*</span></label>
                    <br />
                    <label><input type="text" class="form-control" name="land_loser" readonly value=<?php echo $stdDetails["land_loser"]; ?>>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="designation">EWS<span class="text-danger">*</span></label>
                    <br />

                    <input type="text" class="form-control" name="ews" readonly value=<?php echo $stdDetails["ews"]; ?>>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="designation">Are You Wards of Ex-Serviceman <span class="text-danger">*</span></label>
                    <br />
                    <label><input type="text" class="form-control" name="exserviceman" readonly value=<?php echo $stdDetails["wards_of_exserviceman"]; ?>>

                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label for="designation">TFW<span class="text-danger">*</span></label>
                    <br />
                    <label><input type="text" class="form-control" name="tfw" readonly value=<?php echo $stdDetails["applied_under_tfw"]; ?>>
                </div>
            </div>


        </div>
    <?php } ?>
    <!-- end of course -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="designation">Aadhar No <span class="text-danger">*</span></label>
                <input type="number" value="<?php echo $stdDetails['aadhar_no']; ?>" name="aadhar_no" id="aadhar_no" readonly class="form-control" placeholder="Aadhar No." style="text-transform: uppercase;">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="designation">Qualification for Elegibility <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="last_qualification" id="last_qualification" value="<?php echo $stdDetails['qualification_name']; ?>" readonly>

            </div>
        </div>



    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="last_reg_no">Registration No (correspondence Qualification)<span class="text-danger">*</span></label>
                <input type="number" value="<?php echo $stdDetails["last_reg_no"]; ?>" readonly name="last_reg_no" id="last_reg_no" class="form-control" placeholder="Reg No.">
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="form-group ">
                <label>Uploaded Photo <span class="text-danger">*</span> (JPEG format between 100KB. Dimensions 250x320 pixels preferred)</label>
                <input type="file" readonly class="form-control" placeholder="Photo" name="photo" id="photo" value=""  disabled>
                <?php echo form_error('photo'); ?>
            </div>
        </div>


        <?php if ($stdDetails["picture"] != '') { ?>
            <div class="col-md-2">
                <div class="form-group">
                    <div class="photo-box">
                        <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($stdDetails['picture']); ?>">
                    </div>
                </div>
            </div>
        <?php } ?>


        <div class="col-md-4">
            <div class="form-group ">
                <label>Uploaded Signature <span class="text-danger">*</span> (JPEG format between 100KB. Dimensions 250x320 pixels preferred)</label>
                <input type="file" class="form-control" placeholder="Photo" name="sign" id="sign" value=""  disabled>
                <?php echo form_error('sign'); ?>
            </div>
        </div>

        <?php if ($stdDetails["sign"] != '') { ?>
            <div class="col-md-2">
                <div class="form-group">
                    <div class="photo-box">
                        <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($stdDetails['sign']); ?>">
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <br>
    <h4>Educational Information</h4>
    <hr>

    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="fullmark">Name of the Institute <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo $stdDetails["institute_name"]; ?>" name="institute_name" readonly id="institute_name" class="form-control" placeholder="Institute Name">

                <?php echo form_error('institute_name'); ?>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="fullmark">Year of Passing <span class="text-danger">*</span></label>
                <input type="number" value="<?php echo $stdDetails['year_of_passing']; ?>" name="passing_year" id="passing_year" class="form-control" placeholder="Passing Year" readonly>

                <?php echo form_error('passing_year'); ?>
            </div>
        </div>
    </div>
    <?php if ($stdDetails['exam_type_id_fk'] == 1 || $stdDetails['exam_type_id_fk'] == 4 || $stdDetails['exam_type_id_fk'] == 5 || $stdDetails['exam_type_id_fk'] == 7) { ?>
        <!-- start code for the fields of jexpo course  -->
        <br>
        <h4>Marks in Madhyamik Examination</h4>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fullmark">Full Marks </label>
                    <input type="number" value="<?php echo $stdDetails["fullmarks"] ?>" name="fullmark" id="fullmark" class="form-control" placeholder="fullmarks" readonly>

                    <?php echo form_error('fullmark'); ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="mark_obtain">Marks Obtained </label>
                    <input type="number" value="<?php echo  $stdDetails["marks_obtain"]; ?>" name="marks_obtain" id="marks_obtain" class="form-control" placeholder="Marks Obtain" readonly>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="percentage">Percentage % </label>
                    <input type="number" name="percentage" id="percentage" value="<?php echo  $stdDetails['percentage']; ?>" class="form-control" placeholder="Percentage" readonly>
                </div>
            </div>


            <!-- <div class="col-md-3">
            <div class="form-group">
                <label for="cgpa">C.G.P.A <span class="text-danger">*</span></label>
                <input type="number" value="<?php // echo set_value("c_g_p_a") 
                                            ?>" name="c_g_p_a" id="c_g_p_a" class="form-control" placeholder="C G P A" step=".01">

                <?php // echo form_error('c_g_p_a'); 
                ?>
            </div>
        </div> -->

        </div>

    <?php } else if ($stdDetails['course_id_fk'] == 2 || $stdDetails['course_id_fk'] == 6) { ?>
        <br>
        <h4>Marks in Higher Secondary</h4>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fullmark">Full Marks </label>
                    <input type="number" value="<?php echo  $stdDetails["fullmark"]; ?>" name="fullmark" id="fullmark" class="form-control" placeholder="fullmarks" readonly>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="mark_obtain">Marks Obtained </label>
                    <input type="number" value="<?php echo  $stdDetails["marks_obtain"]; ?>" name="marks_obtain" id="marks_obtain" class="form-control" placeholder="Marks Obtain" readonly>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="percentage">Percentage % </label>
                    <input type="number" name="percentage" id="percentage" value="<?php echo  $stdDetails['percentage']; ?>" class="form-control" placeholder="Percentage" readonly>
                </div>
            </div>
        </div>
    <?php } else if ($stdDetails['course_id_fk'] == 3 || $stdDetails['course_id_fk'] == 8 || $stdDetails['course_id_fk'] == 9) { ?>
        <!-- start code for the fields of Pharmacy course  -->
        <br>
        <h4>Marks in Higher Secondary</h4>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fullmark">Full Marks <span class="text-danger">*</span></label>
                    <input type="number" value="<?php echo  $stdDetails("fullmark") ?>" name="fullmark" id="fullmark" class="form-control" placeholder="fullmarks" readonly>

                    <?php echo form_error('fullmark'); ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="mark_obtain">Marks Obtained <span class="text-danger">*</span></label>
                    <input type="number" value="<?php echo  $stdDetails("marks_obtain") ?>" name="marks_obtain" id="marks_obtain" class="form-control" placeholder="Marks Obtain" readonly>

                    <?php echo form_error('marks_obtain'); ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="percentage">Percentage % <span class="text-danger">*</span></label>
                    <input type="number" name="percentage" id="percentage" value="<?php echo  $stdDetails('percentage') ?>" class="form-control" placeholder="Percentage" readonly>

                    <?php echo form_error('percentage'); ?>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group">
                    <label for="cgpa">C.G.P.A <span class="text-danger">*</span></label>
                    <input type="number" value="<?php echo  $stdDetails("c_g_p_a") ?>" name="c_g_p_a" readonly id="c_g_p_a" class="form-control" placeholder="C G P A" step=".01">

                    <?php echo form_error('c_g_p_a'); ?>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fullmark">Percentage of Marks(3rd yr (Diploma)/ Physics(H.S)/ Mathematics/ English) <span class="text-danger">*</span></label>
                    <input type="number" value="<?php echo  $stdDetails("p_o_m1") ?>" name="p_o_m1" id="p_o_m1" class="form-control" placeholder="Percentage of marks (3rd yr Diploma / Physics / Mathematics / English)" step=".01">

                    <?php echo form_error('p_o_m1'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="fullmark">Percentage of Marks (2nd yr (Diploma) / Chemistry(H.S)/ Physics or Science) <span class="text-danger">*</span></label>
                    <input type="number" value="<?php echo  $stdDetails("p_o_m2") ?>" name="p_o_m2" id="p_o_m2" class="form-control" placeholder="Percentage of marks (2nd yr / Chemistry / Physics / Science)" step=".01">

                    <?php echo form_error('p_o_m2'); ?>
                </div>
            </div>


            <div class="col-md-8">
                <div class="form-group">
                    <label for="percentage"> Percentage of Marks (1st yr (Diploma) / English(H.S) / Life Science or Biology / Mathematics) <span class="text-danger">*</span></label>
                    <input type="number" name="p_o_m3" id="p_o_m3" value="<?php echo  $stdDetails('p_o_m3') ?>" class="form-control" placeholder="Percentage of Marks (1st yr / English(H.S) / Life Science or Science / Mathematics)" step=".01">

                    <?php echo form_error('p_o_m3'); ?>
                </div>
            </div>

        </div>

        <!-- end code for the fields of jexpo, Pharmacy,PDPC,PDME course  -->
    <?php } ?>
   

    <br>
    <h4>Contact Information</h4>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="address">Address <span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" readonly rows="3"><?php echo  $stdDetails['address']; ?></textarea>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="state">State <span class="text-danger">*</span></label>
                <input type="text" name="state" id="state" value="<?php echo  $stdDetails['state_name']; ?>" class="form-control"  readonly>
                    
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="district">District <span class="text-danger">*</span></label>
                <input type="text" name="district" id="district" class="form-control" value=" <?php echo $stdDetails['district_name']; ?>" readonly>
                  
            </div>
        </div>
      
        
        <div class="col-md-3 other_state_div" <?php if (($stdDetails['state_id_fk'] != 19)) echo 'style="display: none;"'; ?>>
            <div class="form-group">
                <?php // echo "<pre>"; print_r($stdDetails['sub_div_id_fk']);
                ?>
                <label for="subDivision">Select Sub Division <span class="text-danger">*</span></label>
                <input type="text" name="subDivision" id="subDivision" class="form-control" value=" <?php echo $stdDetails['subdiv_name']; ?>" readonly>
                 
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="state">Police Station
                    <!-- <span class="text-danger">*</span> -->
                </label>
                <input type="text" name="police_station" id="police_station" class="form-control" value=" <?php echo $stdDetails['police_station_name']; ?>" readonly>
                  
            </div>
        </div>


    </div>
    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label for="pincode">Pincode <span class="text-danger">*</span></label>
                <input type="number" value="<?php echo $stdDetails['pincode']; ?>" name="pincode" readonly id="pincode" class="form-control" placeholder="PINCODE">

            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-end">
        <div class="btn-group " role="group" aria-label="Basic example" >
            <button type="button" class="btn btn-secondary" style="background-color: transparent;border: none;"><a href="<?php echo base_url('online_application_various_courses/registration/std_info/' . md5($stdDetails['student_details_id_fk']) . '?link=1'); ?>" class="btn btn-sm btn-warning myInlineClass">Edit Preview Form</a></button>
            <button type="button" class="btn btn-secondary" style="background-color: transparent;border: none;"><a href="<?php echo base_url('online_application_various_courses/registration/finalSubmit/' . md5($stdDetails['student_details_id_fk'])); ?>" class="btn btn-sm btn-success myInlineClass final_submit_btn" > Final Submit</a></button>
        </div>
    </div>
  

 
    <?php echo form_close(); ?>
</div>
<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>


<style>
    .myInlineClass{
        font-size: 18px;
    padding: 9px 29px 6px;
    font-family: monospace;
    font-weight: 800;
    }
</style>

<script>
    $(document).on('click', '.final_submit_btn', function() {
        var check = confirm("Are you sure you want to final save?You won't be able to revert this!");
        if (check == true) {
            return true;
        }
        else {
            return false;
        }
    });
   
</script>