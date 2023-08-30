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
        <?php if (!empty($examDetails)) {
            $count = 0;
            foreach ($examDetails as $key => $batch) { ?>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Batch <?php echo ++$count; ?> :</h3>
                        <div class="box-tools pull-right">
                            <!-- Statement -->
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong>Exam Type : </strong></td>
                                    <td><?php echo $batch['question_type_name'] ?></td>
                                    <td><strong>Exam Mode : </strong></td>
                                    <td><?php echo $batch['assessment_mode_name'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Sector : </strong></td>
                                    <td colspan="3"><?php
                                                    if ($batch['sector_name']) {
                                                        echo $batch['sector_name'];
                                                    } else {
                                                        echo '--';
                                                    }
                                                    ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Course : </strong></td>
                                    <td colspan="3"><?php
                                                    if ($batch['course_name']) {
                                                        echo $batch['course_name'];
                                                    } else {
                                                        echo '--';
                                                    }
                                                    ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Centre Institute Name : </strong></td>
                                    <td colspan="3"><?php
                                                    if ($batch['institute_name']) {
                                                        echo $batch['institute_name'];
                                                    } else {
                                                        echo '--';
                                                    }
                                                    ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Exam Date : </strong></td>
                                    <td><?php echo date('d-m-Y', strtotime($batch['batch_exam_date'])) . ' (<i>' . date('l', strtotime($batch['batch_exam_date'])) . '</i>)'; ?></td>
                                    <td colspan="2" align="center">
                                        <?php
										$assessor_exam_duration=$this->config->item('assessor_exam_duration');
										$batch_exam_end_time = date('H:i:s', (strtotime($batch['batch_exam_time']) + (60 * 60 * $assessor_exam_duration))); 
                                        $examDate  = date('Y-m-d', strtotime($batch['batch_exam_date']));
                                        $todayDate = date('Y-m-d');

                                        if ($examDate > $todayDate) {
                                            echo '<i class="text-warning">Exam Coming Soon.!!</i>';
                                        } elseif ($examDate < $todayDate) {
                                            echo '<i class="text-warning">Exam End.!!</i>';
                                        } else {
                                            if ($batch['eligibility'] == 1) {
                                                if ($batch['assment_mode'] == 1) {
                                                    if (($batch['exam_status'] != 2) && (($batch['exam_start_time'] == NULL) || (strtotime($batch['exam_start_time']) + (90 * 60)) > strtotime(date('H:i:s')))) {

                                                        //if ((time() >= strtotime("15:00:00")) && (time() <= strtotime("17:00:00"))) {
														if ((time() >= strtotime($batch['batch_exam_time'])) && (time() <= strtotime($batch_exam_end_time))) {
                                                            echo '
                                                                <a href="' . base_url("admin/assessor_exam_corner/online_exam/instructions/" . md5($batch['batch_ems_id_pk'])) . '" class="btn btn-sm btn-warning">
                                                                Attend Exam 
                                                                <i class="fa fa-file-text" aria-hidden="true"></i></a>
                                                            ';
                                                        } else {
																echo '<i class="text-success">Your exam will be started on : ' . date('h:i A', strtotime($batch['batch_exam_time'])) . '. All the best for your exam.!!</i>';
															}
														
                                                    } else {
                                                        echo '<i class="text-danger">--</i>';
                                                    }
                                                } else {
                                                    echo '<i class="text-success">All the best for exam.!!</i>';
                                                }
                                            } else {
                                                echo '<i class="text-danger">You are not eligibile for the exam.!!</i>';
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php if (($batch['exam_start_time'] != NULL) && $batch['exam_status'] == 2) { ?>
                                    <!-- <tr>
                                        <td colspan="4" align="center">
                                            <a href="<?php echo base_url("admin/assessor_exam_corner/online_exam/viewResult/" . md5($batch['batch_ems_id_pk'])); ?>" class="btn btn-sm btn-info">
                                                View Score <i class="fa fa-file-text" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr> -->
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php }
        } else { ?>
            <section class="content">
                <div class="callout callout-warning">
                    <h4>Notice : </h4>
                    <ul>
                        <li><span></span><strong>You are not in any batch.</strong></li>
                    </ul>
                </div>
            </section>
        <?php } ?>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>