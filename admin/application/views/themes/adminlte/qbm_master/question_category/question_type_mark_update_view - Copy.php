<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Category/Type & Marks</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Question Category/Type & Marks Add</li>
        </ol>
    </section>

    <section class="content">
        <?php if (isset($status)) { ?>
            <div class="alert alert-<?php echo $status ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Update Question Category & Marks </h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/qbm_master/question_type_mark/update/' . $form_data['question_type_mark_id_pk']) ?>

                <input type="hidden" name="question_type_mark_id_pk" value="<?php echo $form_data['question_type_mark_id_pk']; ?>">

                <div style="margin: 10px 10px;">
                    <div class="row" style="background-color: #E8F5E9;">
                        <div class="col-md-12">
                            <h4><strong>Minimum Number of Questions to be Entered by Question Creator:</strong></h4>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">HS-VOC (XI)</label>
                                <input type="text" class="form-control" name="hs_voc_xi" id="hs_voc_xi" value="<?php echo $form_data['hs_voc_xi']; ?>" placeholder="Min. no. of question in HS-VOC (XI)">
                                <?php echo form_error('hs_voc_xi'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">HS-VOC (XII)</label>
                                <input type="text" class="form-control" name="hs_voc_xii" id="hs_voc_xii" value="<?php echo $form_data['hs_voc_xii']; ?>" placeholder="Min. no. of question in HS-VOC (XII)">
                                <?php echo form_error('hs_voc_xii'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">Polytechnic</label>
                                <input type="text" class="form-control" name="polytechnic" id="polytechnic" value="<?php echo $form_data['polytechnic']; ?>" placeholder="Min. no. of question in Polytechnic">
                                <?php echo form_error('polytechnic'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">Pharmacy</label>
                                <input type="text" class="form-control" name="pharmacy" id="pharmacy" value="<?php echo $form_data['pharmacy']; ?>" placeholder="Min. no. of question in Pharmacy">
                                <?php echo form_error('pharmacy'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Question Category/Type Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="question_type" id="question_type" value="<?php echo $form_data['question_type_name']; ?>" placeholder="Enter question name">
                            <?php echo form_error('question_type'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Per Question Mark <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="question_mark" id="question_mark" value="<?php echo $form_data['question_mark']; ?>" placeholder="Enter question mark ">
                            <?php echo form_error('question_mark'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="" for="">&nbsp;</label>
                        <button type="submit" class="btn btn-success btn-block btn-flat">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            Update Question Category
                        </button>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>

    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>