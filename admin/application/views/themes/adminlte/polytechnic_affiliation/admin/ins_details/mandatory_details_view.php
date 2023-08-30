<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Mandatory Requirements</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-xs-12 table-responsive">
        <?php if(!empty($fetch_mandory_data)) {?>
            <table class="table table-bordered">
              <tr class="bg-primary">
                <th>SL. No</th>
                <th>Facilities</th>
                <th>Availability (Yes/No) *</th>
                <th>Size / Number (as applicable)</th>
              </tr>
        
                <?php $c=1; foreach($fetch_mandory_data as $row){ ?>
                <tr>
                <td><?php echo $c++; ?></td>
                <td><?php echo $row['facilities_name']; ?> <input type="hidden" name="mand_req[]" value="<?php echo $row['fc_id_fk']; ?>">
                </td>
                <td>
                  <select name="req_status[]" class="form-control required" required>
                    <option value="<?php echo $row['availability']; ?>"><?php echo $row['availability']; ?></option>
                    <option value="">-Select-</option>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                  </select>
                </td>
                <td>
                  <input type="text" name="req_details[]" class="form-control" value="<?php echo $row['size']; ?>" placeholder="Size/Number/Details" maxlength="60">
                </td>
              </tr>
              <?php } ?>

            </table>
          <?php }else {?>

            
            <table class="table table-bordered">
              <tr class="bg-primary">
                <th>SL. No</th>
                <th>Facilities</th>
                <th>Availability (Yes/No) *</th>
                <th>Size / Number (as applicable)</th>
              </tr>
        
                <?php $c=1; foreach($mandory_data as $row){ ?>
                <tr>
                <td><?php echo $c++; ?></td>
                <td><?php echo $row['facilities_name']; ?> <input type="hidden" name="mand_req[]" value="<?php echo $row['fc_id_pk']; ?>">
                </td>
                <td>
                  <select name="req_status[]" class="form-control required" required>
                    <option value="">-Select-</option>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                  </select>
                </td>
                <td>
                  <input type="text" name="req_details[]" class="form-control" value="" placeholder="Size/Number/Details" maxlength="60">
                </td>
              </tr>
              <?php } ?>

            </table>
          <?php } ?>
                
            
        </div>
    </div>
    </div>
</div>