<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .card {
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    margin-bottom: 1rem;
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
}


    .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }


</style>

<div class="content-wrapper">

    <section class="content-header">
        <h1>Trade Exhibition</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="bg_trade_exhibition/trade_exhibition"><i class="fa fa-list"></i> Trade Exhibition List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Add Trade Exhibition</li>
        </ol>
    </section>


    <section class="content">
        
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

       
        <?php echo form_open_multipart('admin/bg_trade_exhibition/trade_exhibition/add', array('id'=>'trade-exhibition-form')) ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Product Details</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
            
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for=""> Product Name <span class="text-danger">*<span></label>
                            <input type="text" class="form-control required" required  name="prd_name" value="<?php echo set_value('prd_name'); ?>">
                            <?php echo form_error('prd_name'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="upload_file">Upload Product Image <small>(Max size 1 MB</small><span class="star">*</span><br><small>You can select multiple image</small></label>
                            <div class="input-group">
                                <input type="file" name="prd_image[]" multiple="multiple" required class="form-control">
                                <?php echo form_error('prd_image[]'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="upload_file">Upload Product Video <small>(Max size 5 MB)</small><span class="star">*</span></label>
                            <div class="input-group">
                                <input type="file" name="prd_video" class="form-control">
                                <?php echo form_error('prd_video'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="" for="">Product Description/Write up <span class="text-danger">*<span></label>
                            <textarea rows="2" style="width: 100%;" name="prd_description" required class="required"><?php echo set_value('prd_description'); ?></textarea>
                            <?php echo form_error('prd_description'); ?>
                        </div>
                    </div>

                </div>
               
            </div>
        </div>


        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Created By</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
            
                <div id="created-by-div">
                    <div class="row">

                            
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for=""> Student Name <span class="text-danger">*<span></label>
                                <input type="text" class="form-control required" required name="std_name[]" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for=""> Institute Name <span class="text-danger">*<span></label>
                                <input type="text" class="form-control required" required  name="institute_name[]">
                            </div>
                        </div>
                   
                    

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="" for=""> Discipline/Trade <span class="text-danger">*<span></label>
                                <input type="text" class="form-control required"  required name="discipline[]">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="upload_file">Upload Student Photo <small>(Max size 1 MB)</small><span class="star">*</span></label>
                                <div class="input-group">
                                    <input type="file" name="std_image[]" required class="form-control">
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-md-1"><br>
                            <button type="button" class="btn btn-flat btn-info btn-sm created-by-add-more-btn">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>

                    </div>
                </div>
               
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Mentor By</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
            
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for=""> Mentor Name <span class="text-danger">*<span></label>
                            <input type="text" class="form-control required" required  name="mentor_name" value="<?php echo set_value('mentor_name'); ?>">
                            <?php echo form_error('mentor_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="" for="">Mentor Email <span class="text-danger">*<span></label>
                            <input type="text" class="form-control required" required  name="mentor_email" value="<?php echo set_value('mentor_email'); ?>">
                            <?php echo form_error('mentor_email'); ?>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="" for="">Mentor Mobile No. <span class="text-danger">*<span></label>
                            <input type="text" class="form-control required" required name="mentor_mobile" value="<?php echo set_value('mentor_mobile'); ?>">
                            <?php echo form_error('mentor_mobile'); ?>
                        </div>

                    </div>
				</div>
				<div class="row">
					<div class="col-md-4">

                        <div class="form-group">
                            <label class="" for="">Mentor Designation <span class="text-danger">*<span></label>
                            <input type="text" class="form-control required" required  name="mentor_designation" value="<?php echo set_value('mentor_designation'); ?>">
                            <?php echo form_error('mentor_designation'); ?>
                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="" for="">Institute Name <span class="text-danger">*<span></label>
                            <input type="text" class="form-control required" required  name="mentor_institue" value="<?php echo set_value('mentor_institue'); ?>">
                            <?php echo form_error('mentor_institue'); ?>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="upload_file">Upload Mentor Photo <small>(Max size 1 MB)</small><span class="star">*</span></label>
                            <div class="input-group">
                                <input type="file" name="mentor_image" required class="form-control">
                                <?php echo form_error('mentor_image'); ?>
                            </div>
                        </div>
                    </div>
                   

                </div>
               
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <label class="" for="">&nbsp;</label>
                <button type="submit" class="btn btn-info btn-block submit-btn">Submit</button>
            </div>
        </div>
        <?php echo form_close() ?>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>