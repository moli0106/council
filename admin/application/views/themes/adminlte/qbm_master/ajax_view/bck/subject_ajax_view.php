<option value="">-- Select Subject --</option>

<?php if(isset($subjectList)){ foreach($subjectList as $subject){?>
    <option value="<?php echo $subject['subject_id_pk']; ?>" <?php echo set_select('subject_id', $subject['subject_id_pk']); ?>><?php echo $subject['subject_name']; ?></option>
<?php }}?>


