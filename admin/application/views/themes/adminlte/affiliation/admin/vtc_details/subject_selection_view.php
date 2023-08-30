<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Vocational Paper Laboratory</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>

                    <th>Group / Trade</th>
                    <th>Class</th>
                    <th>Subject Category</th>
                    <th>Subject</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                <?php if (count($vtcSubjectList) > 0) { ?>
                <?php foreach ($vtcSubjectList as $key => $value) { ?>
                <tr id="<?php echo md5($value['course_subject_id_pk']); ?>">
                    <td><?php echo ++$count; ?>.</td>

                    <td><?php echo $value['group_name']; ?> [<?php echo $value['group_code']; ?>]</td>
                    <td>
                        <?php if ($value['class_name'] == 1){echo 'XI';}elseif ($value['class_name'] == 2) {
                                                        echo 'XII';
                                                    } ?>
                    </td>
                    <td><?php echo $value['subject_category_name'] ?></td>

                    <td style="width:30%">
                        <?php if (!empty($value['subject'])) {
                            $subject = array();
                            foreach ($value['subject'] as $sub) { 
                                $subject[] = $sub['subject_name'] .' ['.$sub['subject_code'] .']';
                            }
                            echo implode(' , ', $subject);
                            
                        } ?>
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