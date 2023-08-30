<option value="">-- Select Course --</option>

<?php if(isset($courses)){ foreach($courses as $course){?>
    <option value="<?php echo $course['course_id_pk']; ?>" <?php echo set_select('course_name', $course['course_id_pk']); ?>><?php echo $course['course_name']; ?></option>
<?php }}?>


