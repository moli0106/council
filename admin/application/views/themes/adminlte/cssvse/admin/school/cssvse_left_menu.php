<div class="col-md-3">
    <div class="box box-success">
        <div class="box-header with-border">

            <h3 class="box-title">Pages</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li class="<?php echo $school_active_class; ?>"><a href="<?php echo base_url('admin/cssvse/cssvse_school/school_details/' . $this->uri->segment(4)); ?>"><i class="fa fa-inbox"></i> School Details

                <li class="<?php echo $student_active_class; ?>"><a href="<?php echo base_url('admin/cssvse/cssvse_school/student_list/' . $school_id_pk); ?>"><i class="fa fa-users"></i> Student List</a></li>
            </ul>
        </div>
    </div>
</div>