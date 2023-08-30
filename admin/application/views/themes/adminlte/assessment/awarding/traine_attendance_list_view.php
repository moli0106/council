<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="assessment/awarding/batch"><i class="fa fa-align-center"></i>Assessment Batch List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Trainee List</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Trainee List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Trainee Name</th>
                            <th>Council Code</th>
                            <th>User Code</th>
                            <th>Mobile No.</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php $count = 0;
                        $all_trainee_marks_uploaded = 1;
                        foreach ($trainee_list as $key => $trainee) { ?>

                            <tr>
                                <td><?php echo ++$count; ?>.</td>
                                <td><?php echo $trainee['trainee_full_name']; ?></td>
                                <td><?php echo $trainee['council_trainee_code']; ?></td>
                                <td><?php echo $trainee['user_trainee_id']; ?></td>
                                <td><?php echo $trainee['trainee_mobile_no']; ?></td>
                                <td>
                                    <span class="label label-info">
                                        <?php echo $trainee['attendance_percentage']; ?> %
                                    </span>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>