<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .highlight {
        padding: 9px 14px;
        margin-bottom: 14px;
        background-color: #f7f7f9;
        border: 1px solid #e1e1e8;
        border-radius: 4px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Empanelled Course Details</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-user"></i> Empanelled Course Details</li>
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
                <h3 class="box-title">Empanelled Course Details</h3>
            </div>
            <div class="box-body">
            <div class="highlight">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Name</th>
                                <th>PAN</th>
                                <th>Sector</th>
                                <th>Course</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            <?php foreach ($emp_course as $key => $value) { ?>
                                <tr>
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['assessor_name']; ?></td>
                                    <td><?php echo $value['pan']; ?></td>
                                    <td><?php echo $value['sector_name']; ?></td>
                                    <td><?php echo $value['course_name']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="box-header with-border">
                    <h3 class="box-title">Empanelled Course Map  Details</h3>
                </div>
                <div class="highlight">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Sector</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            <?php foreach ($course_map_details as $key => $value) { ?>
                                <tr id="<?php echo $value['course_grouping_id_fk'] ?>"> 
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['sector_name']; ?></td>
                                    <td><?php echo $value['course_name']; ?></td>
                                    <td>
                                        <button  id="<?php echo $this->uri->segment(4)?>" data-empcourse="<?php echo $this->uri->segment(5)?>"  class="btn btn-sm btn-info add_course_map"><i class="fa fa-plus" aria-hidden="true"> Empanell Course Grouping</i></button>
                                    </td>
                                    
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                



            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>