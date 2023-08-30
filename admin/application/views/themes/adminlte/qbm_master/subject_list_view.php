<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Subject</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Subject List</li>
        </ol>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('status') !== null){ ?>
            <div class="alert alert-<?=$this->session->flashdata('status')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('alert_msg')?>
            </div>
        <?php } ?>

        
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Subject Add</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/qbm_master/subject') ?>
                    <div class="row">  
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Subject Name *</label>
                                <input type="text" class="form-control" name="subject_name" id="subject_name"
                                    value="<?php echo set_value('subject_name'); ?>" placeholder="Enter subject name">
                                <?php echo form_error('subject_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Subject Code *</label>
                                <input type="text" class="form-control" name="subject_code" id="subject_code"
                                    value="<?php echo set_value('subject_code'); ?>" placeholder="Enter subject code">
                                <?php echo form_error('subject_code'); ?>
                            </div>
                        </div>
                    </div>
                                    
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-info btn-block">Submit</button>
                        </div>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
     

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Subject List</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/qbm_master/subject/map_subject') ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Map Subject
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Subject</th>
                            <th>Code</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($subjectList))
                            {
                                $i = $offset;
                                foreach ($subjectList as $key => $subject) { ?>

                                    <tr id="<?php echo md5($subject['subject_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $subject['subject_name']; ?> </td>
                                        <td><?php echo $subject['subject_code']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/qbm_master/subject/add_topics/' . md5($subject['subject_id_pk'])); ?>" class="btn btn-info btn-sm">
                                            Map Topic
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
                <?php echo $page_links ?>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div id="myModalList" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-info">Sector List</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Sector</th>
                            
                        </tr>
                    </thead>
                    <tbody id="sectorJobRoleList">
                        <tr>
                            <td colspan="3" align="center">Please wait a moment...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>

    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>