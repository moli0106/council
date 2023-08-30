
<div class="row">

    <div class="col-md-12">
        <?php foreach ($subCategory as $key => $value) { ?>
            
      
            <div class="form-group">
                <label class="" for="class_name"><?php echo $key;?> <span class="text-danger">*</span></label><br>
                <input type="hidden" name="cat_id_<?php echo $value['category_id'];?>" value="<?php echo $value['category_id'];?>">
                <?php foreach ($value['subject_name'] as $val) {?> 
                    <label class="checkbox-inline">
                        <input type="checkbox" name="<?php echo strtolower(str_replace(" ","",$key))?>[]" value="<?php echo $val['subject_name_id_pk']?>" <?php echo set_checkbox(strtolower(str_replace(" ","",$key)).'[]', $val['subject_name_id_pk']); ?>><?php echo $val['subject_name']?> [<?php echo $val['subject_code']?>]
                    </label>
                <?php }?>
                <?php echo form_error(strtolower(str_replace(" ","",$key)).'[]'); ?>
        
            </div>
        <?php }?>   
    </div>
</div>



<?php /* <div class="row">
    
    <div class="col-md-12">
        <div class="form-group">
            <label class="" for="class_name">Language 1 <span class="text-danger">*</span></label><br>

            <?php if(!empty($subCategory['1'])){?>
                <input type="hidden" name="cat_id[]" value="1">
                <?php foreach ($subCategory['1'] as $key => $value) {?>
                
                <label class="checkbox-inline">
                    <input type="checkbox" name="lang1[]" value="<?php echo $value['subject_name_id_pk']?>" <?php echo set_value('lang1[]');?>><?php echo $value['subject_name']?> [<?php echo $value['subject_code']?>]
                </label>
            <?php }?>
            <?php echo form_error('lang1[]'); ?>
        <?php }else{?>
                No Data Found...
            <?php }?>
            
        </div>
    </div>


    <div class="col-md-12">
        
        <div class="form-group">
            <label class="" for="class_name">Language 2 <span class="text-danger">*</span></label><br>
            <?php if(!empty($subCategory['5'])){ ?>
                <input type="hidden" name="cat_id[]" value="5">
                <?php foreach ($subCategory['5'] as $key => $value) {?>
                
                <label class="checkbox-inline">
                    <input type="checkbox" name="lang2[]" value="<?php echo $value['subject_name_id_pk']?>"><?php echo $value['subject_name']?> [<?php echo $value['subject_code']?>]
                </label>
            <?php }
            echo form_error('lang2[]');
        }else{?>
                No Data Found...
            <?php }?>
        </div>
    </div>

    <div class="col-md-12">
        
        <div class="form-group">
            <label class="" for="class_name">Academic Elective <span class="text-danger">*</span></label><br>
            <?php if(!empty($subCategory['3'])){ ?>

                <input type="hidden" name="cat_id[]" value="3">

                <?php foreach ($subCategory['3'] as $key => $value) {?>
                
                    <label class="checkbox-inline">
                        <input type="checkbox" name="academic_electrive[]" value="<?php echo $value['subject_name_id_pk']?>"><?php echo $value['subject_name']?> [<?php echo $value['subject_code']?>]
                    </label>
                <?php }
                echo form_error('academic_electrive[]');
            }else{?>
                No Data Found...
            <?php }?>
        </div>
    </div>

    <div class="col-md-12">
        
        <div class="form-group">
            <label class="" for="class_name">Common <span class="text-danger">*</span></label><br>
            <?php if(!empty($subCategory['4'])){?>
                <input type="hidden" name="cat_id[]" value="4">
                <?php foreach ($subCategory['4'] as $key => $value) {?>
                
                <label class="checkbox-inline">
                    <input type="checkbox" name="common[]" value="<?php echo $value['subject_name_id_pk']?>"><?php echo $value['subject_name']?> [<?php echo $value['subject_code']?>]
                </label>
            <?php }}else{?>
                No Data Found...
            <?php }?>
        </div>
    </div>

    <div class="col-md-12">
        
        <div class="form-group">
            <label class="" for="class_name">Vocational <span class="text-danger">*</span></label><br>
            <?php if(!empty($subCategory['2'])){?>

                <input type="hidden" name="cat_id[]" value="2">

                <?php foreach ($subCategory['2'] as $key => $value) {?>
                
                <label class="checkbox-inline">
                    <input type="checkbox" name="vocational[]" value="<?php echo $value['subject_name_id_pk']?>"><?php echo $value['subject_name']?> [<?php echo $value['subject_code']?>]
                </label>
            <?php }}else{?>
                No Data Found...
            <?php }?>
        </div>
    </div>

</div> */?>