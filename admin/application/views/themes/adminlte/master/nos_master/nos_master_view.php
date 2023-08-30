<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>NoS Type Master</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>NoS Type Master</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add NoS Type</h3>
                        <div class="box-tools pull-right"></div>
                    </div>

                    <div class="box-body">
                        <?php echo form_open('admin/master/nos_master') ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nos_type">Enter NoS Type<span class="text-danger">*</span></label>
                                    <input type="text" name="nos_type" class="form-control" id="nos_type" value="<?php echo set_value('nos_type'); ?>">

                                    <?php echo form_error('nos_type'); ?>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                        <?php form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">NoS Type List</h3>
                <div class="box-tools pull-right"></div>
            </div>

            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NoS Type</th>
                            <th>Added Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($nosList) > 0) {
                            $count = 0;
                            foreach ($nosList as $key => $nos) { ?>
                                <tr id="<?php echo md5($nos['nos_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $nos['nos_name']; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($nos['entry_time'])) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-update-nos-type" id="update_nos_type">
                                            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger remove-nos-type"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>

                            <tr class="text-center text-danger">
                                <td colspan="4">No data found...</td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- <div class="box-footer" style="text-align: center"></div> -->
        </div>
    </section>
</div>

<!-- Modal -->
<div id="modal-update-nos-type" class="modal modal-success fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update NoS Type</h4>
            </div>
            <div class="modal-body nos-data" style="background-color: #ecf0f5 !important; color: #000 !important;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="update_nos_type_text">NoS Type<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_nos_type_text">
                            <input type="hidden" class="form-control" id="nos_type_id_hash">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-sm btn-success" id="update_nos_type_btn">Update NoS Type</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>