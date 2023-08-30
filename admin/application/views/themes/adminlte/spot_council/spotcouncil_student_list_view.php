<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
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

    #example1 {
        border: 1px solid;
        padding: 10px;
        box-shadow: 5px 5px #888888;
    }

    #example2 {
        border: 1px solid;
        padding: 10px;
        box-shadow: 5px 5px #888888;
    }

    #example3 {
        border: 1px solid;
        padding: 10px;
        box-shadow: 5px 5px #888888;
    }

    #example4 {
        border: 1px solid;
        padding: 10px;
        box-shadow: 5px 5px #888888;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Student list view with Application Number</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student list view with Application Number</li>
        </ol>
    </section>
    <section class="content">
        <?php if (isset($status)) { ?>

            <div class="alert alert-<?php echo $status ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message ?>
            </div>

        <?php } ?>

        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
            <?php echo $this->session->flashdata('validation_errors_list') ?>
        <?php } ?>

        <!-- Search Domain by abhijit on 25-02-2021 -->
        <div class="box">
            <div class="box-body">
                <?php //echo form_open('admin/spot_council/vacent_college_list/get_spotcouncil_student') 
                ?>

                <div>
                    <b>

                        <i class="fa fa-university"></i>
                        <?php echo $map_details_data['college_name']; ?>
                        [<?php echo $map_details_data['college_code']; ?>]
                    </b>
                </div><br>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" style="width: 100%;" id="search_application" name="search_application" placeholder="Application Number" value="<?php echo set_value('search_application') ?>">
                            <?php echo form_error('search_application'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info application_search">
                                Search <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                </div>
                <?php //echo form_close() 
                ?>
            </div>
            <input type="hidden" id="college_map_id" value="<?php echo $college_map_id;?>">
            <input type="hidden" id="college_id_hash" value="<?php echo $college_id;?>">
            <input type="hidden" id="discipline_id" value="<?php echo $displine_id;?>">
            <!-- END of Search Domain -->
            <div class="box-header with-border">
                <h3 class="box-title">Student Details</h3>
                <div id="enrollment_id">




                </div>

                <!-- <div class="box-footer">
                    <?php //echo $page_links ?>
                </div> -->
            </div>
            <!-- END of Search Domain -->
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>