<option value="" hidden="true">-- Select Subject Category --</option>

<?php if (!empty($course)){?>
    <?php foreach ($subCategory as $key => $value) {?>
        
        <option value="<?php echo $value['subject_category_id_pk'];?>" <?php if($course['subject_category_id_fk'] == $value['subject_category_id_pk']){echo 'selected';} ?>> <?php echo $value['subject_category_name'];?></option>
    <?php }?>
<?php }else{?>
    <?php foreach ($subCategory as $key => $value) {?>
        
        <option value="<?php echo $value['subject_category_id_pk'];?>"> <?php echo $value['subject_category_name'];?></option>
    <?php }?>
<?php }?>