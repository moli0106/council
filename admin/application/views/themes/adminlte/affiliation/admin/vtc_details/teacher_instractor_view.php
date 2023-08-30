<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Teachers Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <?php if ($vtcDetails['academic_year'] == '2021-22'){?>
                        <th>Course</th>
                    <?php }else{?>
                        <th >Subject/Group</th>
                    <?php }?>
                    <th>Action</th>
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
                    
                    <?php if ($vtcDetails['academic_year'] == '2021-22'){?>
                        <td>
                            <?php
                                if (!empty($value['group_name'])) {
                                    echo $value['group_name'] . ' [' . $value['group_code'] . ']';
                                } else {
                                    echo $value['course_name'];
                                }
                            ?>
                        </td>
                    <?php }else{?>
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
                    <?php }?>
                    <td>
                        <a href="<?php echo base_url('admin/affiliation/vtc/teachers/' . md5($value['teacher_id_pk'])); ?>"
                            class="btn btn-info btn-sm">
                            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                        </a>
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
</div>