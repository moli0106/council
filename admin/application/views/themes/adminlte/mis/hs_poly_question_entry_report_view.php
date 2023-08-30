<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Bank Report</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Question Bank Report</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Question Bank Report</h3>
				<div class="pull-right">
					<label for="inputtp">&nbsp;</label><br>
					<a href="mis/hs_poly_question_entry_report/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a>
				</div>
            </div>
           
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Course</th>
                            <th>Semester</th>
                            <th>Discipline</th>
                            <th>Group/Trade Name (Code)</th>
                            <th>Subject Category</th>
                            <th>Subject (Code)</th>
                            <th>Question Creator name</th>
                            <th>Email id</th>
                            <th>Mobile no</th>
                            <th>No of New question</th>
                            <th>Question submitted</th>
							<th>Question approved</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($question_bank))
                            {?>
                        <?php $i = 1; foreach($question_bank as $question){ ?>
                        <tr>
                            <td><?php echo $offset + $i; ?></td>
                            <td><?php echo strtoupper($question['course_name']) ?></td>
                            <td><?php echo $question['semester_name'] ?></td>
                            <td><?php echo $question['discipline_name'] ?></td>
                            <td><?php if($question['group_trade_code']!='') {?><?php echo $question['group_trade_name'] ?> [<?php echo $question['group_trade_code'] ?>]<?php }?></td>
                            <td><?php echo $question['subject_category_name'] ?></td>
                            <td><?php if($question['subject_name']!='') {?><?php echo $question['subject_name']; ?> [<?php echo $question['subject_code']; ?>]<?php }?></td>
                            <td><?php echo $question['qc_name'] ?></td>
                            <td><?php echo $question['email_id'] ?></td>
                            <td><?php echo $question['mobile_no'] ?></td>
							<td><?php echo $question['new_question'] ?></td>
							<td><?php echo $question['question_set_submitted'] ?></td>
							<td><?php echo $question['question_set_approved'] ?></td>
                            
                        </tr>

                        <?php $i++;  } ?>
                   <?php } else { ?>
                    <tr>
                        <td colspan="13" align="center" class="text-danger">No Data Found...</td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div id="myModalList" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-info">Sector & Job Role List</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Sector</th>
                            <th>Job Role</th>
                        </tr>
                    </thead>
                    <tbody id="sectorJobRoleList">
                        <tr>
                            <td colspan="3" align="center">Please wait a moment...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>

    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>