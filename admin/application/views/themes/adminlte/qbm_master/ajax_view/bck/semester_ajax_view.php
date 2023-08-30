<option value="">-- Select Semester/Year --</option>

<?php if(isset($semesterList)){ foreach($semesterList as $semester){?>
    <option value="<?php echo $semester['semester_id_pk']; ?>" <?php echo set_select('sam_year_id', $semester['semester_id_pk']); ?>><?php echo $semester['semester_name']; ?></option>
<?php }}?>


