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
        <h1>Subject List View</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Subject List View</li>
        </ol>
    </section>
    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
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
                <?php echo form_open('admin/polytechnic_master/subject',array("id"=> "course_entry_form")) ?>
                <div class="row">
                    
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="" for="">Subject Name *</label>
                        <input type="text" class="form-control" name="sub_name" id="sub_name" value="<?php echo set_value("sub_name"); ?>">
                        <?php echo form_error('sub_name'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="" for="">Subject Code *</label>
                        <input type="text" class="form-control" name="sub_code" id="sub_code" value="<?php echo set_value("sub_code"); ?>">
                        <?php echo form_error('sub_code'); ?>
                    </div>
                </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
        <!-- Search Domain by Birendra Singh on 25-02-2021 -->
        <div class="box">
            <div class="box-body">
                <?php /*
                <?php echo form_open('admin/master/qualification_domain_map/searchQualificationDomainMap') ?>
                    <div class="row">
                    
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control select2 qualification" style="width: 100%;" name="search_qualification" >
                                    <option value="" hidden="true">Search by Qualification</option>
                                    <?php foreach($qualifications as $qualification){ ?>
                                        <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php if($this->session->flashdata('search_qualification') == $qualification['qualification_id_pk']) echo 'selected';?>>
                                            <?php echo $qualification['qualification'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('search_qualification'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control select2 domain" style="width: 100%;" name="search_domain">
                                    <option value="" hidden="true">Search by Domain</option>
                                    <?php foreach($domains as $domain){ ?>
                                        <option value="<?php echo $domain['domain_id_pk'] ?>" <?php if($this->session->flashdata('search_domain') == $domain['domain_id_pk']) echo 'selected';?>><?php echo $domain['domain_name'] ?></option>
                                    <?php } ?>
                                    
                                </select>
                                <?php echo form_error('search_domain'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">
                                    Search <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    
                    </div>
                <?php echo form_close() ?>
                */?>
            </div>
            <!-- END of Search Domain -->
            <div class="box-header with-border">
                <h3 class="box-title">Subject List View</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/qbm_master/subject/map_subject') ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Map Subject
                    </a>
                </div>
            </div>
            <div class="box-body">
                <?php if(count($subject)){ ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Subject Name </th>
                            <th>Subject Code </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $offset + 1; foreach($subject as $val){ ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $val['subject_name'] ?></td>
                            <td><?php echo $val['subject_code'] ?></td>
                            <td class="action_buttons">
                                <a href="#" alt="<?php echo md5($val['subject_id_pk']) ?>" class="btn btn-xs btn-primary view_discipline" data-toggle="modal" data-target="#mySubModal">Edit</a>
                                <!-- <a href="#" alt="<?php echo md5($qualification_domain['council_qualification_domain_pk']) ?>" class="btn btn-xs btn-primary delete_domain" data-toggle="modal" data-target="#myModal">Delete</a> -->
                                <!-- <a href="master/new_course/map_domain_qualification/<?php echo md5($course['course_id_pk']) ?>" alt="" class="btn btn-xs btn-info">Map Domain</a> -->
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    No data found
                <?php } ?>


            </div>
            <div class="box-footer">
                <?php echo $page_links ?>
            </div>
        </div>
        <!-- END of Search Domain -->
    </section>
    <!-- Modal -->

    <div class="modal modal-success fade" id="mySubModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Subject View</h4>

                </div>
                <div class="modal-body subject_data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
  
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>