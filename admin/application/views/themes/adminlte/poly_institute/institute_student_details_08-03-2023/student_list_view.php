<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Student Details</h3>
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
                    <th>Aadhar No</th>
                    <th>Date of Birth</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                <?php if (count($studentUnderInstitute) > 0) { ?>
                <?php  foreach ($studentUnderInstitute as $key => $value) { ?>
                <tr>
                    <td><?php echo ++$count; ?>.</td>
                    <td><?php echo $value['first_name']; ?> <?php echo $value['middle_name']; ?> <?php echo $value['last_name']; ?></td>
                    <td><?php echo $value['mobile_number']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td><?php echo $value['aadhar_no']; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($value['date_of_birth'])); ?></td>
                   <!--  <td><a class="btn btn-info btn-xm" title = Details href="<?php  echo base_url('admin/poly_institute/institute_list/student_own_details/'.md5($value['institute_student_details_id_pk'])); ?>" > <i class="fa fa-folder-open-o" aria-hidden="true"></i></a></td> -->
                   
                </tr>
                <?php  } ?>
                <?php } else { ?>
                <tr>
                    <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>