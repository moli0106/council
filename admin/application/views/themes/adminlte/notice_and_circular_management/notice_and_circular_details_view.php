<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<style type="text/css">
    .star {
        color: #dd4b39;
        font-size: 18px;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Publication</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-file-text"></i> Publication List</li>
            <li class="active">Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Publication Details</h3>
            </div>
            <?php echo form_open_multipart('admin/notice_and_circular_management/notice_and_circular/update', 'autocomplete="off"'); ?>

            <?php if (($publicationDetails['approve_status'] == 0) && ($this->session->userdata('stake_id_fk') != 14)) { ?>
            <?php } ?>
            <input type="hidden" name="id_hash" value="<?php echo md5($publicationDetails['publication_id_pk']); ?>">
            <input type="hidden" name="approve_status" value="<?php echo $publicationDetails['approve_status']; ?>">

            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="upload_type">Publication Type <span class="star">*</span></label>
                            <select class="form-control select2 select2-hidden-accessible" id="publication_type" name="publication_type" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="" hidden="true">Select Publication Type</option>

                                <?php foreach ($publicationTypeList as $publication) { ?>

                                    <option value="<?php echo $publication['publication_type_id_pk']; ?>" <?php if ($publicationDetails['publication_type_id_fk'] == $publication['publication_type_id_pk']) echo 'selected'; ?>><?php echo $publication['publication_type']; ?></option>
                                <?php } ?>

                            </select>
                            <?php echo form_error('publication_type'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="upload_title">Title <span class="star">*</span></label>
                            <input type="test" name="publication_title" value="<?php echo $publicationDetails['publication_title']; ?>" class="form-control" id="publication_title" placeholder="Enter Publication Title">
                            <?php echo form_error('publication_title'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="document_no">Document No.</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-list-ol"></i>
                                </div>
                                <input type="text" name="document_no" value="<?php echo $publicationDetails['document_no']; ?>" class="form-control" id="document_no" placeholder="Enter Document No.">
                            </div>
                            <?php echo form_error('document_no'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="published_date">
                                Date of Issue / Publishing
                                <!-- <span class="star">*</span> -->
                            </label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control pull-left calender_date" type="text" id="datepicker-13" name="published_date" value="<?php echo $publicationDetails['published_date']; ?>" placeholder="dd/mm/yyyy">
                            </div>
                            <?php echo form_error('published_date'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control pull-left calender_date" type="text" id="datepicker-14" name="start_date" value="<?php echo $publicationDetails['start_date']; ?>" placeholder="dd/mm/yyyy">
                            </div>
                            <?php echo form_error('start_date'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control pull-left calender_date" type="text" id="datepicker-15" name="end_date" value="<?php echo $publicationDetails['end_date']; ?>" placeholder="dd/mm/yyyy">
                            </div>
                            <?php echo form_error('end_date'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="publication_description">Description <span class="star">*</span></label>
                            <textarea id="publication_description" name="publication_description" class="form-control" placeholder="Enter Description"><?php echo $publicationDetails['publication_description']; ?></textarea>
                            <?php echo form_error('publication_description'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="upload_file">Upload PDF file only (Max size 1MB)</label>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-info">
                                            Browse&hellip;<input type="file" style="display: none;" name="publication_file" id="publication_file">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <?php echo form_error('publication_file'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <a href="<?php echo base_url('admin/notice_and_circular_management/notice_and_circular/download_uploaded_pdf/' . md5($publicationDetails['publication_id_pk'])); ?>" class="btn btn-sm btn-info">
                            <i class="fa fa-download" aria-hidden="true"></i> PDF File
                        </a>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <?php if (($publicationDetails['approve_status'] == 0) && ($this->session->userdata('stake_id_fk') != 14)) { ?>
                    <!-- <center><button type="submit" class="btn btn-success">Update Publication Details</button></center> -->
                <?php } ?>
            </div>

            <?php echo form_close(); ?>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>