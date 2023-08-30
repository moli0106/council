<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>


<div class="box-body">

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">

                <div class="">

                    <div class="">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>pk</th>
                                    <th>app No</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                <?php if (count($get_duplicate) > 0) { ?>
                                <?php foreach ($get_duplicate as $key => $value) { ?>
                                <tr id="<?php echo md5($value['teacher_id_pk']); ?>">
                                    <td>
                                        <?php echo ++$count; ?>.
                                    </td>
                                    <td><?php echo $value['application_form_no']; ?></td>
                                    
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td colspan="3" align="center" class="text-danger">No Data Found...</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>