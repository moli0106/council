

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html>
 <head>
 <title>Checkout </title>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <script type="text/javascript" language="javascript">
 function submitform(){
 document.getElementById('mySBIForm').submit();
 }
 
 </script>
 
 </head>
 <body onload="submitform()">
 
 <form name="mySBIForm" id="mySBIForm" method="post" action="https://test.sbiepay.sbi/secure/AggregatorHostedListener">
<input type="text" name="EncryptTrans" value="<?php echo $_POST['EncryptTrans']; ?>">
<input type="text" name="merchIdVal" value ="1000112"/>

</form>
 		  
 <script type="text/javascript" language="javascript">
 document.getElementById('mySBIForm').submit();
 </script>
 			   
 </body>
 </html>



