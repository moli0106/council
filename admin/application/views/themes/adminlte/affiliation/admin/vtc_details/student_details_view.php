
<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Student Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-6 col-md-offset-4">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item" style="margin-left: -8em;">
                        <b>Course of the Year</b><a class="pull-right">Enrolled Student</a>
                    </li>
                    <?php $count = 0; ?>
                    <?php foreach ($studentCountDetails as $key => $value) { ?>
                    <li class="list-group-item" style="margin-left: -8em;">
                        <?php echo ++$count; ?>.
                        <b><?php echo $value['group_name']; ?></b>
                        (<?php echo $value['group_code']; ?>)
                        <a class="pull-right"><?php echo $value['enrolled_student']; ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>