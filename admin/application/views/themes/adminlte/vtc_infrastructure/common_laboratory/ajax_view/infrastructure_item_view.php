<option value="" hidden="true">-- Select Infrastructure Item --</option>

<?php if (!empty($cmnLabData)){?>
    <?php foreach ($item as $key => $value) {?>
        
        <option value="<?php echo $value['infrastructure_item_id_fk'];?>" <?php if($cmnLabData['infrastructure_item_id_fk'] == $value['infrastructure_item_id_fk']){echo 'selected';} ?>> <?php echo $value['item_name'];?></option>
    <?php }?>
<?php }else{?>
    <?php foreach ($item as $key => $value) {?>
        
        <option value="<?php echo $value['infrastructure_item_id_fk'];?>"> <?php echo $value['item_name'];?></option>
    <?php }?>
<?php }?>