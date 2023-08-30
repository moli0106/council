
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Designed & Developed by<a href="javascript:void(0);"> NIC</a>.</strong> All rights
    reserved.
  </footer>


</div>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- SlimScroll -->
 <script src="<?php echo $this->config->item('theme_uri');?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Extra JS -->
<?php foreach ($this->js_foot as $jsf) {?>
<script src="<?php echo $jsf ?>"></script>
<?php } ?>
 
<!-- FastClick -->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $this->config->item('theme_uri');?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->


    <script>
    /*$(function() {
        $('#course1').change(function() {
            console.log($(this).val());
        }).multipleSelect({
            width: '100%',
			placeholder: 'Please select job role'
        });
    });*/
	</script>

  <script>
     
     // Add "https://ipinfo.io" statement
     // this will communicate with the ipify servers
     // in order to retrieve the IP address
     $.get("https://ipinfo.io", function(response) {
            // alert(response.ip);
            // $.post( "client_ip.php", { ip: response.ip} );
            $.get( "client_ip", { ip: response.ip })
             .done(function( data ) {
                 //alert( "Data Loaded: " + data );
             });
         }, "json")
          
         // "json" shows that data will be fetched in json format
  </script>



</body>
</html>
