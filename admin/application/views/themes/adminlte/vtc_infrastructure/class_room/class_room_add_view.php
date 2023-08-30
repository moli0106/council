<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>VTC infrastructure</li>
            <!-- <li class="active"><i class="fa fa-align-center"></i>Class Room Details List</li> -->
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

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Class Room Details</h3>
            </div>
            <?php if ($vtcDetails['final_submit_status'] == 1) { ?>
                <div class="box-body">
                    <input type="hidden" value="<?php echo md5($vtc_id); ?>" id="vtc_id">
                    <?php echo form_open_multipart('admin/vtc_infrastructure/class_room/add') ?>

                    <div class="row">
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="room_type">Select class room type <span class="text-danger">*</span></label>
                                <select class="form-control" name="room_type" id="room_type">
                                    <option value="" >Select class room type</option>
                                    <option value="HS" <?php echo set_select('room_type', 'HS')?> >HS</option>
                                    <option value="STC" <?php echo set_select('room_type', 'STC')?>>STC</option>

                                </select>
                                <?php echo form_error('room_type'); ?>
                            </div>
                        </div> -->

                        <div class="col-md-5" >
                            <div class="form-group">
                                <label for="no_of_room">No of Class rooms available for HS-Voc courses<span class="text-danger">*</span></label>
                                <?php if($this->input->method(TRUE) == "POST"){ ?>

                                    <input type="number" class="form-control" name="no_of_room" id="no_of_room" value="<?php echo set_value('no_of_room');?>">
                                
                                <?php } elseif($this->input->method(TRUE) == "GET") { ?>

                                    <input type="number" class="form-control" name="no_of_room" id="no_of_room" value="<?php if($classRoomData){echo $classRoomData['no_of_room'];} ?>">
                                <?php } ?>
                                <?php echo form_error('no_of_room'); ?>
                            </div>
                        </div>
                        
                        
                       
                        
                        
                    </div>
                    <div class="room-details-block"></div>

                    <div class="row">
                        <div class="col-md-5" >
                            <div class="form-group">
                                <label for="no_of_lab">No of lab / workshop available for Short Term Courses<span class="text-danger">*</span></label>
                                <?php if($this->input->method(TRUE) == "POST"){ ?>
                                    <input type="number" class="form-control" name="no_of_lab" id="no_of_lab" value="<?php echo set_value('no_of_lab'); ?>">
                                    
                                    <?php } elseif($this->input->method(TRUE) == "GET") { ?>
                                        <input type="number" class="form-control" name="no_of_lab" id="no_of_lab" value="<?php if($labSizeData){echo $labSizeData['no_of_lab'];}?>">
                                    <?php } ?>
                                <?php echo form_error('no_of_lab'); ?>
                            </div>
                        </div>
                       

                    </div>

                    <div class="lab-size-block"></div>

                    <div class="row">
                    
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-center">
                            <label>&nbsp;</label><br>

                            <?php if($vtcDetails['second_final_submit_status']==0){?>
                        <?php if(!empty($classRoomData)){?>
                            <button type="submit" class="btn btn-success btn-block btn-sm">Update Class Room Details</button>
                        <?php }else{?>
                            <button type="submit" class="btn btn-success btn-block btn-sm">Submit Class Room Details</button>
                        <?php }}?>
                           
                        </div>

                    </div>

                    <?php echo form_close() ?>
                </div>
            <?php } else { ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                Please complete and submit Affiliation Part I first.
            </div>
            <?php } ?>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>