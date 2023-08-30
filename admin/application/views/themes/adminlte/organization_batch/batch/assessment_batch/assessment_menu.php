<div class="box box-success">
    <div class="box-body box-profile">
        <ul class="list-group timeline">

            <li class="time-label">
                <span class="bg-green">WBSCTVESD Council Assessment Details Tracking</span>
            </li>

            <li>
                <i class="fa fa-check bg-green"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <span>Batch Details</span>
                    </h3>
                </div>
            </li>

            <li>
                <?php if ($batchDetails['process_id_fk'] >= 7) { ?>
                    <i class="fa fa-check bg-green"></i>
                <?php } else { ?>
                    <i class="fa fa-close bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <span>Batch Assigned to Council</span>
                    </h3>
                </div>
            </li>

            <li>
                <?php if ($batchDetails['process_id_fk'] >= 8) { ?>
                    <i class="fa fa-check bg-green"></i>
                <?php } else { ?>
                    <i class="fa fa-close bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <span>Assessor Assigned</span>
                    </h3>
                </div>
            </li>

            <li>
                <?php if ($batchDetails['process_id_fk'] >= 9) { ?>
                    <i class="fa fa-check bg-green"></i>
                <?php } else { ?>
                    <i class="fa fa-close bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <span>Assessor Approved</span>
                    </h3>
                </div>
            </li>

            <li>
                <?php if ($batchDetails['process_id_fk'] >= 13) { ?>
                    <i class="fa fa-check bg-green"></i>
                <?php } else { ?>
                    <i class="fa fa-close bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <span>Assessment Completed</span>
                    </h3>
                </div>
            </li>

            <li>
                <?php if ($batchDetails['process_id_fk'] >= 14) { ?>
                    <i class="fa fa-check bg-green"></i>
                <?php } else { ?>
                    <i class="fa fa-close bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <span>Marksheet Generated</span>
                    </h3>
                </div>
            </li>

            <li>
                <?php if ($batchDetails['process_id_fk'] >= 15) { ?>
                    <i class="fa fa-check bg-green"></i>
                <?php } else { ?>
                    <i class="fa fa-close bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                    <h3 class="timeline-header">
                        <span>Certificate Generated</span>
                    </h3>
                </div>
            </li>

        </ul>
    </div>
</div>