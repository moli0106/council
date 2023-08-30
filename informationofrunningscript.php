<?php echo phpinfo(); ?>
<?php echo 'Current PHP version: ' . phpversion(); ?>

<?php
$xportlist = stream_get_transports();
print_r($xportlist);
?>


<?php
print_r(stream_get_wrappers());
?>