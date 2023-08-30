<table width="100%">
    <tr>
        <td>
            <center>
                <!-- <img src="https://sctvesd.wb.gov.in/themes/council_theme/councils/images/logoBig.png" width="80px"> -->
                <img width="90" height="90" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>">
            </center>
        </td>
    </tr>

    <tr>
        <td>
            <p style="color: #1A237E;">
                <center>
                    <span style="font-size: 20px; font-weight: 900;">West Bengal<br>State Council of Technical & Vocational Education<br>& Skill Development<br></span>
                    <span style="font-size: 15px;">Karigari Bhawan<br>B/7, Action Area – III, New Town, Rajarhat, Kolkata – 160</span>
                </center>
            </p>
        </td>
    </tr>
</table>

<table width="100%" border="1" cellspacing="0px" cellpadding="8px" style="font-size: 10px;">
    <tr style="background: #FFF">
        <td><strong>Vertical Code</strong></td>
        <td><?php echo $batch_details['vertical_code']; ?></td>
        <td><strong>Proposed Assessment Date</strong></td>
        <td><?php echo date("d-m-Y", strtotime($batch_details['proposed_assessment_date'])); ?></td>
    </tr>
    <tr style="background: #EEE">
        <td><strong>Vertical Name</strong></td>
        <td colspan="3"><?php echo $batch_details['vertical_name']; ?></td>
    </tr>
    <tr style="background: #FFF">
        <td><strong>User Batch Code</strong></td>
        <td colspan="3"><?php echo $batch_details['user_batch_id']; ?></td>
    </tr>
    <tr style="background: #EEE">
        <td><strong>Scheme Name</strong></td>
        <td colspan="3"><?php echo $batch_details['assessment_scheme_name']; ?></td>
    </tr>
    <tr style="background: #FFF">
        <td><strong>Sector Name</strong></td>
        <td><?php echo $batch_details['sector_name'] . ' [' . $batch_details['sector_code'] . ']'; ?></td>
        <td><strong>Course Name</strong></td>
        <td><?php echo $batch_details['course_name'] . ' [' . $batch_details['course_code'] . ']'; ?></td>
    </tr>
    <tr style="background: #EEE">
        <td><strong>TC Name</strong></td>
        <td><?php echo $batch_details['user_tc_name'] . ' [' . $batch_details['user_tc_code'] . ']'; ?></td>
        <td><strong>Assessor Name</strong></td>
        <td>
            <?php echo $assessor_details['fname'] . ' ' . $assessor_details['lname']; ?>
            [<?php echo $assessor_details['assessor_code']; ?>]
        </td>
    </tr>
</table>

<h2 style="color: #1A237E;">Details of Trainee List :</h2>

<table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px;">
    <tr style="background: #E1F5FE;">
        <th>#</th>
        <th>Trainee Details</th>
        <th>NoS Marks</th>
    </tr>
    <?php
    $count = 0;
    foreach ($tranee_details as $key => $tranee) {
        ++$count;
        if ($count % 2 == 0) $css = "#EEE";
        else $css = "#FFF";
    ?>
        <tr style="background: <?php echo $css; ?>;">
            <td align="center"><?php echo $count; ?>.</td>
            <td>
                <strong>Name : </strong><?php echo $tranee['trainee_full_name']; ?> <br><br>
                <strong>Council Code : </strong><?php echo $tranee['council_trainee_code']; ?> <br><br>
                <strong>User Code : </strong><?php echo $tranee['user_trainee_id']; ?> <br><br>
            </td>
            <td>
                <table width="100%" border="1" cellspacing="0px" cellpadding="4px" style="font-size: 10px; page-break-inside:avoid;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nos Name/Code</th>
                            <th>Theory Marks</th>
                            <th>Practical Marks</th>
                            <th>Viva Marks</th>
                            <th>Total Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($nos_details as $key => $nos) { ?>
                            <tr>
                                <td align="center"><?php echo ++$i; ?>.</td>
                                <td><?php echo $nos['nos_name']; ?>/<?php echo $nos['nos_code']; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>
    <?php } ?>
</table>

<table width="100%">
    <tr>
        <td width="50%"></td>
        <td align="center" style="padding-top: 50px;">
            <p style="font-size: 15px;"><span style="font-weight: 900;">Signature</p>
            <p style="font-size: 15px;"><span style="font-weight: 900;">Assessor : </span>
                <?php echo $assessor_details['fname'] . ' ' . $assessor_details['lname']; ?>
                [<?php echo $assessor_details['assessor_code']; ?>]
            </p>
        </td>
    </tr>
</table>