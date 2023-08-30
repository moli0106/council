<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Aassessor Result</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-users"></i> Assessor Result</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Assessor Result List</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#passAssessorList" data-toggle="tab">Pass Assessor List</a></li>
                                <li><a href="#failAssessorList" data-toggle="tab">Fail Assessor List</a></li>
                                <li><a href="#empanelledAssessorList" data-toggle="tab">Empanelled Assessor List</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="passAssessorList">
                                    <table class="table table-hover">
                                        <tbody>
                                            <?php if (count($assessor_list)) { ?>
                                                <?php $i = $offset; ?>
                                                <?php foreach ($assessor_list as $key1 => $assessor) { ?>

                                                    <?php if ((!empty($assessor['exam_details']['domain'])) && (!empty($assessor['exam_details']['platform']))) { ?>
                                                        <?php foreach ($assessor['exam_details']['domain'] as $key2 => $domain) { ?>

                                                            <?php
                                                            $domain_marks   = $domain['marks'];
                                                            $platform_marks = $assessor['exam_details']['platform']['marks'];
                                                            $con_eval_marks = $assessor['exam_details']['platform']['con_eval_marks'];

                                                            if (($domain_marks >= 50) && ($platform_marks >= 50) && ($con_eval_marks >= 25)) {

                                                                $ready_for_empanelled = 1;
                                                                $ul_li_class = 'list-group-item-success'; ?>

                                                                <?php if ($domain['empanelled_id_pk'] == NULL) { ?>
                                                                    <tr id="<?php echo md5($domain['batch_assessor_map_id_pk']); ?>">
                                                                        <td><?php echo ++$i; ?>.</td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                                                    <strong>Assessor Details</strong>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Assessor Name : </strong>
                                                                                    <?php echo $assessor['fname'] . ' ' . $assessor['mname'] . ' ' . $assessor['lname']; ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Assessor Mobile : </strong>
                                                                                    <?php echo $assessor['mobile_no']; ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Assessor Email : </strong>
                                                                                    <?php echo $assessor['email_id']; ?>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                                                    <strong>Marks Details</strong>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Domain Marks : </strong>
                                                                                    <?php echo $domain_marks; ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Platform Marks : </strong>
                                                                                    <?php echo $platform_marks; ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Continuous Evaluation Marks : </strong>
                                                                                    <?php echo $con_eval_marks; ?>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                                                    <strong>Course Details</strong>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Job Role : </strong>
                                                                                    <?php echo $domain['sector_name']; ?>
                                                                                    [<?php echo $domain['sector_code']; ?>]
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Course Name : </strong>
                                                                                    <?php echo $domain['course_name']; ?>
                                                                                    [<?php echo $domain['course_code']; ?>]
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-xs btn-success assessor-empanelled" data-date="<?php echo $domain['batch_exam_date']; ?>,	<?php echo $assessor['exam_details']['platform']['batch_exam_date']; ?>">
                                                                                Empanell
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>

                                                        <?php }
                                                        } ?>
                                                    <?php } ?>

                                                <?php } ?>
                                            <?php } else { ?>

                                                <tr>
                                                    <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                                                </tr>

                                            <?php }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-center"><?php //echo $page_links; 
                                                                                    ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane" id="failAssessorList">
                                    <table class="table table-hover">
                                        <tbody>
                                            <?php if (count($assessor_list)) { ?>
                                                <?php $i = $offset; ?>
                                                <?php foreach ($assessor_list as $key1 => $assessor) { ?>

                                                    <?php if ((!empty($assessor['exam_details']['domain'])) && (!empty($assessor['exam_details']['platform']))) { ?>
                                                        <?php foreach ($assessor['exam_details']['domain'] as $key2 => $domain) { ?>

                                                            <?php
                                                            $domain_marks   = $domain['marks'];
                                                            $platform_marks = $assessor['exam_details']['platform']['marks'];
                                                            $con_eval_marks = $assessor['exam_details']['platform']['con_eval_marks'];

                                                            if (($domain_marks >= 50) && ($platform_marks >= 50) && ($con_eval_marks >= 25)) {

                                                                $ready_for_empanelled = 1;
                                                                $ul_li_class = 'list-group-item-success';
                                                            } else {

                                                                $ready_for_empanelled = 0;
                                                                $ul_li_class = 'list-group-item-danger'; ?>

                                                                <tr id="<?php echo md5($domain['batch_assessor_map_id_pk']); ?>">
                                                                    <td><?php echo ++$i; ?>.</td>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                                                <strong>Assessor Details</strong>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <strong>Assessor Name : </strong>
                                                                                <?php echo $assessor['fname'] . ' ' . $assessor['mname'] . ' ' . $assessor['lname']; ?>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <strong>Assessor Mobile : </strong>
                                                                                <?php echo $assessor['mobile_no']; ?>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <strong>Assessor Email : </strong>
                                                                                <?php echo $assessor['email_id']; ?>
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                                                <strong>Marks Details</strong>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <strong>Domain Marks : </strong>
                                                                                <?php echo $domain_marks; ?>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <strong>Platform Marks : </strong>
                                                                                <?php echo $platform_marks; ?>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <strong>Continuous Evaluation Marks : </strong>
                                                                                <?php echo $con_eval_marks; ?>
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                                                <strong>Course Details</strong>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <strong>Job Role : </strong>
                                                                                <?php echo $domain['sector_name']; ?>
                                                                                [<?php echo $domain['sector_code']; ?>]
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <strong>Course Name : </strong>
                                                                                <?php echo $domain['course_name']; ?>
                                                                                [<?php echo $domain['course_code']; ?>]
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($domain['empanelled_id_pk'] != NULL) { ?>
                                                                        <?php } elseif ($ready_for_empanelled) { ?>
                                                                            <button type="button" class="btn btn-xs btn-success assessor-empanelled" data-date="<?php echo $domain['batch_exam_date']; ?>,	<?php echo $assessor['exam_details']['platform']['batch_exam_date']; ?>">
                                                                                Empanell
                                                                            </button>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>

                                                            <?php } ?>

                                                        <?php } ?>
                                                    <?php } ?>

                                                <?php } ?>
                                            <?php } else { ?>

                                                <tr>
                                                    <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                                                </tr>

                                            <?php }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-center"><?php //echo $page_links; 
                                                                                    ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="tab-pane" id="empanelledAssessorList">
                                    <table class="table table-hover">
                                        <tbody>
                                            <?php if (count($assessor_list)) { ?>
                                                <?php $i = $offset; ?>
                                                <?php foreach ($assessor_list as $key1 => $assessor) { ?>

                                                    <?php if ((!empty($assessor['exam_details']['domain'])) && (!empty($assessor['exam_details']['platform']))) { ?>
                                                        <?php foreach ($assessor['exam_details']['domain'] as $key2 => $domain) { ?>

                                                            <?php
                                                            $domain_marks   = $domain['marks'];
                                                            $platform_marks = $assessor['exam_details']['platform']['marks'];
                                                            $con_eval_marks = $assessor['exam_details']['platform']['con_eval_marks'];

                                                            if (($domain_marks >= 50) && ($platform_marks >= 50) && ($con_eval_marks >= 25)) {

                                                                $ready_for_empanelled = 1;
                                                                $ul_li_class = 'list-group-item-success'; ?>

                                                                <?php if ($domain['empanelled_id_pk'] != NULL) { ?>
                                                                    <tr id="<?php echo md5($domain['batch_assessor_map_id_pk']); ?>">
                                                                        <td><?php echo ++$i; ?>.</td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                                                    <strong>Assessor Details</strong>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Assessor Name : </strong>
                                                                                    <?php echo $assessor['fname'] . ' ' . $assessor['mname'] . ' ' . $assessor['lname']; ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Assessor Mobile : </strong>
                                                                                    <?php echo $assessor['mobile_no']; ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Assessor Email : </strong>
                                                                                    <?php echo $assessor['email_id']; ?>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                                                    <strong>Marks Details</strong>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Domain Marks : </strong>
                                                                                    <?php echo $domain_marks; ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Platform Marks : </strong>
                                                                                    <?php echo $platform_marks; ?>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Continuous Evaluation Marks : </strong>
                                                                                    <?php echo $con_eval_marks; ?>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                        <td>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                                                    <strong>Course Details</strong>
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Job Role : </strong>
                                                                                    <?php echo $domain['sector_name']; ?>
                                                                                    [<?php echo $domain['sector_code']; ?>]
                                                                                </li>
                                                                                <li class="list-group-item">
                                                                                    <strong>Course Name : </strong>
                                                                                    <?php echo $domain['course_name']; ?>
                                                                                    [<?php echo $domain['course_code']; ?>]
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>
                                                                <?php } ?>

                                                        <?php }
                                                        } ?>
                                                    <?php } ?>

                                                <?php } ?>
                                            <?php } else { ?>

                                                <tr>
                                                    <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                                                </tr>

                                            <?php }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-center"><?php //echo $page_links; 
                                                                                    ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- <table class="table table-hover">
            <tbody>
                <?php if (count($assessor_list)) { ?>
                    <?php $i = $offset; ?>
                    <?php foreach ($assessor_list as $key1 => $assessor) { ?>

                        <?php if ((!empty($assessor['exam_details']['domain'])) && (!empty($assessor['exam_details']['platform']))) { ?>
                            <?php foreach ($assessor['exam_details']['domain'] as $key2 => $domain) { ?>

                                <?php
                                $domain_marks   = $domain['marks'];
                                $platform_marks = $assessor['exam_details']['platform']['marks'];
                                $con_eval_marks = $assessor['exam_details']['platform']['con_eval_marks'];

                                if (($domain_marks >= 50) && ($platform_marks >= 50) && ($con_eval_marks >= 25)) {

                                    $ready_for_empanelled = 1;
                                    $ul_li_class = 'list-group-item-success';
                                } else {

                                    $ready_for_empanelled = 0;
                                    $ul_li_class = 'list-group-item-danger';
                                }
                                ?>

                                <tr id="<?php echo md5($domain['batch_assessor_map_id_pk']); ?>">
                                    <td><?php echo ++$i; ?>.</td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                <strong>Assessor Details</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Assessor Name : </strong>
                                                <?php echo $assessor['fname'] . ' ' . $assessor['mname'] . ' ' . $assessor['lname']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Assessor Mobile : </strong>
                                                <?php echo $assessor['mobile_no']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Assessor Email : </strong>
                                                <?php echo $assessor['email_id']; ?>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                <strong>Marks Details</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Domain Marks : </strong>
                                                <?php echo $domain_marks; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Platform Marks : </strong>
                                                <?php echo $platform_marks; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Continuous Evaluation Marks : </strong>
                                                <?php echo $con_eval_marks; ?>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item <?php echo $ul_li_class; ?>">
                                                <strong>Course Details</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Job Role : </strong>
                                                <?php echo $domain['sector_name']; ?>
                                                [<?php echo $domain['sector_code']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Course Name : </strong>
                                                <?php echo $domain['course_name']; ?>
                                                [<?php echo $domain['course_code']; ?>]
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <?php if ($domain['empanelled_id_pk'] != NULL) { ?>
                                        <?php } elseif ($ready_for_empanelled) { ?>
                                            <button type="button" class="btn btn-xs btn-success assessor-empanelled" data-date="<?php echo $domain['batch_exam_date']; ?>,	<?php echo $assessor['exam_details']['platform']['batch_exam_date']; ?>">
                                                Empanell
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>

                            <?php } ?>
                        <?php } ?>

                    <?php } ?>
                <?php } else { ?>

                    <tr>
                        <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                    </tr>

                <?php }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-center"><?php //echo $page_links; 
                                                        ?></td>
                </tr>
            </tfoot>
        </table> -->

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>