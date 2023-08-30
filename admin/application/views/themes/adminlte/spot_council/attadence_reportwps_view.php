<!DOCTYPE html>
<html>

<head>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
       /* border: 1px solid #dddddd;*/
       border: 1px solid black;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd59;
    }
  </style>
</head>

<body>
  <div width="100%" ; height="100%">
    <p style="font-size:13px;">WEST BENGAL STATE COUNCIL OF TECHNICAL & VOCATIONAL EDUCATION AND SKILL DEVELOPMENT </p>
    <p style="margin-left:185px;">ATTENDANCE SHEET -<?php echo $exam_type_name ?> -2023</p>
    <p></p>
    <hr />

    <div>
      <p style="font-size:13px;">DATE OF EXAMINATION 06/05/2023 (SATURDAY) &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TIME : 10 AM - 12 NOON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PAGE NO. : 45/46</p>
      <hr />
      <p style="font-size:13px;">VENUE NAME :- &nbsp; <?php echo '$centre_nametftgdftyghfhgftyghbvschndvbjkdvmn  ndcjkdiofkjwiok'; ?> &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; VENUE CODE : &nbsp; <?php echo $centre_code; ?></p>
      <hr />
    </div>

    <?php  if(count($student_details_array)){ 
    ?>
    <table  height="100%" width="100%" style="font-size:12px;">
      <tr>
        <th>INDEX NO</th>
        <th>APPLICATION FORM NO</th>
        <th>Candidate Name &nbsp;  Signature</th>
        <th>Photograph</th>
        <th style="width:150px;">Signature of the Candidates</th>
      </tr>

      <?php  foreach ($student_details_array as $value) { ?>
         <tr>
          <td><?php echo $value['index_number'] ?></td>
          <td><?php echo $value['application_form_no'] ?></td>
          <td><?php echo $value['candidate_name'] ?><br/>&nbsp;&nbsp;<p ><img width="190px" height="60px" src="data:image/png;base64,<?php echo $value['barcode'] ;?>"></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br/>&nbsp;&nbsp;<img width="100px" height="35px" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($value['sign']); ?>"></p> </td>
          <td> <img width="90px" height="110px" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($value['picture']); ?>"></td>
          <td style="width:200px;"></td>
        </tr> 
      <?php  } ?>
      <!-- <tr>
        <td>1010353</td>
        <td>1/2023-24/0003</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr> -->

    </table>
    <?php  } else{ 
    ?>

    No Data Found
    <?php   } 
    ?>
    <hr />
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