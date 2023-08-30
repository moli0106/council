<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.card {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
}

.question-box {
    background-color: #fff;
    border: 4px solid #43A047;
    border-radius: 10px;
    border-top: none;
    border-bottom: none;
    padding: 5px 10px;
    margin-top: 15px;
    margin-bottom: 15px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
}

.question-box:hover {
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Data List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Details View</li>
        </ol>
    </section>

    <section class="content">
        <?php if (isset($status)) { ?>

        <div class="alert alert-<?php echo $status ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message ?>
        </div>

        <?php } ?>

        <!-- Search Domain by Birendra Singh on 25-02-2021 -->
        <div class="box">

            <!-- END of Search Domain -->
            <div class="box-header with-border">
                <h3 class="box-title">Student Details</h3>



                <div class="box-tools pull-right">


                </div>
            </div>
            <br>
            <div class="box-body">

                <div class="row">




                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcName">Institute Name <span class="text-danger">*</span></label>
                            <input id="vtcName" name="vtcName" class="form-control" type="text" value="">
                            <!-- <input type='text' id='selectuser_ids' value=""/> -->
                            <?php echo form_error('vtcName'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcCode">Institute Code <span class="text-danger">*</span></label>
                            <input id="instituteCode" name="vtcCode" class="form-control" type="text" value="" readonly>
                            <?php echo form_error('vtcCode'); ?>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="admissionYear">Year of Admission <span class="text-danger">*</span></label>
                            <input id="admissionYear" name="admissionYear" class="form-control" type="text"
                                value="<?php //echo $academic_year; ?>" readonly>
                            <?php echo form_error('admissionYear'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="poly_course_id">Select course name <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="poly_course_id" id="poly_course_id">
                                <option value="" hidden="true">Select course name</option>
                                <!-- <option value="1" <?php echo set_select('course_name_id', '1')?>>HS-Voc</option>
                    <option value="4" <?php echo set_select('course_name_id', '4')?>>VIII+ STC</option> -->

                            </select>
                            <?php echo form_error('poly_course_id'); ?>
                        </div>
                    </div>


                </div>

                <div class="question-box">
                    <div class="row question-box-row">
                        <div class="col-md-12">
                            <div class=" border-dark mb-3">
                                <div class="card-header">
                                    <h4>Basic Details</h4>
                                </div>
                                <div class="card-body text-dark">
                                    <div class="row">


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="designation">First name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" value="<?php echo set_value("fname"); ?>"
                                                    name="fname" id="fname" class="form-control"
                                                    placeholder="First name">
                                                <?php echo form_error('fname'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="designation">Middle name</label>
                                                <input type="text" value="<?php echo set_value("mname"); ?>"
                                                    name="mname" id="mname" class="form-control"
                                                    placeholder="Middle name">
                                                <?php echo form_error('mname'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="designation">Last name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" value="<?php echo set_value("lname"); ?>"
                                                    name="lname" id="lname" class="form-control"
                                                    placeholder="Last name">
                                                <?php echo form_error('lname'); ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="father_name">Father name</label>
                                                <input type="text" value="<?php echo set_value("father_name"); ?>"
                                                    name="father_name" id="father_name" class="form-control"
                                                    placeholder="Father name">
                                                <?php echo form_error('father_name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="mother_name">Mother name</label>
                                                <input type="text" value="<?php echo set_value("mother_name"); ?>"
                                                    name="mother_name" id="mother_name" class="form-control"
                                                    placeholder="Mother name">
                                                <?php echo form_error('mother_name'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="guardian_name">Guardian name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" value="<?php echo set_value("guardian_name"); ?>"
                                                    name="guardian_name" id="guardian_name" class="form-control"
                                                    placeholder="Guardian name">
                                                <?php echo form_error('guardian_name'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="guardian_relation">Relationship with Guardian <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" value="<?php echo set_value("guardian_relation"); ?>"
                                                    name="guardian_relation" id="guardian_relation" class="form-control"
                                                    placeholder="Guardian name">
                                                <!-- <select class="form-control" name="guardian_relation" id="guardian_relation">
                                                    <option value="" hidden="true">-- Relationship with Guardian --</option>
                                                    <?php foreach($relationshipList as $val){ ?>
                                                    <option value="<?php echo $val['guardian_relationship_id_pk'] ?>" <?php echo set_select("guardian_relation",$val['guardian_relationship_id_pk']) ?>><?php echo $val['relationship_name'] ?></option>
                                                    <?php } ?>
                                                </select> -->
                                                <?php echo form_error('guardian_relation'); ?>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-4 other_relation_div" <?php if ((set_value('guardian_relation') != 3) || (set_value('guardian_relation') == NULL)) echo 'style="display: none;"'; ?>>
                                            <div class="form-group">
                                                <label for="otherRelationName">Other Relationship Name <span class="text-danger">*</span></label>
                                                <input id="otherRelationName" name="otherRelationName" class="form-control" type="text" value="<?php echo set_value('otherRelationName'); ?>">
                                                <?php echo form_error('otherRelationName'); ?>
                                            </div>
                                        </div> -->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="citizenship">Citizenship<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="citizenship" id="citizenship">
                                                    <option value="" hidden="true">-- Select Citizenship --</option>
                                                    <?php foreach ($nationality as $key => $value) {?>

                                                    <option value="<?=$value['nationality_id_pk'];?>"
                                                        <?php echo set_select("citizenship",$value['nationality_id_pk']) ?>>
                                                        <?=$value['nationality_name']?></option>
                                                    <?php }?>

                                                </select>
                                                <?php echo form_error('citizenship'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4 citizenship_doc_div"
                                            <?php if ((set_value('citizenship') == 1) || (set_value('citizenship') == NULL)) echo 'style="display: none;"'; ?>>

                                            <div class="form-group">
                                                <label class="" for="approval_doc">
                                                    Upload Council Approval
                                                    <span class="text-danger">*</span>
                                                    <!-- <br> -->
                                                    <small>(.PDF only, Max 200KB)</small>
                                                </label>

                                                <div class="input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-success">
                                                            Browse&hellip;<input type="file" style="display: none;"
                                                                name="approval_doc" id="approval_doc">
                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <?php echo form_error('approval_doc'); ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="aadhar_no">Aadhar No.<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" value="<?php echo set_value("aadhar_no"); ?>"
                                                    name="aadhar_no" id="aadhar_no" class="form-control"
                                                    placeholder="Aadhar No.">
                                                <?php echo form_error('aadhar_no'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="mob_no">Mobile No.<span class="text-danger">*</span></label>
                                                <input type="text" value="<?php echo set_value("mob_no"); ?>"
                                                    name="mob_no" id="mob_no" class="form-control"
                                                    placeholder="Mobile No." pattern="^[6-9]\d{9}$"
                                                    title="Ten Digit Mobile No, Starting with 6 to 9">
                                                <?php echo form_error('mob_no'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="email_id">Email ID <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" value="<?php echo set_value('email_id'); ?>"
                                                    name="email_id" id="email_id" class="form-control"
                                                    placeholder="Email ID">
                                                <?php echo form_error('email_id'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address 1 <span
                                                        class="text-danger">*</span></label>
                                                <!-- <textarea class="form-control" name="address" rows="3"><?php echo set_value('address'); ?></textarea> -->
                                                <input type="text" value="<?php echo set_value('address'); ?>"
                                                    name="address" id="address" class="form-control"
                                                    placeholder="Address 1">

                                                <?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address 2 </label>
                                                <input type="text" value="<?php echo set_value('address_2'); ?>"
                                                    name="address_2" id="address_2" class="form-control"
                                                    placeholder="Address 2">

                                                <?php echo form_error('address_2'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address 3 </label>
                                                <input type="text" value="<?php echo set_value('address_3'); ?>"
                                                    name="address_3" id="address_3" class="form-control"
                                                    placeholder="Address 3">

                                                <?php echo form_error('address_3'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">State <span class="text-danger">*</span></label>
                                                <select name="state" id="state" class="form-control">
                                                    <option value="" hidden="true">Select state</option>
                                                    <?php foreach ($stateList as $key => $value) { ?>
                                                    <option value="<?php echo $value['state_id_pk']; ?>"
                                                        <?php echo set_select('state', $value['state_id_pk']); ?>>
                                                        <?php echo $value['state_name']; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('state'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district">District <span
                                                        class="text-danger">*</span></label>
                                                <select name="district" id="district" class="form-control">

                                                    <?php if($this->input->method(TRUE) == "POST"){ ?>

                                                    <?php foreach ($district as $value) {?>
                                                    <option value="<?php echo $value['district_id_pk']?>"
                                                        <?php echo set_select('district' , $value['district_id_pk']); ?>>
                                                        <?php echo $value['district_name'];?> </option>
                                                    <?php }?>
                                                    <?php } else{?>
                                                    <option value="" hidden="true">Select District</option>
                                                    <?php /* foreach ($districtList as $key => $value) { ?>
                                                    <option value="<?php echo $value['district_id_pk']; ?>"
                                                        <?php echo set_select('district', $value['district_id_pk']); ?>>
                                                        <?php echo $value['district_name']; ?>
                                                    </option>
                                                    <?php } */?>
                                                    <option value="" disabled="true">Select State first...</option>
                                                    <?php }?>
                                                </select>
                                                <?php echo form_error('district'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 other_state_div"
                                            <?php if ((set_value('state') != 19)) echo 'style="display: none;"'; ?>>
                                            <div class="form-group">
                                                <label for="subDivision">Select Sub Division <span
                                                        class="text-danger">*</span></label>
                                                <select name="subDivision" id="subDivision" class="form-control">

                                                    <?php if($this->input->method(TRUE) == "POST"){ ?>

                                                    <?php foreach ($subDivision as $value) {?>
                                                    <option value="<?php echo $value['subdiv_id_pk']?>"
                                                        <?php echo set_select('subDivision' , $value['subdiv_id_pk']); ?>>
                                                        <?php echo $value['subdiv_name'];?> </option>
                                                    <?php }?>
                                                    <?php } else{?>
                                                    <option value="" hidden="true">Select Sub Division</option>
                                                    <option value="" disabled="true">Select District first...</option>
                                                    <?php }?>

                                                </select>
                                                <?php echo form_error('subDivision'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 other_state_div"
                                            <?php if ((set_value('state') != 19)) echo 'style="display: none;"'; ?>>
                                            <div class="form-group">
                                                <label for="municipality">Municipality/Block </label>
                                                <select name="municipality" id="municipality" class="form-control">
                                                    <?php if($this->input->method(TRUE) == "POST"){ ?>

                                                    <?php foreach ($municipality as $value) {?>
                                                    <option value="<?php echo $value['block_municipality_id_pk']?>"
                                                        <?php echo set_select('municipality' , $value['block_municipality_id_pk']); ?>>
                                                        <?php echo $value['block_municipality_name'];?> </option>
                                                    <?php }?>
                                                    <?php } else{?>
                                                    <option value="" hidden="true">Select Municipality / Block</option>
                                                    <option value="" disabled="true">Select Sub Division first...
                                                    </option>
                                                    <?php }?>

                                                </select>
                                                <?php echo form_error('municipality'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pinCode">Pin Code <span class="text-danger">*</span></label>
                                                <input id="pinCode" name="pinCode" id="pinCode" class="form-control"
                                                    type="text" value="<?php echo set_value('pinCode'); ?>">
                                                <?php echo form_error('pinCode'); ?>
                                            </div>
                                        </div>



                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="caste_id">Caste <span class="text-danger">*</span></label>
                                                <select class="form-control" name="caste_id" id="caste_id">
                                                    <option value="" hidden="true">-- Caste --</option>
                                                    <?php foreach($casteList as $val){ ?>
                                                    <option value="<?php echo $val['caste_id_pk'] ?>"
                                                        <?php echo set_select("caste_id",$val['caste_id_pk']) ?>>
                                                        <?php echo $val['caste_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('caste_id'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4 caste_doc_div"
                                            <?php if ((set_value('caste_id') == 1) || (set_value('caste_id') == NULL)) echo 'style="display: none;"'; ?>>

                                            <div class="form-group">
                                                <label class="" for="caste_doc">
                                                    Upload Document
                                                    <span class="text-danger">*</span>
                                                    <!-- <br> -->
                                                    <small>(.PDF only, Max 100KB)</small>
                                                </label>

                                                <div class="input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-success">
                                                            Browse&hellip;<input type="file" style="display: none;"
                                                                name="caste_doc" id="caste_doc">
                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <?php echo form_error('caste_doc'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="religion_id">Religion</label>
                                                <select class="form-control" name="religion_id" id="religion_id">
                                                    <option value="" hidden="true">-- Religion --</option>
                                                    <?php foreach($religion as $val){ ?>
                                                    <option value="<?php echo $val['religion_id_pk'] ?>"
                                                        <?php echo set_select("religion_id",$val['religion_id_pk']) ?>>
                                                        <?php echo $val['religion_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('religion_id'); ?>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-4 other_religion_div" <?php if ((set_value('religion_id') != 4) || (set_value('religion_id') == NULL)) echo 'style="display: none;"'; ?>>
                                            <div class="form-group">
                                                <label for="otherReligionName">Other Religion Name <span class="text-danger">*</span></label>
                                                <input id="otherReligionName" name="otherReligionName" class="form-control" type="text" value="<?php echo set_value('otherReligionName'); ?>">
                                                <?php echo form_error('otherReligionName'); ?>
                                            </div>
                                        </div> -->


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="phy_challenged">Physically Challenged <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="phy_challenged" id="phy_challenged">
                                                    <option value="" hidden="true">-- Physically Challenged --</option>

                                                    <option value="1" <?php echo set_select("phy_challenged",1) ?>>Yes
                                                    </option>
                                                    <option value="0" <?php echo set_select("phy_challenged",0) ?>>No
                                                    </option>

                                                </select>
                                                <?php echo form_error('phy_challenged'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4 phy_challenged_doc_div"
                                            <?php if ((set_value('phy_Challenged') == 0) || (set_value('phy_Challenged') == NULL)) echo 'style="display: none;"'; ?>>

                                            <div class="form-group">
                                                <label class="" for="phy_challenged_doc">
                                                    Upload P.C Certificate
                                                    <span class="text-danger">*</span>
                                                    <!-- <br> -->
                                                    <small>(.PDF only, Max 200KB)</small>
                                                </label>

                                                <div class="input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-success">
                                                            Browse&hellip;<input type="file" style="display: none;"
                                                                name="phy_challenged_doc" id="phy_challenged_doc">
                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <?php echo form_error('phy_challenged_doc'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="datepicker">D.O.B <span class="text-danger">*</span></label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <div class="common_input_div">
                                                    <input type="text" value="<?php echo set_value("dob"); ?>"
                                                        class="form-control pull-right dob_range" id="dob" name="dob"
                                                        placeholder="DD/MM/YYYY">
                                                </div>
                                            </div>
                                            <?php echo form_error('dob'); ?>
                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label class="" for="aadhar_doc">
                                                    Upload Aadhar
                                                    <span class="text-danger">*</span>
                                                    <!-- <br> -->
                                                    <small>(.PDF only, Max 200KB)</small>
                                                </label>

                                                <div class="input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-success">
                                                            Browse&hellip;<input type="file" style="display: none;"
                                                                name="aadhar_doc" id="aadhar_doc">
                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <?php echo form_error('aadhar_doc'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select class="form-control" name="gender" id="gender">
                                                    <option value="">-- Select Gender --</option>
                                                    <?php foreach($genders as $gender){ ?>
                                                    <option value="<?php echo $gender['gender_id_pk'] ?>"
                                                        <?php echo set_select("gender",$gender['gender_id_pk']) ?>>
                                                        <?php echo $gender['gender_description'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('gender'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="marital_status">Marital Status <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="marital_status" id="marital_status">
                                                    <option value="" hidden="true">-- Select Marital Status --</option>

                                                    <option value="1" <?php echo set_select("marital_status",1) ?>>
                                                        Married</option>
                                                    <option value="2" <?php echo set_select("marital_status",2) ?>>
                                                        Unmarried</option>

                                                </select>
                                                <?php echo form_error('marital_status'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4 kanyashree_no_div"
                                            <?php if (((set_value('marital_status') == 2 && set_value('marital_status') == NULL) && (set_value('gender') == 2 && set_value('gender') == NULL)) ) echo 'style="display: block;'; ?>>
                                            <div class="form-group">
                                                <label for="kanyashree_no">Kanyashree Enrolment Number </label>
                                                <input id="kanyashree_no" name="kanyashree_no" class="form-control"
                                                    type="text" value="<?php echo set_value('kanyashree_no'); ?>">
                                                <?php echo form_error('kanyashree_no'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-5">

                                            <div class="form-group">
                                                <label class="" for="std_image">
                                                    Upload Student Image
                                                    <span class="text-danger">*</span>
                                                    <!-- <br> -->
                                                    <small>(.jpeg only,max 100 KB)</small>
                                                </label>

                                                <div class="input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-success">
                                                            Browse&hellip;<input type="file" style="display: none;"
                                                                name="std_image" id="std_image">
                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <?php echo form_error('std_image'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-5">

                                            <div class="form-group">
                                                <label class="" for="std_signature">
                                                    Upload Student Signature
                                                    <span class="text-danger">*</span>
                                                    <!-- <br> -->
                                                    <small>(.jpeg only,max 50 KB)</small>
                                                </label>

                                                <div class="input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-success">
                                                            Browse&hellip;<input type="file" style="display: none;"
                                                                name="std_signature" id="std_signature">
                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <?php echo form_error('std_signature'); ?>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="question-box vtc_last_exam_div">
                   
                    <div class="row question-box-row">
                        <div class="col-md-12">
                            <div class=" border-dark mb-3">
                                <div class="card-header">
                                    <h4>Particulars of the last Examination Passed </h4>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fullmark">Full Marks <span class="text-danger">*</span></label>
                                            <input type="number" value="<?php echo set_value("fullmark") ?>"
                                                name="fullmark" id="fullmark" class="form-control"
                                                placeholder="fullmarks">

                                            <?php echo form_error('fullmark'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mark_obtain">Marks Obtained <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" value="<?php echo set_value("marks_obtain") ?>"
                                                name="marks_obtain" id="marks_obtain" class="form-control"
                                                placeholder="Marks Obtain">

                                            <?php echo form_error('marks_obtain'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="percentage">Percentage % <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="percentage" id="percentage"
                                                value="<?php echo set_value('percentage') ?>" class="form-control"
                                                placeholder="Percentage">

                                            <?php echo form_error('percentage'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="cgpa">C.G.P.A <span class="text-danger">*</span></label>
                                            <input type="number" value="<?php echo set_value("c_g_p_a") ?>"
                                                name="c_g_p_a" id="c_g_p_a" class="form-control" placeholder="C G P A"
                                                step=".01">

                                            <?php echo form_error('c_g_p_a'); ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullmark">Percentage of Marks (3rd yr (Diploma) / Physics /
                                                Mathematics / English) <span class="text-danger">*</span></label>
                                            <input type="number" value="<?php echo set_value("p_o_m1") ?>" name="p_o_m1"
                                                id="p_o_m1" class="form-control"
                                                placeholder="Percentage of marks (3rd yr Diploma / Physics / Mathematics / English)"
                                                step=".01">

                                            <?php echo form_error('p_o_m1'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullmark">Percentage of Marks (2nd yr (Diploma) / Chemistry /
                                                Physics or Science) <span class="text-danger">*</span></label>
                                            <input type="number" value="<?php echo set_value("p_o_m2") ?>" name="p_o_m2"
                                                id="p_o_m2" class="form-control"
                                                placeholder="Percentage of marks (2nd yr / Chemistry / Physics / Science)"
                                                step=".01">

                                            <?php echo form_error('p_o_m2'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="percentage">Percentage of Marks (1st yr (Diploma) / English(H.S)
                                                / Life Science or Biology /
                                                Mathematics) <span class="text-danger">*</span></label>
                                            <input type="number" name="p_o_m3" id="p_o_m3"
                                                value="<?php echo set_value('p_o_m3') ?>" class="form-control"
                                                placeholder="Percentage of Marks (1st yr / English(H.S) / Life Science or Science / Mathematics)"
                                                step=".01">

                                            <?php echo form_error('p_o_m3'); ?>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="fullmark">Name of the Institute <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" value="<?php echo set_value("institute_name") ?>"
                                                name="institute_name" id="institute_name" class="form-control"
                                                placeholder="Institute Name">

                                            <?php echo form_error('institute_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fullmark">Year of Passing <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" value="<?php echo set_value("passing_year") ?>"
                                                name="passing_year" id="passing_year" class="form-control"
                                                placeholder="Passing Year">

                                            <?php echo form_error('passing_year'); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="box-footer">
            </div>
        </div>
        <!-- END of Search Domain -->
    </section>

</div>