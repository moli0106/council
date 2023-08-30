<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation</li>
            <li class="active"><i class="fa fa-align-center"></i>Teachers / Instructor List</li>
        </ol>
    </section>
    <style>
    /* .select2 .select2-container .select2-container--default .select2-container--above .select2-container--focus
    {
        width:100% !important;
    } */
        </style>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Teachers / Instructor List</h3>
                <div class="box-tools pull-right">
                    <?php if ($vtcDetails['final_submit_status'] == 0) { ?>
                        <a href="<?php echo base_url('admin/affiliation/teachers/add'); ?>" class="btn btn-success btn-sm">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add Teacher
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php if (!empty($vtcDetails)) { ?>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <!-- <th>Course</th> -->
                                <th >Teacher Type</th>
                                <th >Subject/Group</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            <?php if (count($teacherList) > 0) { ?>
                                <?php foreach ($teacherList as $key => $value) { ?>
                                    <tr id="<?php echo md5($value['teacher_id_pk']); ?>">
                                        <td><?php echo ++$count; ?>.</td>
                                        <td><?php echo $value['teacher_name']; ?></td>
                                        <td><?php echo $value['mobile_no']; ?></td>
                                        <td><?php echo $value['email_id']; ?></td>
                                        <td>
                                            <?php
                                            if (!empty($value['designation_id_fk'])) {
                                                echo $value['designation_name'];
                                            } else {
                                                echo $value['other_designation'];
                                            }
                                            ?>
                                        </td>
                                        <!-- <td>
                                            <?php
                                            if (!empty($value['group_name'])) {
                                                echo $value['group_name'] . ' [' . $value['group_code'] . ']';
                                            } else {
                                                echo $value['course_name'];
                                            }
                                            ?>
                                        </td> -->

                                        <td>
                                            <?php
                                                switch ($value['teacher_type']) {
                                                    case 1:
                                                        echo 'Teachers for HS-Voc.';
                                                        break;

                                                    case 3:

                                                        echo 'Teachers for Short Term Training (VIII+ / X+ STC)';
                                                        
                                                        break;

                                                    default:
                                                        // echo 'Other teacher for HS Voc / VIII+ / X+ STC';
                                                        break;
                                                }
                                            ?>
                                        </td>

                                        

                                        <td>
                                            <?php if($value['teacher_type'] == 1){

                                                $subject = array();
                                                foreach ($value['assignedSubject'] as $key1 => $sub_val) {
                                                    array_push($subject, $sub_val['subject_name'].' [ '.$sub_val['subject_code'].' ] ');
                                                 
                                                }
                                                 echo implode(' , ',$subject);
                                            }elseif($value['teacher_type'] == 3){

                                                $group = array();
                                                foreach ($value['assignedGroup'] as $key2 => $group_val) {
                                                    array_push($group, $group_val['group_name'].' [ '.$group_val['group_code'].' ] ');
                                                 
                                                }
                                                 echo implode(' , ',$group);
                                            }
                                            ?>
                                        </td>
                                        <td style="width : 14em;">
                                            <a href="<?php echo base_url('admin/affiliation/teachers/detail/' . md5($value['teacher_id_pk'])); ?>" class="btn btn-info btn-sm">
                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </a>
                                            <?php if ($vtcDetails['final_submit_status'] == 0) { ?>
                                                <a href="<?php echo base_url('admin/affiliation/teachers/update/' . md5($value['teacher_id_pk'])); ?>" class="btn btn-success btn-sm">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm deletteVtcTeacher">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            <?php } ?>

                                            <!-- Added By Moli -->

                                            <?php if($value['teacher_type'] == 1){ ?>
                                                <button type="button" class="btn btn-warning btn-sm modal-teacher-subject-map" data-id ="<?php echo $value['teacher_type'];?>" title="select subject" data-toggle="modal" data-target="#modal-teacher-subject-map">
                                                    <i class="fa fa-map" aria-hidden="true"></i> Select Subject
                                                </button>
                                            <?php }elseif($value['teacher_type'] == 3){?>
                                                <button type="button" class="btn btn-warning btn-sm modal-teacher-subject-map" data-id ="<?php echo $value['teacher_type'];?>" title="select group" data-toggle="modal" data-target="#modal-teacher-subject-map">
                                                    <i class="fa fa-map" aria-hidden="true"></i> Select Group
                                                </button>
                                            <?php }?>
                                            <!-- Added By Moli -->
                                            <!-- checking purpose -->

                                                <!-- <button type="button" class="btn btn-danger btn-sm deletteVtcTeacher">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button> -->
                                            <!-- checking purpose -->

                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your Basic Details is not completed yet.
                </div>
            <?php } ?>
        </div>

    </section>
</div>


<div class="modal modal-info fade" id="modal-teacher-subject-map" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Select Subject</h4>
            </div>
            <div class="modal-body teacher-subject-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>