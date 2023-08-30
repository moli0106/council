<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>API Response</h1>
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
                <h3 class="box-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Error Response List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <table class="table table-hover" id="errorTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Batch Code</th>
                            <th>Response Message</th>
                            <th>Response Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php $count = 0; ?>
                        <?php if (!empty($errorResponse)) { ?>
                            <?php foreach ($errorResponse as $key => $response) { ?>
                                <tr id="<?php echo md5($response['council_json_data_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $response['user_batch_code']; ?></td>
                                    <td><?php echo $response['council_response_message']; ?></td>
                                    <td><?php echo $response['result_status_name']; ?></td>
                                    <td><?php echo date('d M, Y', strtotime($response['entry_time'])); ?></td>
                                    <td><?php echo $response['response_status']; ?></td>
                                    <td>
                                        <button class="btn btn-xs btn-flat bg-navy send-response">Send Response</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td class="text-danger text-center" colspan="6">No Data Found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer"></div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>