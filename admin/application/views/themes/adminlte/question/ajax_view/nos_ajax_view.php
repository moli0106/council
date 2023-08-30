<option value="">-- Select NoS --</option>

<?php if(isset($nos_list)){ foreach($nos_list as $nos){?>
    <option value="<?php echo $nos['course_marks_id_pk']; ?>" <?php echo set_select('nos_id', $nos['course_marks_id_pk']); ?>><?php echo $nos['nos_name']; ?></option>
<?php }}?>


