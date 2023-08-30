<option value="" hidden="true">-- Select Discipline --</option>

<?php if (!empty($course)){?>
    <?php foreach ($disciplineList as $key => $value) {?>
        
        <option value="<?php echo $value['discipline_id_pk'];?>" <?php if($course['discipline_id_fk'] == $value['discipline_id_pk']){echo 'selected';} ?>> <?php echo $value['discipline_name'];?></option>
    <?php }?>
<?php }else{?>
    <?php foreach ($disciplineList as $key => $value) {?>
        
        <option value="<?php echo $value['discipline_id_pk'];?>" <?php echo set_select('discipline', $value['discipline_id_pk']) ?>> <?php echo $value['discipline_name'];?></option>
    <?php }?>
<?php }?>