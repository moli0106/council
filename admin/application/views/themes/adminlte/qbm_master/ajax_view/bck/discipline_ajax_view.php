<option value="">-- Select Discipline --</option>

<?php if(isset($disciplineList)){ foreach($disciplineList as $discipline){?>
    <option value="<?php echo $discipline['discipline_id_pk']; ?>" <?php echo set_select('discipline_id', $discipline['discipline_id_pk']); ?>><?php echo $discipline['discipline_name']; ?></option>
<?php }}?>


