<option value="" hidden="true">-- Select Subject Name --</option>

<?php if (!empty($course)){?>
    <?php foreach ($subjectName as $key => $value) {?>
        
        <option value="<?php echo $value['subject_name_id_pk'];?>" <?php if (in_array($value['subject_name_id_pk'], $subjectArray)) {echo 'selected';} ?>> 
            <?php echo $value['subject_name'];?> [<?php echo $value['subject_code'];?>]
        </option>
    <?php }?>
<?php }else{?>
    <?php foreach ($subjectName as $key => $value) {?>
        
        <option value="<?php echo $value['subject_name_id_pk'];?>"> 
            <?php echo $value['subject_name'];?> [<?php echo $value['subject_code'];?>]
        </option>
    <?php }?>
<?php }?>