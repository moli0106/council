<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Intake Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <?php if(!empty($fetch_room)) {?>
                <table class="table table-bordered">
                    <tr class="bg-primary">
                    <th>SL. No.</th>
                    <th>Branch / Department</th>
                    <th>No of Rooms</th>
                    <th>Seating Capacity</th>
                    <th>Size</th>
                    <th>Remarks</th>
                    </tr>
                    <?php $c=1; foreach($fetch_room as $row) {?>
                    <tr>
                    <td><?php echo $c++; ?></td>
                    <td><?php echo $row['discipline_name'] ?></td>
                    <td><?php echo $row['total_rooms'] ?></td>
                    <td><?php echo $row['seat'] ?></td>
                    <td><?php echo $row['size'] ?></td>
                    <td><?php echo $row['remarks'] ?></td>
                    
                    </tr>
                    <?php }?>
                </table>
            <?php } ?>
                
            
        </div>
    </div>
    </div>
</div>