<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Available Laboratories</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <?php if(!empty($fetch_lab)) {?>
            <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL. No.</th>
              <th>Branch / Department</th>
              <th>Laboratories Available</th>
              <th>No. of experimental Set-up</th>
              <th>Remarks</th>
            </tr>
            <?php $c=1; foreach($fetch_lab as $row) {?>
            <tr>
              <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php echo $row['available_lab'] ?></td>
              <td><?php echo $row['exp_setup'] ?></td>
              <td><?php echo $row['remarks'] ?></td>
            </tr>
          <?php } ?>
            
          </table>
          <?php } ?>
                
            
        </div>
    </div>
    </div>
</div>