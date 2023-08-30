<footer>
        <div class="footer-top text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="footer-menu">
                            <li><a href="act_rules">Acts & Rules</a></li>
                            <!-- <li><a href="files/public/RTI_ACTS.pdf">RTI Act</a></li> -->
                            <li><a href="rti_act">RTI Act</a></li>
                            <li><a href="online_app/useful_link">Important Links</a></li>
                            <li><a href="coming_soon">Terms and Conditions</a></li>
                            <li><a href="coming_soon">Privacy Policy</a></li>
                            <li><a href="coming_soon">Disclaimer</a></li>
                            <li><a href="coming_soon">Web Information Manager</a></li>
                            <li><a href="contactus_us">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-left">
                            <p>Helpline No: 8017372871</p>
                            <p>Opening Hours: Monday-Friday - 10.00 a.m. to 5.00 p.m.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-right text-right">
                            <p>Copyright © 2021 WBSCTVESD</p>
                            <span>Designed and Developed by <a target="_blank" href="http://www.nic.in/">
                                    <strong>National Informatics Centre ( NIC )</strong></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>

<!-- Extra JS -->
	<?php foreach ($this->js_foot as $jsf) {?>
	<script src="<?php echo $jsf ?>"></script>
	<?php } ?>

    <script>
$( document ).ready(function() {
    $(document).on("change","#dist", function () {
        var dist_id = $( "#dist option:selected" ).val();;
        window.location.replace("district/institute_locator/dist/"+dist_id);
        //district/institute_locator/dist/3
    });
       
    //});
});
$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  }
  var $subMenu = $(this).next(".dropdown-menu");
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass("show");
  });


  return false;
});

<!--search-->
$(document).ready(function() {

	$(".fa-search").click(function() {
	   $(".togglesearch").toggle();
	   $("input[type='text']").focus();
	 });

});

<!--counter JS-->
$('.counter').countUp();
</script>


<!-- <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script> -->
     
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