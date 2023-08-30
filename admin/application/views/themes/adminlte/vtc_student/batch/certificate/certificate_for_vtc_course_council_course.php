<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>CERTIFICATE(WBSCT)</title>

<style type="text/css">
body {margin-top:0px; margin-left:0px;font-family:arial; font-size:16px; width:100%; height:100%;}
page {display:block; margin:0 auto; padding:0px;}

page[size="A4"][layout="landscape"] {width:11in; height:8in;}
/*@page {width:11in; height:8in;margin:10mm 10mm; size: A4 landscape;}*/



@media all {.page-break{display:none;}}
@media print {
body, page {margin:0; padding:0;}
.page-break {display:block; page-break-before:always; padding-top:0.3cm;}
}
@media print {header, footer {display:none!important;}}
.main-table{padding:0;margin: 0 auto;border:20px solid #123874;}

</style>
</head>

<body>
<page size="A4" layout="landscape">
<table align="center" width="100%" cellspacing="8" cellpadding="8" class="main-table">
    <tr>
      <td>
        <table width="100%" cellspacing="2" cellpadding="2" style="border:4px solid #123874;">
        <tr>
        <td style="border:2px solid #123874; padding:10px;">
        
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
        <td width="25%" rowspan="2" valign="top" style="font-family:arial;"><img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate_council/ub-logo.png'; ?>" width="180"></td>
        <td width="50%" align="center"><img src="<?php echo $_SERVER['DOCUMENT_ROOT']. '/' . 'admin/themes/adminlte/assets/image/certificate_council/certificate.png'; ?>" width="300"></td>
        <td width="25%" valign="top" align="right" style="font-family:arial;"><img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate_council/logo.png'; ?>" width="160"></td>
        </tr>
        </table>
        
        <table width="100%" cellpadding="0" cellspacing="0" style="padding-top: 30px;">
          <tr>
         <td valign="top" align="center" style="font-family:arial; font-size:24px;line-height:25px;color:#000; padding:0 0 15px 0; font-style:italic;">This is to certify that</td>
        </tr>
        </table>
        
        <table width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
        <td width="100%" valign="middle" align="center" style="font-family:arial; font-size:20px;font-weight:bold;"><?php echo strtoupper($traineeDetails['trainee_full_name']); ?>
          <?php //echo '<pre>'; print_r($traineeDetails); die;?>
        </td>
        </tr>
        
        <tr>
        <td width="100%" align="center" style="padding:10px 0 0 0;">
        <table border="0" cellpadding="0" cellspacing="0">
        <tr>
        <td valign="bottom" align="center" style="font-family:arial; font-size:20px; line-height:20px;">Son/Daughter of <span><strong><?php echo strtoupper($traineeDetails['trainee_guardian_name']); ?></strong></span> </td>
        </tr>
        
        <tr>
        <td align="center" valign="bottom" style="font-family:arial; font-size:20px; line-height:20px;font-style:italic; padding:10px 0;">has successfully cleared the assessment for the job role of</td>
        </tr>     
        </table>
        </td>
        </tr>
        </table>
        
        <table width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
        <td valign="middle" align="center" style="font-family:arial; font-size:20px;"><span><strong><?php echo $traineeDetails['course_name']; ?></strong></span> &nbsp; (Course Code: <span><strong><?php echo $traineeDetails['course_code']; ?></strong></span>)</td>   
        </tr>
        </table>
        
        <table width="90%" align="center" border="0" cellpadding="0" cellspacing="0" style="margin-top:30px;">
        <tr>
        <td valign="middle" align="center" style="font-family:arial; font-size:20px;"><?php if($traineeDetails['course_level']!='0') {?>equivalent to National Skills Qualifications Framework Level <span><strong>- <?php echo $traineeDetails['course_level']; ?></strong></span><?php } else{?>&nbsp;<?php }?></td>
		
        </tr>
        </table>
        
        <table width="90%" align="center" border="0" cellpadding="0" cellspacing="0" style="padding-top: 30px;">
        <tr>
        <td align="center" style="font-family:arial; font-size:20px; line-height:20px;font-style:italic; padding:8px 0;">
        Issued by: West Bengal State Council of Technical & Vocational Education and Skill Development (A Statutory Body under Government of West Bengal Act XXVI of 2013)
        </td>
        </tr>
        </table>
        
        
        <table width="90%" align="center" border="0" cellpadding="0" cellspacing="0" style="padding-top: 50px;">
        <tr>
        <td valign="middle" align="center" style="font-family:arial; font-size:20px; padding-bottom:10px;">Training Centre Name : <span><strong><?php echo $traineeDetails['council_tc_name']; ?></strong></span></td>   
        </tr>
        <tr>
        <td valign="middle" align="center" style="font-family:arial; font-size:20px;">TC Code : <span><strong><?php echo $traineeDetails['user_tc_code']; ?></strong></span></td>   
        </tr>
        </table>
        
        
        
        
        <table width="90%" align="center" border="0" cellpadding="0" cellspacing="0" style="padding-top: 105px;">
        <tr>
        <td>
            <table align="top" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td align="right" valign="bottom" style="font-family:arial; font-size:18px; line-height:20px;">Signature:</td>
            </tr>
            </table>
        </td>
        
        <td style="width: 25%;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<?php $certi_gen_date=date("Y-m-d",strtotime($traineeDetails['batch_marks_status_updated_date']));?>
			<?php if($certi_gen_date <= '2022-07-25'){?>
				<tr>
					<td height="23" align="center" valign="bottom" style="font-family:arial; font-size:16px; line-height:20px; border-bottom:1px solid #123874;"> <img width="200" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate_council/signofcao.jpg'; ?>" style="padding-bottom: 12px;"></td>
				</tr>
				<tr>
					<td align="center" valign="bottom" style="font-family:arial; font-size:18px; line-height:20px;">Chief Administrative Officer</td>
				</tr>
			<?php } else {?>
				<tr>
					<td height="23" align="center" valign="bottom" style="font-family:arial; font-size:16px; line-height:20px; border-bottom:1px solid #123874;"> <img width="200" src="<?php echo $_SERVER['DOCUMENT_ROOT']. '/' . 'admin/themes/adminlte/assets/image/certificate_council/PurnanduBasu.png'; ?>" style="padding-bottom: 12px;"></td>
				</tr>
				<tr>
					<td align="center" valign="bottom" style="font-family:arial; font-size:18px; line-height:20px;">Chairperson</td>
				</tr>
			<?php }?>
			</table>
        </td>
       <!-- <td align="right"><img src="<?php echo base_url() . '/' . 'admin/themes/adminlte/assets/image/certificate_council/qr-code.png'; ?>" width="150"></td>  -->
      <!--  <td align="right"><img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/'.'admin/themes/adminlte/assets/image/certificate_council/qr-code.png'; ?>" width="150"></td>  -->
       <td align="right"><img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/'.'admin/themes/adminlte/assessment/qr-code/'.$traineeQrCode; ?>" width="150"></td> 

       <!-- <td align="right"><img src="<?php echo 'data:image/png;base64,'.base64_encode ( file_get_contents ($_SERVER['DOCUMENT_ROOT']. '/council_live/admin/themes/adminlte/assets/image/certificate_council/qr-code.png')); ?>" style="width: 120px;"> </td> -->
       <!-- <img src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/'.'admin/themes/adminlte/assets/image/certificate/ncvet-logo.png' ?>"> -->
        </tr>
        </table>    
        
        <table align="center" width="90%" border="0" cellpadding="0" cellspacing="0">
            <tr>
            <td valign="bottom" style="font-family:arial; font-size:20px; line-height:20px;width: 10px;">Date:</td>
            <td valign="middle" align="left" style="font-family:arial; font-size:16px;font-weight:bold;">&nbsp;<?php echo date("d<\s\up>S</\s\up> M, Y", strtotime($traineeDetails['batch_marks_status_updated_date'])); ?></td>
            <td width="928"></td>
            </tr>
        </table>
                 
        </td>
        </tr>
        </table>
      </td>
    </tr>
</table>
</page>
</body>
</html>

