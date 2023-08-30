<option value="">-- Select Question Type --</option>

<?php if(isset($questions_type)){ foreach($questions_type as $question_type){?>
    <option value="<?php echo $question_type['question_type_id_pk'] ?>" <?php echo set_select('question_type_id',$question_type['question_type_id_pk']) ?>> <?php echo $question_type['question_type_name'] ?></option>
<?php }}?>


