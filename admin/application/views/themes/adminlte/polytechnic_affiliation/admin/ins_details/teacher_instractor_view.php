<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Intake Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <?php if(!empty($teacher_data)) {?>
                <table class="table table-hover">
                <tr class="bg-primary">
                <th>SL No.</th>
                <th>Branch / Department</th>
                <th>Name of Teachers</th>
                <th>Mobile No</th>
                </tr>
                <?php $c=1; foreach($teacher_data as $row) {?>
                <tr>
                <td><?php echo $c++; ?></td>
                <td><?php echo $row['discipline_name'] ?></td>
                <td><?php echo $row['teacher_name'] ?></td>
                <td><?php echo $row['teacher_mobile'] ?></td>
                </tr>
                <?php }?>
                </table>
          <?php  }?>
        </div>
    </div>
    </div>
</div>