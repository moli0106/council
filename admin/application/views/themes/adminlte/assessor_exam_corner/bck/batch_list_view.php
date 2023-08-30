<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Batch Exam Corner</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li></i>Exam Corner</li>
            <li class="active"><i class="fa fa-key"></i>Online Exam</li>
        </ol>
    </section>

    <section class="content">
        <?php if(!empty($examDetails)) { $count = 0; foreach ($examDetails as $key => $batch) { ?>
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
                                <td><?php echo $batch['question_type_name']?></td>
                                <td><strong>Exam Mode : </strong></td>
                                <td><?php echo $batch['assessment_mode_name']?></td>
                            </tr>
                            <tr>
                                <td><strong>Sector : </strong></td>
                                <td colspan="3"><?php
                                    if($batch['sector_name']) {
                                        echo $batch['sector_name'];
                                    } else { 
                                        echo'--';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td><strong>Course : </strong></td>
                                <td colspan="3"><?php
                                    if($batch['course_name']) {
                                        echo $batch['course_name'];
                                    } else { 
                                        echo'--';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td><strong>Centre Institute Name : </strong></td>
                                <td colspan="3"><?php
                                    if($batch['institute_name']) {
                                        echo $batch['institute_name'];
                                    } else { 
                                        echo'--';
                                    }
                                ?></td>
                            </tr>
                            <tr>
                                <td><strong>Exam Date : </strong></td>
                                <td><?php echo date('d-m-Y',strtotime($batch['end_date'])).' (<i>'.date('l',strtotime($batch['end_date'])).'</i>)';?></td>
                                <td colspan="2" align="center">
                                    <?php
                                        //$examDate  = date('d-m-Y',strtotime($batch['end_date']));
                                        //$todayDate = date('d-m-Y');
										
										$examDate  = date('d-m-Y',strtotime($batch['end_date']));
										$examDate = $examDate.' 15:00:00';
										$todayDate = date('d-m-Y H:i:s');
										$todayDateEndExam = date('d-m-Y 16:30:00');
										
                                        if($examDate > $todayDate) 
                                        {
                                            echo '<i class="text-warning">Exam Coming Soon.!!</i>';
                                        } 
                                        elseif($todayDateEndExam < $todayDate) 
                                        {
                                            echo '<i class="text-warning">Exam End.!!</i>';
                                        } 
                                        else 
                                        {
                                            if($batch['eligibility'] == 1) 
                                            {
                                                if($batch['assment_mode'] == 1) 
                                                {
                                                    if($batch['exam_status'] == 0) 
                                                    {
                                                        echo '
                                                        <a href="'.base_url("admin/assessor_exam_corner/online_exam/instructions/".md5($batch['batch_ems_id_pk'])).'" class="btn btn-sm btn-warning">
                                                            Attend Exam 
                                                            <i class="fa fa-file-text" aria-hidden="true"></i></a>
                                                        ';
                                                    }
                                                    else
                                                    {
                                                        // echo '<i class="text-danger">You have all ready attended the exam.!!</i>';
                                                        echo '<i class="text-danger">--</i>';
                                                    }
                                                }
                                                else 
                                                {
                                                    echo '<i class="text-success">All the best for exam.!!</i>';
                                                }
                                            }
                                            else 
                                            {
                                                echo '<i class="text-danger">You are not eligibile for the exam.!!</i>';
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php if($batch['exam_status'] == 1) { ?>
                                <tr><td colspan="4" align="center">
                                    <i class="text-danger">Oops.!! We can't display your result. You abnormally exist the exam.!!</i>
                                </td></tr>
                            <?php } elseif($batch['exam_status'] == 2) {?>
                                <tr><td colspan="4" align="center">Your result will be display soon.!!</td></tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } } else { ?>
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

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
