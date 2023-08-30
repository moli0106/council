<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Students Meritlist pdf Details</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
        }
      

        th {
            text-align: center;
            background-color: #9abfdb
        }
        td{
            text-align: center;
            background-color: #e6ebf5
        }
    </style>
</head>

<body>
    <h3 align="center"><b>MERIT LIST OF THE CANDIDATES FOR ADMISSION TO DIPLOMA
            COURSE IN PHARMACY (ACADEMIC SESSION <?php echo date("Y") ?>-<?php echo date('Y', strtotime('+1 year')); ?>)</b></h3>
    <?php if (count($student_details)) { ?>
        <table width="100%" align="center" border="1" cellspacing="0" cellpadding="4px" style="font-size: 14px;">
            <thead>
                <tr>

                    <th>Application Form Number</th>
                    <th>Name of the Candidate </th>
                    <th>Guardian's Name</th>
                    <th>Category</th>
                    <th> General Rank</th>
                    <th> SC Rank</th>
                    <th>ST Rank</th>
                    <th>PC Rank</th>
                </tr>
            </thead>
            <?php $i = 0;?>
            <?php foreach ($student_details as $students_data) {
                //    echo '<pre>'; print_r($vacent_colleges); die;
            ?>
            <?php $i++;  ?>
                <?php if($i == 34){ 
                    
                   echo  '<h3 align="center"><b>MERIT LIST OF THE CANDIDATES FOR ADMISSION TO DIPLOMA
            ';
                     }?>

                <tbody> 
                    <tr>
                        <td><?php echo $students_data['application_form_no'];?></td>
                        <td><?php echo $students_data['candidate_name']; ?></td>
                        <td><?php echo $students_data['guardian_name']; ?></td>
                        <td><?php echo $students_data['caste_name']; ?></td>
                        <td><?php echo $students_data['general_rank']; ?></td>
                        <td><?php echo $students_data['sc_rank']; ?></td>
                        <td><?php echo $students_data['st_rank']; ?></td>
                        <td><?php echo $students_data['pc_rank']; ?></td>
                    </tr>
                    
                <?php } ?>
                </tbody>
        </table>
    <?php  } else { ?>
        No Data Found

    <?php  } ?>
</body>

</html>