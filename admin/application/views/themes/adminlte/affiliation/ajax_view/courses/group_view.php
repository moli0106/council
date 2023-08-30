<option value="" disabled>-- Select Group/Trade --</option>

<?php if($courseName == 1){?>

    <?php if (!empty($course)){?>
        <?php foreach ($groupList as $key => $value) {?>
            
            <option value="<?php echo $value['course_id_pk'];?>" <?php if($course['group_id_fk'] == $value['course_id_pk']){echo 'selected';} ?>> 
                <?php echo $value['group_name']?> [<?php echo $value['group_code']?>]
            </option>
        <?php }?>
    <?php }else{?>

        <?php foreach ($groupList as $key => $value) {?>
            
            <option value="<?php echo $value['course_id_pk']?>">
                <?php echo $value['group_name']?> [<?php echo $value['group_code']?>]
            </option>
        <?php }
    }?>

<?php }elseif ($courseName == 4) { ?>
        
    

    <optgroup label="Courses from NQR" data-select2-id="select2-data-nqr">

        <?php if (count($nqrCourseList) > 0) {

            
            if (!empty($course)){

                foreach ($nqrCourseList as $key => $value) {?>
                
                    <option value="<?php echo $value['course_id_pk']?>" <?php if($course['group_id_fk'] == $value['course_id_pk']){echo 'selected';} ?>>
                        <?php echo $value['group_name']?> [<?php echo $value['group_code']?>]
                    </option>

                <?php }
            }else{

                foreach ($nqrCourseList as $key => $value) {?>
                    
                    <option value="<?php echo $value['course_id_pk']?>">
                        <?php echo $value['group_name']?> [<?php echo $value['group_code']?>]
                    </option>
                
                <?php }
            }
        }else{?>
            <option value="" disabled="true">No data found...</option>
        <?php }?>
    </optgroup>


    <optgroup label="Courses from NSQF Aligned" data-select2-id="select2-data-nsqf">
        <?php if (count($nsqfCourseList) > 0) {
            if (!empty($course)){

                foreach ($nsqfCourseList as $key => $value) {?>
                
                    <option value="<?php echo $value['course_id_pk']?>" <?php if($course['group_id_fk'] == $value['course_id_pk']){echo 'selected';} ?>>
                        <?php echo $value['group_name']?> [<?php echo $value['group_code']?>]
                    </option>

                <?php }
            }else{

                foreach ($nsqfCourseList as $key => $value) {?>
                    
                    <option value="<?php echo $value['course_id_pk']?>">
                        <?php echo $value['group_name']?> [<?php echo $value['group_code']?>]
                    </option>
                
                <?php }
            }
        }else{?>
            <option value="" disabled="true">No data found...</option>
        <?php }?>
    </optgroup>

    <optgroup label="Courses from STC Other" data-select2-id="select2-data-nsqf">
        <?php if (count($viiXCourseList) > 0) {

            if (!empty($course)){

                foreach ($viiXCourseList as $key => $value) {?>
                
                    <option value="<?php echo $value['course_id_pk']?>" <?php if($course['group_id_fk'] == $value['course_id_pk']){echo 'selected';} ?>>
                        <?php echo $value['group_name']?> [<?php echo $value['group_code']?>]
                    </option>

                <?php }
            }else{

                foreach ($viiXCourseList as $key => $value) {?>
                    
                    <option value="<?php echo $value['course_id_pk']?>">
                        <?php echo $value['group_name']?> [<?php echo $value['group_code']?>]
                    </option>
                
                <?php }
            }
        }else{?>
            <option value="" disabled="true">No data found...</option>
        <?php }?>
    </optgroup>

<?php }?>