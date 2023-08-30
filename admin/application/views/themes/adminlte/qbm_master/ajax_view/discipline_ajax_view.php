<option value="">-- Select Discipline --</option>

<?php if(isset($disciplineList)){ foreach($disciplineList as $discipline){?>
    <option value="<?php echo $discipline['discipline_id_pk']; ?>" <?php echo set_select('discipline_id', $discipline['discipline_id_pk']); ?>><?php echo $discipline['discipline_name']; ?> [<?php echo $discipline['discipline_code']; ?>]</option>
<?php }}?>


