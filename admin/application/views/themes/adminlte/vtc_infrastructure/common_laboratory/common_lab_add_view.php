<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>VTC infrastructure</li>
            <li class="active"><i class="fa fa-align-center"></i>Other Common Laboratory List</li>
            <li class="active"><i class="fa fa-align-center"></i>Add</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('status') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $this->session->flashdata('alert_msg') ?>
        </div>
        <?php } ?>

        <?php if ($vtcDetails['final_submit_status'] == 1) { ?>
            <?php if(!empty($vtcCourseList)){?>
                <?php if(!empty($vtcHSCourseList)){?>


                    <div class="row">
                        <div class="col-md-12">

                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Add Other Common Laboratory</h3>
                                </div>



                                <div class="box-body">
                                    <input type="hidden" value="<?php echo md5($vtc_id); ?>" id="vtc_id">
                                    <?php echo form_open_multipart('admin/vtc_infrastructure/common_laboratory') ?>

                                    <input type="hidden" value="" name="cmn_id_hash" id="cmn_id_hash">

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="" for="course_name_id">Select course name <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="course_name_id" id="course_name_id">
                                                    <option value="">Select course name</option>
                                                    <option value="1" <?php echo set_select('course_name_id', '1')?>>HS-Voc</option>
                                                    <!-- <option value="4" <?php echo set_select('course_name_id', '4')?>>VIII+ STC</option> -->

                                                </select>
                                                <?php echo form_error('course_name_id'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="" for="discipline_id">Select Discipline Name<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2" name="discipline_id" id="discipline_id">
                                                    <?php foreach ($discipline as $key => $value) {?>
                                                    <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                                    <option value="<?php echo $value['discipline_id_pk'];?>"
                                                        <?php echo set_select('discipline_id', $value['discipline_id_pk'])?>>
                                                        <?php echo $value['discipline_name'];?></option>
                                                    <?php } } ?>

                                                </select>
                                                <?php echo form_error('discipline_id'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="" for="item_id">Infrastructure item <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2" name="item_id" id="item_id">
                                                    <option value="" hidden="true">Select Infrastructure item</option>


                                                </select>
                                                <?php echo form_error('item_id'); ?>
                                            </div>
                                        </div>




                                    </div>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="" for="course_id">Infrastructure Item Available <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input present-aplicable" type="radio"
                                                        name="aplicable_no" id="aplicable_no_yes" value="1"
                                                        <?php echo set_radio('aplicable_no', 1) ?>>
                                                    <label class="form-check-label" for="aplicable_no_yes">Yes</label>

                                                    <input class="form-check-input present-aplicable" type="radio"
                                                        name="aplicable_no" id="aplicable_no_no" value="0"
                                                        <?php echo set_radio('aplicable_no', 0) ?>>
                                                    <label class="form-check-label" for="aplicable_no_no">No</label>
                                                </div>
                                                <?php echo form_error('aplicable_no'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-6 lab-size-div"
                                            <?php if(set_value('aplicable_no') != 1){echo 'style="display: none;"';}?>>
                                            <div class="form-group">
                                                <label class="" for="">EXPERIMENTAL SET-UPS / EQUIPMENTS / MACHINERIES ETC. FULLY
                                                    AVAILABILE FOR THE COURSE AS PER CURRICULUM <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="experimental_setup"
                                                        id="experimental_setup_yes" value="1"
                                                        <?php echo set_radio('experimental_setup', 1) ?>>
                                                    <label class="form-check-label" for="experimental_setup_yes">Yes</label>

                                                    <input class="form-check-input" type="radio" name="experimental_setup"
                                                        id="experimental_setup_no" value="0"
                                                        <?php echo set_radio('experimental_setup', 0) ?>>
                                                    <label class="form-check-label" for="experimental_setup_no">No</label>
                                                </div>
                                                <?php echo form_error('experimental_setup'); ?>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="no_of_units">No of set up/units in working condition at present <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" name="no_of_units" id="no_of_units" value="<?php echo set_value('no_of_units'); ?>">
                                                            <?php echo form_error('no_of_units'); ?>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="min_no_of_units">Minimum No of set up/units required for the course <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" name="min_no_of_units" id="min_no_of_units" value="<?php echo set_value('min_no_of_units'); ?>">
                                                            <?php echo form_error('min_no_of_units'); ?>
                                                        </div>
                                                    </div> -->




                                        <div class="col-md-3 equipment-doc-div"
                                            <?php if(set_value('aplicable_no') != 1){echo 'style="display: none;"';}?>>
                                            <div class="form-group">
                                                <label class="" for="equipment_doc">
                                                    Upload single pdf containing list of set-ups/equipment/machineries available
                                                    <span class="text-danger">*</span>
                                                    <br>
                                                    <small>(Upload Highest pdf 200 KB)</small>
                                                </label>

                                                <div class="input-group">
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-success">
                                                            Browse&hellip;<input type="file" style="display: none;"
                                                                name="equipment_doc" id="equipment_doc">
                                                        </span>
                                                    </label>
                                                    <input type="text" class="form-control" readonly>
                                                </div>
                                                <?php echo form_error('equipment_doc'); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 text-center">
                                            <label>&nbsp;</label><br>
                                            <button type="submit" class="btn btn-success btn-block btn-sm">Submit Other Common
                                                Laboratory</button>
                                        </div>

                                    </div>

                                    <?php echo form_close() ?>
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Other Common Laboratory / workshop List</h3>
                                    <div class="box-tools pull-right">
                                        <!--  -->
                                    </div>
                                </div>


                                <div class="box-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Sl. No.</th>
                                                <th>Subject Name</th>
                                                <th>Infrastructure item</th>
                                                <th>Applicable Present</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                    if(count($commonLabData))
                                                    {
                                                        $i = $offset;
                                                        foreach ($commonLabData as $key => $val) { ?>

                                            <tr id="<?php echo md5($val['vtc_other_common_lab_id_pk']); ?>">
                                                <td><?php echo ++$i; ?>.</td>
                                                <td><?php echo $val['discipline_name']; ?> </td>
                                                <td><?php echo $val['item_name']; ?> </td>
                                                <td>
                                                    <?php if($val['applicable_present'] == 0){echo 'No';}else{echo 'Yes';} ?>
                                                </td>
                                                <!-- <td><?php echo $val['mentor_designation']; ?></td>
                                                            
                                                                <td>
                                                                    <?php if ($val['prd_image'] != NULL) { ?>
                                                                    <img class="profile-user-img img-responsive img-circle" src="data:image/jpeg;base64, <?php echo $product['prd_image'][0]; ?>" alt="Product Image" style="margin:0px;">
                                                                    <?php } else { ?>
                                                                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('admin/themes/adminlte/assets/image/no-product-image.png'); ?>" alt="Product Image" style="margin:0px;">
                                                                    <?php } ?>  
                                                                    
                                                                </td> -->
                                                <td>
                                                    <a href="<?php echo base_url('admin/vtc_infrastructure/common_laboratory/details/' . md5($val['vtc_other_common_lab_id_pk'])); ?>"
                                                        class="btn btn-xs btn-flat btn-info">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php }
                                                    } else { ?>
                                            <tr>
                                                <td colspan="6" align="center" class="text-danger">No Data Found...</td>
                                            </tr>

                                            <?php }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer" style="text-align: center">
                                    <?php //echo $page_links ?>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php } else { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                        Not applicable as No H.S-Voc course is chosen
                    </div>
                <?php } ?>

            <?php } else { ?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your All courses have not been completed.
                </div>
            <?php } ?>

        <?php } else { ?>
        <div class="alert alert-warning alert-dismissible">
            <h4><i class="icon fa fa-warning"></i> Warning !</h4>
            Please complete and submit Affiliation Part I first.
        </div>
        <?php } ?>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>