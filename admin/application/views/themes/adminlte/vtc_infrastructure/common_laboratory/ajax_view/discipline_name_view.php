<option value="" hidden="true">-- Select Subject Name --</option>

<?php if (!empty($cmnLabData)){?>
    <?php foreach ($discipline as $key => $value) {?>
        
        <option value="<?php echo $value['discipline_id_pk'];?>" <?php if($cmnLabData['course_name_id_fk'] == $value['discipline_id_pk']){echo 'selected';} ?>> <?php echo $value['discipline_name'];?></option>
    <?php }?>
<?php }else{ //echo $this->input->method(TRUE);exit;?>

    <?php foreach ($discipline as $key => $value) {?>
        
        <option value="<?php echo $value['discipline_id_pk'];?>" <?php echo set_select('discipline_id', $value['discipline_id_pk'])?>> <?php echo $value['discipline_name'];?></option>
    <?php }?>
<?php }?>