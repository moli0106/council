<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Intake Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-xs-12 table-responsive">
        <?php if(!empty($intake_data)) {?>
            <table class="table table-hover">
            <tr class="bg-primary">
              <th>SL No.</th>
              <th>Branch / Department</th>
              <th>Shift</th>
              <th>Approved Intake</th>
              <th>No of Regular Faculties</th>
              <th>Remarks</th>
              <th>Action</th>
            </tr>
            <?php $c=1; foreach($intake_data as $row) {?>
            <tr>
            <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php if ($row['shift'] == 1){echo '1st Shift';}else{echo '2nd Shift';} ?></td>
              <td><?php echo $row['intake_no'] ?></td>
              <td><?php echo $row['faculty'] ?></td>
              <td><?php echo $row['remarks'] ?></td>
              <td><a class="btn btn-danger btn-sm" href="polytechnic_affiliation/affiliation/delete/1/<?php echo md5($affiliation_data['basic_affiliation_id_pk']) ?>/<?php echo md5($row['class_details_id_pk']) ?>"><i class="fa fa-trash"> Delete</i></a></td>
            </tr>
            <?php }?>
            </table>
          <?php  }?>
        </div>
    </div>
    </div>
</div>