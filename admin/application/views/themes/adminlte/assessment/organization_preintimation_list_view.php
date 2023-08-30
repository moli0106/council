<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<?php
function response_status_color($id = NULL)
{
    switch ($id) {
        case 1:
            echo "bg-teal";
            break;
        case 2:
            echo "bg-fuchsia";
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
            echo "bg-olive";
            break;
        case 8:
            echo "bg-orange";
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
<style>
    .list-group-item {
        padding: 5px 8px !important;
    }

    .modal-lg {
        width: 80% !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Pre-Intimation Batch List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Pre-Intimation List</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <!-- <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Search Filters</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/assessment/preintimation'); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Sector</b></label>
                            <select name="sector_code" id="sector_code" class="form-control select2">
                                <option value="" hiddden="true">Select Sector</option>
                                <?php foreach ($sector_list as $key => $sector) { ?>
                                    <option value="<?php echo $sector['sector_code']; ?>" <?php if ($this->input->post('sector_code') == $sector['sector_code']) echo "selected"; ?>>
                                        <?php echo $sector['sector_name']; ?> [<?php echo $sector['sector_code']; ?>]
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Course</b></label>
                            <select name="course_code" id="course_code" class="form-control select2">
                                <option value="" hiddden="true">Select Course</option>
                                <option value="" disabled="true">Select Sector first...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <label></label><br>
                        <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div> -->

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List of Other Assessment Pre-Intimated Batch</h3>
                <div class="box-tools pull-right">
					<!-- <a href="assessment/preintimation/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a> -->
				</div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <!-- <tr>
                            <th>#</th>
                            <th>Batch Basic Details</th>
                            <th>Other Details</th>
                        </tr> -->
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($preintimation_list)) {
                            $i = $offset;
                            foreach ($preintimation_list as $key => $preintimation) { ?>

                                <tr id="<?php echo md5($preintimation['batch_id_pk']); ?>">
                                    <td><?php echo ++$i; ?>.</td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item list-group-item-success">
                                                <strong>Batch Details</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Vertical Code : </strong>
                                                <?php echo $preintimation['vertical_code']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Vertical Name : </strong>
                                                <?php echo $preintimation['vertical_code']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Assessment Scheme Name : </strong>
                                                <?php echo $preintimation['assessment_scheme_name']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Batch Code : </strong>
                                                <?php echo $preintimation['user_batch_id']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>TC Name : </strong>
                                                <?php echo $preintimation['tc_user_name']; ?>
                                                <!-- [<?php echo $preintimation['tc_user_id']; ?>] -->
                                            </li>
                                            <li class="list-group-item">
                                                <strong>TC Email / Mobile : </strong>
                                                <?php echo $preintimation['email']; ?>
                                                [ <?php echo $preintimation['mobile']; ?> ]
                                            </li>
                                            <li class="list-group-item">
                                                <strong>TC State / District : </strong>
                                                <?php echo $preintimation['state_name']; ?>
                                                [ <?php echo $preintimation['district_name']; ?> ]
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item list-group-item-success">
                                                <strong>Other Details</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Sector Name : </strong>
                                                <?php echo $preintimation['sector_name']; ?>
                                                [ <?php echo $preintimation['sector_code']; ?> ]
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Course Name : </strong>
                                                <?php echo $preintimation['course_name']; ?>
                                                [ <?php echo $preintimation['course_code']; ?> ]
                                            </li>
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Trainee Count : </strong>
                                                <?php echo $preintimation['batch_size']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Start Date : </strong>
                                                <?php echo date('d-m-Y', strtotime($preintimation['batch_start_date'])); ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> End Date : </strong>
                                                <?php echo date('d-m-Y', strtotime($preintimation['batch_end_date'])); ?>
                                            </li>
                                            <!-- <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Tentative Assessment Date : </strong>
                                                <?php echo date('d-m-Y', strtotime($preintimation['batch_tentative_assessment_date'])); ?>
                                            </li> -->
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Pre-Intimation Request Date : </strong>
                                                <?php echo date('d-m-Y h:i:s A', strtotime($preintimation['entry_time'])); ?>
                                            </li>
                                            <!-- <li class="list-group-item">
                                                <strong>Assessment Status : </strong>
                                                <span class="badge <?php echo response_status_color($preintimation['process_id_fk']); ?>">
                                                    <?php echo $preintimation['process_name']; ?>
                                                </span>
                                            </li> -->
                                        </ul>
                                    </td>
                                </tr>

                            <?php }
                        } else { ?>

                            <tr>
                                <td colspan="4" align="center" class="text-danger">No Data Found...</td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<script>
    $(document).ready(function() {
        $(document).on('change', '#sector_code', function(e) {

            var sector_code = $(this).val();

            $.ajax({
                    url: "assessment/preintimation/getCourseBySector",
                    type: 'GET',
                    dataType: "json",
                    data: {
                        "sector_code": sector_code
                    }
                })
                .done(function(response) {
                    $('#course_code').html(response);
                })
                .fail(function(res) {
                    Swal.fire('Warning!', 'Oops! Unable to get course.', 'warning');
                });
        });
    });
</script>