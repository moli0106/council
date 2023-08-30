<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Library Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <?php if(!empty($fetch_library)) {?>
            <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL. No.</th>
              <th>Branch / Department</th>
              <th>Books available</th>
              <th>Books issued per student</th>
              <th>Remarks</th>
            </tr>
            <?php $c=1; foreach($fetch_library as $row) {?>
            <tr>
              <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php echo $row['books_available'] ?></td>
              <td><?php echo $row['books_issue'] ?></td>
              <td><?php echo $row['remarks'] ?></td>
            </tr>
          <?php } ?>
            
          </table>
          <?php } ?>
                
            
        </div>
    </div>
    </div>
</div>