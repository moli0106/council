<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Category/Type & Marks</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Question Category/Type & Marks List</li>
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
                <h3 class="box-title">Add Question Category & Marks </h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/qbm_master/question_type_mark') ?>

                <div style="margin: 10px 10px;">
                    <div class="row" style="background-color: #E8F5E9;">
                        <div class="col-md-12">
                            <h4><strong>Minimum Number of Questions to be Entered by Question Creator:</strong></h4>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">HS-VOC (XI)</label>
                                <input type="text" class="form-control" name="hs_voc_xi" id="hs_voc_xi" value="<?php echo set_value('hs_voc_xi'); ?>" placeholder="Min. no. of question in HS-VOC (XI)">
                                <?php echo form_error('hs_voc_xi'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">HS-VOC (XII)</label>
                                <input type="text" class="form-control" name="hs_voc_xii" id="hs_voc_xii" value="<?php echo set_value('hs_voc_xii'); ?>" placeholder="Min. no. of question in HS-VOC (XII)">
                                <?php echo form_error('hs_voc_xii'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">Polytechnic</label>
                                <input type="text" class="form-control" name="polytechnic" id="polytechnic" value="<?php echo set_value('polytechnic'); ?>" placeholder="Min. no. of question in Polytechnic">
                                <?php echo form_error('polytechnic'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">Pharmacy</label>
                                <input type="text" class="form-control" name="pharmacy" id="pharmacy" value="<?php echo set_value('pharmacy'); ?>" placeholder="Min. no. of question in Pharmacy">
                                <?php echo form_error('pharmacy'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Question Category/Type Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="question_type" id="question_type" value="<?php echo set_value('question_type'); ?>" placeholder="Enter question name">
                            <?php echo form_error('question_type'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Per Question Mark <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="question_mark" id="question_mark" value="<?php echo set_value('question_mark'); ?>" placeholder="Enter question mark ">
                            <?php echo form_error('question_mark'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="" for="">&nbsp;</label>
                        <button type="submit" class="btn btn-success btn-block btn-flat">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            Submit Question Category
                        </button>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List of Question Category & Marks</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <table class="table table-hover table-bordered">
                    <tr style="background-color: #E8F5E9;">
                        <th style="vertical-align : middle;text-align:center;" rowspan="2">Sl. No.</th>
                        <th style="vertical-align : middle;text-align:center;" rowspan="2">Question Type</th>
                        <th style="vertical-align : middle;text-align:center;" rowspan="2">Question Mark</th>
                        <th colspan="4" style="text-align: center;">Minimum Number of Questions to be Entered by Question Creator</th>
                        <th style="vertical-align : middle;text-align:center;" rowspan="2">Action</th>
                    </tr>
                    <tr>
                        <th>HS-VOC (XI)</th>
                        <th>HS-VOC (XII)</th>
                        <th>Polytechnic</th>
                        <th>Pharmacy</th>
                    </tr>
                    <?php
                    if (count($questionCategory)) {
                        $i = $offset;
                        foreach ($questionCategory as $key => $category) { ?>

                            <tr id="<?php echo md5($category['question_type_mark_id_pk']); ?>">
                                <td><?php echo ++$i; ?>.</td>
                                <td><?php echo $category['question_type_name']; ?></td>
                                <td><?php echo $category['question_mark']; ?></td>
                                <td><?php echo $category['hs_voc_xi']; ?></td>
                                <td><?php echo $category['hs_voc_xii']; ?></td>
                                <td><?php echo $category['polytechnic']; ?></td>
                                <td><?php echo $category['pharmacy']; ?></td>
                                <td>
                                    <a href="<?php echo base_url('admin/qbm_master/question_type_mark/update/' . md5($category['question_type_mark_id_pk'])); ?>" class="btn btn-sm btn-flat btn-info">
                                        <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php }
                    } else { ?>

                        <tr>
                            <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                        </tr>

                    <?php } ?>
                </table>
            </div>

            <div class="box-footer" style="text-align: center">
                <?php echo $page_links ?>
            </div>

        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>