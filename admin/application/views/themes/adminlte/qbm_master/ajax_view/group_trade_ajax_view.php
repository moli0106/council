<option value="">-- Select Group/Trade --</option>
<?php if(isset($group_tradeList)){ foreach($group_tradeList as $group_trade){?>
    <option value="<?php echo $group_trade['group_trade_id_pk']; ?>" <?php echo set_select('group_trade_id', $group_trade['group_trade_id_pk']); ?>><?php echo $group_trade['group_trade_name']; ?> [<?php echo $group_trade['group_trade_code']; ?>]</option>
<?php }}?>


