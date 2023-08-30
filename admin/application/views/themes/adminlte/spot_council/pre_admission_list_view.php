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
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Pre-admission Data List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Pre-admission Data List</li>
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
                <h3 class="box-title">Pre-Admission Registration form</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                <?php echo form_open('admin/spot_council/pre_admission/', array("id" => "pre_admission_entry_form")) ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="" for="">Application Form Number *</label>
                            <input type="text" class="form-control" name="application_form_no" id="application_form_no" value="<?php echo set_value('application_form_no'); ?>" placeholder="Enter Application Form No">
                            <?php echo form_error('application_form_no'); ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group" style="margin-top:26px;">
                            <button type="submit" class="btn btn-primary pull-right" class="form-control">Submit</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>


        <!-- Search Domain by Birendra Singh on 25-02-2021 -->
        <div class="box">

            <!-- END of Search Domain -->
            <div class="box-header with-border">
                <h3 class="box-title">Pre-admission data List</h3>
                <div style="margin-left:1000px">
                  <!--   <a href="spot_council/student_data_list/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a> -->
                </div>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                <?php if (count($pre_admission_details)) { ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Application Form No</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = $offset + 1;
                            foreach ($pre_admission_details as $admission_data) {
                                //    echo '<pre>'; print_r($vacent_colleges); die;
                            ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $admission_data['application_form_no'] ?></td>
                                    
                                   
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                <?php  } else { ?>
                    No Data Found

                <?php  } ?>


            </div>
            <div class="box-footer">
                <?php echo $page_links ?>
            </div>
        </div>
        <!-- END of Search Domain -->
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
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>