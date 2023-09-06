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
        <h1>Student Data List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Data List</li>
        </ol>
    </section>
    <section class="content">
        <?php if (isset($status)) { ?>

        <div class="alert alert-<?php echo $status ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message ?>
        </div>

        <?php } ?>

        <!-- Search Domain by Birendra Singh on 25-02-2021 -->
        <div class="box">

            <!-- END of Search Domain -->
            <div class="box-header with-border">
                <h3 class="box-title">Student data List</h3>
                <!-- <div style="margin-left:1000px">
                <a href="spot_council/student_data_list/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a> </div>

                <div style="margin-left:1000px;"> <a href="spot_council/student_data_list/merit_list_pdf"><button type="button" class="btn btn-info" title="pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button></a>  
                -->

                <!-- </div> -->


                <div class="box-tools pull-right">
                   
                </div>
            </div>
            <br>
            <div class="box-body">
                <?php if (count($student_data_list)) { ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Candidate Name</th>
                            <th>Guardian's Name </th>
                            <th>Course</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $offset + 1;
                            foreach ($student_data_list as $student_data) {
                                //    echo '<pre>'; print_r($vacent_colleges); die;
                            ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $student_data['first_name'] ?> <?php echo $student_data['middle_name'] ?> <?php echo $student_data['last_name'] ?></td>
                            <td><?php echo $student_data['guardian_name'] ?></td>
                            <td><?php echo $student_data['course_name'] ?></td>
                            <td><?php echo $student_data['gender_description'] ?></td>
                            <td class="action_buttons">
                            <?php if($student_data['approve_reject_status'] == '') {?>
                                <button class="btn btn-sm btn-warning approve-reject-modal" data-id="<?php echo md5($student_data['institute_student_details_id_pk'])?>" data-toggle="modal" data-target="#approve-reject-modal" title="Appprove or Reject"><i class="fa fa-level-up" aria-hidden="true"></i>Approve/Reject</button>
                            <?php }elseif($student_data['approve_reject_status'] == 0) {?>
                                <button class="btn btn-sm btn-primary modal-reject-note bg-maroon" data-id="<?php echo md5($student_data['institute_student_details_id_pk'])?>" data-toggle="modal" data-target="#modal-reject-note" title="View Reject Note"><i class="fa fa-eye" aria-hidden="true"></i>Rejected Note</button>
                            <?php }?>
                            </td>
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
    
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<div class="modal modal-info" id="approve-reject-modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Student Approve / Reject</h4>
            </div>
            <div class="modal-body approve-reject-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-info fade" id="modal-reject-note" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Show Rejected Notes</h4>
            </div>
            <div class="modal-body reject-note-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>