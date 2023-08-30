<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>CSS-VSE</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> CSS-VSE</li>
            <li><a href="cssvse/cssvse_school"><i class="fa fa-align-center"></i> School List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Details</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>
        <div class="row">

            <!-- Left Menu -->
            <?php $this->load->view($this->config->item('theme_uri') . 'cssvse/admin/school/cssvse_left_menu'); ?>
            <!-- Left Menu -->

            <div class="col-md-9">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student List</h3>
                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <button type="button" class="btn bg-maroon btn-flat btn-sm change-udise-code">Change UDISE Code</button>
                            </div>
                        </div>

                    </div>

                    <div class="box-body no-padding">
                        <div class="pull-right">
                        </div>
                    </div>
                    <input type="hidden" name="school_id_pk" id="schoolId" value="<?php echo $school_id_pk; ?>">

                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Reg. Number</th>
                                    <th>Guardian Name</th>
                                    <th>Date Of Birth</th>
                                    <th>Updated Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                <?php if (count($studentList) > 0) { ?>
                                    <?php foreach ($studentList as $key => $value) { ?>
                                        <tr id="<?php echo md5($value['student_id_pk']); ?>">
                                            <td><input type="checkbox" name="std_id_pk" class="checkStd" value="<?php echo md5($value['student_id_pk']); ?>"> <?php echo ++$count; ?>.</td>
                                            <td><?php echo $value['first_name']; ?> <?php echo $value['middle_name']; ?> <?php echo $value['last_name']; ?></td>
                                            <td><?php echo $value['registration_number']; ?></td>
                                            <td><?php echo $value['guardian_name']; ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($value['date_of_birth']));  ?></td>

                                            <td>
                                                <?php if ($value['updated_by'] != '') { ?>
                                                    <small class="label label-success">Updated</small>
                                                <?php } ?>
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

                <!-- <div class="box-footer no-padding"> -->

            </div>
        </div>



    </section>

</div>

<div class="modal modal-success fade" id="modal-student-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Student Details</h4>
            </div>
            <div class="modal-body student-data-div" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;"></div>
            <div class="modal-footer change-assessor-modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<div class="modal modal-success fade" id="modal-change-udise" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Change UDISE Code</h4>
            </div>
            <div class="modal-body udise-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.change-udise-code', function(e) {

        var schoolId = $('#schoolId').val();
        var isChecked = $('.checkStd').is(':checked');
        if (isChecked == false) {
            Swal.fire('Warning!', 'Oops! Please checked atleast one student.', 'warning');
        } else {

            var stdIdArray = [];
            $.each($("input[name='std_id_pk']:checked"), function() {
                stdIdArray.push($(this).val());
            });
            // alert("My favourite std_id_pk are: " + stdIdArray);
            var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

            $('.udise-data').html(loader);

            $.ajax({
                    url: "cssvse/cssvse_school/openUdiseModal",
                    data: {
                        stdIdArray: stdIdArray,
                        schoolId: schoolId
                    },
                    type: 'GET',
                    dataType: "json",
                })
                .done(function(response) {
                    $('.udise-data').html(response);
                    $('#modal-change-udise').modal('show');
                })
                .fail(function(res) {
                    $('#modal-change-udise').modal('toggle');
                    Swal.fire('Error!', 'Oops! Unable to open modal.', 'error');
                });

        }
    });

    $(document).on('click', '#chng-udise-btn', function(e) {
        var error = 0;

        $(this).closest('form').find('input,textarea,select').each(function() {
            if ($(this).hasClass('required')) {
                if ($(this).val() == '') {
                    $(this).removeClass('green-border');
                    $(this).addClass('red-border');
                    ++error;
                } else {
                    $(this).removeClass('red-border');
                    $(this).addClass('green-border');
                }
            }
        });

        if (error) {
            e.preventDefault();
        }


    });
</script>