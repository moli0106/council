<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>VTC Details</title>

</head>
<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>

<body>


    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td valign="middle" align="center" width="20%" style="padding:10px;">
                <!-- <img width="90" height="90" src="<?php echo base_url('admin/themes/adminlte/custom/council_logo.png'); ?>"> -->
                <img width="90" height="90" src="<?php echo base_url('admin/themes/adminlte/custom/council_logo.png'); ?>">
            </td>
        </tr>
        <tr>
            <td align="center" style="font-family:arial; font-size:20px;line-height:25px;">
                <strong>West Bengal<br>State Council of Technical & Vocational<br>Education
                    & Skill Development</strong>
            </td>
        </tr>
        <tr>
            <td valign="top" align="center" style="font-family:arial; font-size:16px;line-height:25px;padding-bottom:10px; border-bottom:2px solid #000;">
                Karigari Bhawan ,  4th & 5th Floor, <br> B/7, Action Area – III, New Town, Rajarhat, Kolkata – 160</td>
        </tr>
    </table>

    <table width="100%">

        <tr>
            <td>

                <p style="color: #1A237E;">
                    <center>
                        <b style="font-size: 20px; font-weight: 700;">VTC Name :</b>
                        <span><?php echo $vtcDetails['vtc_name'];?></span><br>
                        <b style="font-size: 20px; font-weight: 700;">VTC Code :</b>
                        <span><?php echo $vtcDetails['vtc_code'];?></span><br>
                        <b style="font-size: 20px; font-weight: 700;">Academic Year :</b>
                        <span><?php echo $vtcDetails['academic_year'];?></span><br>

                    </center>
                </p>
            </td>
        </tr>
    </table><br>

    
    <!-- Course Selection -->

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Student Lists</h3>
            <div class="box-tools pull-right"></div>
        </div>

        <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
           

            <tr style="background: #E1F5FE;">
                
                <th colspan="8"><strong>Course Type : </strong>Short Term Course(STC)</th>
                
            </tr>

            <thead>
                    <tr style="background: #E1F5FE;">
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Date of birth</th>
                        <th>Photo</th>
                        <th>Signature</th>
                        <th>Group/Trade Code</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(count($student_data)!=0)
                        {
                            $i = $offset;
                            foreach ($student_data as $key => $val) { ?>

                            <tr>
                                <td><?php echo ++$i; ?>.</td>
                                <td><?php echo $val['first_name']; ?> <?php echo $val['middle_name']; ?> <?php echo $val['last_name']; ?> </td>
                                <td><?php echo $val['father_name']; ?> </td>
                                <td><?php echo $val['mother_name']; ?> </td>
                                <td><?php echo date("d/m/Y", strtotime($val['date_of_birth']));; ?> </td>
                                <td>
                                    <img height="30px" width="30px" class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($val['image']); ?>">
                                </td>
                                <td>
                                    <img height="30px" width="40px" class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($val['std_signature']); ?>">
                                </td>

                                <td>
                                <?php echo $val['group_code']?>
                                </td>
                                
                            </tr>

                    <?php } } else { ?>
                    <tr>
                        <td colspan="6" align="center" class="text-danger">No Data Found...</td>
                    </tr>

                    <?php }
                            ?>
                </tbody>

           
        </table>

       

    </div><br><br><br>

    <table align="right" >
        <tr>
            <td align="center" style="font-size: 12px; width: 40%;" rowspan="3">
                
                <hr width="80%" style="margin-top: 2px;">
                <strong>HOI Signature</strong><br>
                
            </td>
        </tr>
    </table>

    
</body>

</html>