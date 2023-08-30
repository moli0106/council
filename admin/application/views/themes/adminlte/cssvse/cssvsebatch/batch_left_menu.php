<?php
function response_status_color($id = NULL)
{
    switch ($id) {
        case 1:
            echo "bg-orange";
            break;
        case 2:
            echo "bg-teal";
            break;
        case 3:
            echo "bg-maroon";
            break;
        case 4:
            echo "bg-aqua";
            break;
        case 5:
            echo "bg-navy";
            break;
        case 6:
            echo "bg-yellow";
            break;
        case 7:
            echo "bg-fuchsia";
            break;
        case 8:
            echo "bg-aqua";
            break;
        case 9:
            echo "bg-green";
            break;
        case 10:
            echo "bg-red";
            break;
        case 11:
            echo "bg-olive";
            break;
        case 12:
            echo "bg-teal";
            break;
        default:
            echo NULL;
    }
}
?>

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
                <li class="<?php if (isset($batch_active_class)) {echo $batch_active_class;}?>"><a href="<?php echo base_url('admin/cssvsebatch/batch/batch_details/' . $this->uri->segment(4)); ?>"><i class="fa fa-inbox"></i> Batch Details

                <li class="<?php if (isset($std_active_class)) {echo $std_active_class;}?>"><a href="<?php echo base_url('admin/cssvsebatch/batch/std_list/' . $this->uri->segment(4)); ?>"><i class="fa fa-users"></i> Student List</a></li>
            </ul>
        </div>
    </div>
</div>