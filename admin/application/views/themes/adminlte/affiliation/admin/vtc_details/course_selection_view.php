<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>
<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Course Selection</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <div class="row">
            <?php if (!empty($vtcCourseList) || !empty($vtcNewCourseList)) { ?>
            <?php if (!empty($vtcNewCourseList)) { ?>

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Discipline</th>
                        <th>Group / Trade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; ?>
                        <?php if (count($vtcNewCourseList) > 0) { ?>
                            <?php foreach ($vtcNewCourseList as $key => $value) { ?>
                                <tr id="<?php echo md5($value['vtc_course_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['course_name']; ?></td>
                                    <td><?php echo $value['discipline_name']; ?></td>
                                    <td>
                                        <?php if (!empty($value['group'])) {
                                            $group_name = array();
                                            foreach ($value['group'] as $group) { 
                                                $group_name[] = $group['group_name'] .' ['.$group['group_code'] .']';
                                            }
                                            echo implode(' , ', $group_name);
                                            
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
                <?php }elseif (!empty($vtcCourseList)) {?>
                    <div class="col-md-10 col-md-offset-1">
                        <?php if (isset($hsDiscipline)) { ?>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i> HS-Voc</strong>
                            <p class="text-muted">Discipline:</p>
                            <p>
                                <?php foreach ($hsDiscipline as $key => $value) { ?>
                                    <span class="label <?php echo $label1[$key]; ?>"><?php echo $value['discipline_name']; ?></span>
                                <?php } ?>
                            </p>
                            <p class="text-muted">Course List:</p>
                            <?php foreach ($hsCourseList as $key => $value) { ?>
                                <span class="label <?php echo $label2[$key]; ?>"><?php echo $value['group_name']; ?>(<?php echo $value['group_code']; ?>)</span>
                            <?php } ?>
                        <?php } ?>
                        <hr>
                        <?php if (isset($stcDiscipline)) { ?>
                            <strong><i class="fa fa-book margin-r-5"></i> VIII+ STC</strong>
                            <p class="text-muted">Discipline:</p>
                            <p>
                                <?php foreach ($stcDiscipline as $key => $value) { ?>
                                    <span class="label <?php echo $label1[$key]; ?>"><?php echo $value['discipline_name']; ?></span>
                                <?php } ?>
                            </p>
                            <p class="text-muted">Course List:</p>
                            <?php foreach ($stcCourseList as $key => $value) { ?>
                                <span class="label <?php echo $label2[$key]; ?>"><?php echo $value['group_name']; ?>(<?php echo $value['group_code']; ?>)</span>
                            <?php } ?>
                            <hr>
                        <?php } ?>
                    </div>
                <?php }?>
            <?php } else { ?>
            <div class="col-md-10 col-md-offset-1">
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your Courses is not added for academic year <span
                        class="label label-success"><?php echo $academic_year; ?></span>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
