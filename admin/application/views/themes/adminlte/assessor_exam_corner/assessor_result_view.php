<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Batch Exam Corner</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Exam Corner</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Exam Status</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Batch Id : </strong>
                                <span class="pull-right"><?php echo $examDetails['batch_id']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Date : </strong>
                                <span class="pull-right">
                                    <?php echo date('d-m-Y', strtotime($examDetails['start_date'])); ?>
                                    to
									<?php echo date('d-m-Y', strtotime($examDetails['end_date'])); ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong>Sector Name : </strong>
                                <span class="pull-right"><?php echo $examDetails['sector_name']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Course Name : </strong>
                                <span class="pull-right"><?php echo $examDetails['course_name']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <strong>Total Number of Question : </strong>
                                <strong class="pull-right">
                                    <?php echo $resultDetails['total_question']; ?>
                                </strong>
                            </li>
                            <li class="list-group-item">
                                <strong>Total Number of Attempted Question : </strong>
                                <strong class="pull-right">
                                    <?php echo $resultDetails['question_attempt']; ?>
                                </strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>