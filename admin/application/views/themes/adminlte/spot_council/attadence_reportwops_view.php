<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid black;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<div width="100%"; height="100%" >
<p style="font-size:13px;">WEST BENGAL STATE COUNCIL OF TECHNICAL & VOCATIONAL EDUCATION AND SKILL DEVELOPMENT </p><p style="margin-left:200px;">Descriptive Roll - <?php echo $exam_type_name;?> -2023</p>
<p></p>
<hr/>

<div>
<p style="font-size:13px;">DATE OF EXAMINATION 06/05/2023 (SATURDAY) &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TIME : 10 AM - 12 NOON  &nbsp;&nbsp;&nbsp;&nbsp;PAGE NO. :<?php echo '{PAGENO}' ?> </p>
<hr/>
<p style="font-size:13px;">VENUE NAME :- &nbsp; <?php echo $centre_name; ?> &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VENUE CODE : &nbsp; <?php echo $centre_code; ?></p>
<hr/>
</div>


<?php  if(count($descriptive_details)){ ?>
<table  height="100%" width="100%"  >
  <tr>
    <th>SL NO</th>
    <th>INDEX NO</th>
    <th>APPLICATION FORM NO</th>
    <th>CANDIDATES NAME </th>
    <th>ATTENDANCE IN</th>
  </tr>
<?php $i =1;
 foreach($descriptive_details as $value){?>
  <tr>
    <td><b><?php echo $i++ ?></b></td>
    <td><b><?php echo $value['index_number'] ?></b></td>
    <td><?php echo $value['application_form_no'] ?></td>
    <td><?php echo $value['candidate_name'] ?></td>
    <td></td>
  </tr>

 <?php } ?>
  
</table>
<?php } else{?>
 <p style="text-align:center;"> No Data Found</p>
<?php } ?>

<hr/>
<table>
  <tr>
    <td>No. of Candidates Present</td>
    <td width="200px"></td>
    <td rowspan="2"></td>
  </tr>
  <tr>
    <td>No. of Candidates Absent</td>
    <td width="200px"></td>
    
  </tr>
  <tr>
    <td>TOTAL</td>
    <td width="200px"></td>
    <td>Signature of Invigilator</td>
  </tr>
</table>

</div>
</body>
</html>

