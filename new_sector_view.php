<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
    .star {
        color: red;
        font-size: 14px;
    }

    .mtop20 {
        margin-top: 20px;
    }

    .mbottom20 {
        margin-bottom: 20px;
    }

    .mright20 {
        margin-right: 20px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Council Sector</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> New Sector</li>
        </ol>
    </section>
    <section class="content">
        <?php if(isset($status)){ ?>
                
                <div class="alert alert-<?php echo $status ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $message ?>
                </div>
                
            <?php } ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Entry form</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/new_sector',array("id"=> "course_entry_form")) ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Sector Name *</label>
                            <input type="text" class="form-control" name="sector_name" id="sector_name"
                            value="<?php echo set_value('sector_name'); ?>" placeholder="Enter sector name">
                            <?php echo form_error('sector_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Sector Code *</label>
                            <input type="text" class="form-control" name="sector_code" id="sector_sector_codedesc"
                            value="<?php echo set_value('sector_code'); ?>" placeholder="Enter sector code">
                            <?php echo form_error('sector_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Sector Description</label>
                            <input type="text" class="form-control" name="sector_desc" id="sector_desc"
                            value="<?php echo set_value('sector_desc'); ?>" placeholder="Enter sector Description">
                            <?php echo form_error('sector_desc'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Sector List</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Sector Name</th>
                            <th>Sector Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $offset + 1; foreach($sectors as $sector){ ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $sector['sector_name'] ?></td>
                            <td><?php echo $sector['sector_code'] ?></td>
                            <td class="action_buttons">
                                <a href="#" alt="<?php echo md5($sector['sector_id_pk']) ?>" class="btn btn-primary btn-xs view_sector" data-toggle="modal" data-target="#myModal">View</a>
								<a href="#" alt="<?php echo md5($sector['sector_id_pk']) ?>" class="btn btn-xs btn-primary edit_sector" data-toggle="modal" data-target="#myModal">Edit</a>
                                <!-- <a href="#" alt="<?php echo md5($sector['sector_id_pk']) ?>" class="btn btn-primary btn-xs delete_sector" data-toggle="modal" data-target="#myModal">Delete</a> -->
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                
                    
            </div>
            <div class="box-footer">
                <?php echo $page_links ?>
            </div>
        </div>
        
    </section>
     <!-- Modal -->
     <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>