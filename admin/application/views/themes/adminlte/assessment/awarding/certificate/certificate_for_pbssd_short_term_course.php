<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        span {
            font-family: freesans;
        }
    </style>
</head>

<body>
    <div style="border: 9.5px solid #ddb200; padding: 5px 5px;">
        <div style="border: 3.8px solid #ddb200; padding: 5px 30px;">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 13%;">
                                    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/ncvet-logo.png' ?>" style="width: 120px;">
                                </td>
                                <td style="width: 31%;"></td>
                                <td align="center" style="width: 20%;">
                                    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/gov-icon.png' ?>" style="width: 40px;">
                                </td>
                                <td style="width: 40%; vertical-align:top; padding-top: 10px; padding-left: 50px; font-size: 10px;">
                                    <span style="font-family: freeserif;">रोल/पंजीकरण संख्या</span>
                                    <br>
                                    Certificate No. :
                                    <strong><?php echo $traineeDetails['certificate_no']; ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 13%;"></td>
                                <td align="center" style="font-size: 16px;">
                                    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/name.png'; ?>" style="width: 600px;">
                                    <br>
                                    <span style="font-family: freeserif;">राष्ट्रीय व्यावसायिक शिक्षा एवं प्रशिक्षण परिषद<br>मान्यता प्राप्त</span>
                                    <br>
                                    <strong>(Recognised by NCVET)</strong>
                                </td>
                                <td style="width: 13%; padding-top: 10px;">
                                    <?php if ($traineeDetails['trainee_image']) { ?>
                                        <img src="data:image/jpg;base64,<?php echo $traineeDetails['trainee_image']; ?>" style="width:100px;height:130px;" />
                                    <?php } else { ?>
                                        <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/blankImg.jpeg'; ?>" style="width: 100px;">
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 13%;"></td>
                                <td align="center" style="font-size: 20px; font-family:arial; text-transform:uppercase; color:#c8292e;">
                                    <span style="font-family: freeserif;">प्रमाणपत्र</span>
                                    <br>
                                    <strong>CERTIFICATE</strong>
                                </td>
                                <td style="width: 13%;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top: 3px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 25%; font-size: 12px;">
                                    <span style="font-family: freeserif;">प्रमाणित किया जाता है कि श्री / सुश्री / एमएक्स</span>
                                    <br>
                                    <strong>This is to certify that (Mr./Ms./Mx)**</strong>
                                </td>
                                <td valign="bottom" style="border-bottom: 1px solid #000;">
                                    <strong><?php echo $traineeDetails['trainee_full_name']; ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top: 3px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 16%; font-size: 12px;">
                                    <span style="font-family: freeserif;">सुपुत्र/सुपुत्री/प्रतिपालित**</span>
                                    <br>
                                    <strong>Son/Daughter/Ward of**</strong>
                                </td>
                                <td valign="bottom" style="width: 33%; border-bottom: 1px solid #000;">
                                    <strong><?php echo $traineeDetails['trainee_guardian_name']; ?></strong>
                                </td>
                                <td style="width: 30%; font-size: 12px;">
                                    <span style="font-family: freeserif;">आधार/रोल/पंजीकरण/अनुक्रमांक संख्या</span>
                                    <br>
                                    <strong>Aadhaar No./Roll No./Reg. No./Enrolment No**</strong>
                                </td>
                                <td valign="bottom" style="border-bottom: 1px solid #000;">
                                    <strong><?php echo $traineeDetails['user_trainee_registration_no']; ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top: 3px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 16%; font-size: 12px;">
                                    <span style="font-family: freeserif;">ने अहर्ता/जॉब रोल**</span>
                                    <br>
                                    <strong>for job role/qualification</strong>
                                </td>
                                <td valign="bottom" style="border-bottom: 1px solid #000;">
                                    <strong><?php echo $traineeDetails['course_name']; ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top: 3px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 10%; font-size: 12px;">
                                    <span style="font-family: freeserif;">अवधि</span>
                                    <br>
                                    <strong>of Duration</strong>
                                </td>
                                <td valign="bottom" style="width: 25%; border-bottom: 1px solid #000;">
                                    <strong><?php echo $traineeDetails['course_duration']; ?> HRS</strong>
                                </td>
                                <td style="width: 30%; font-size: 12px;">
                                    <span style="font-family: freeserif;">राष्ट्रीय कौशल योग्यता संरचना स्तर</span>
                                    <br>
                                    <strong>National Skills Qualifications Framework Level</strong>
                                </td>
                                <td valign="bottom" style="border-bottom: 1px solid #000;">
                                    <strong><?php echo $traineeDetails['course_level']; ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top: 3px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 10%; font-size: 12px;">
                                    <span style="font-family: freeserif;">प्रशिक्षण केंद्र</span><br><strong>Training Centre</strong>
                                </td>
                                <td valign="bottom" style="width:50%; border-bottom: 1px solid #000;">
                                    <strong><?php echo $traineeDetails['council_tc_name']; ?></strong>
                                </td>
                                <td style="width: 5%; font-size: 12px;">
                                    <span style="font-family: freeserif;">जिला</span> <br> <strong>District</strong>
                                </td>
                                <td valign="bottom" style="width:20%; border-bottom: 1px solid #000;">
                                    <strong><?php echo $traineeDetails['tc_district_name']; ?></strong>
                                </td>
                                <td style="width: 3%; font-size: 12px;">
                                    <span style="font-family: freeserif;">राज्य</span> <br> <strong>State</strong>
                                </td>
                                <td valign="bottom" style="border-bottom: 1px solid #000;">
                                    <strong><?php echo $traineeDetails['tc_state_name']; ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top: 3px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 28%; font-size: 12px;">
                                    <span style="font-family: freeserif;">का आकलन सफलतापूर्वक</span>
                                    <br>
                                    <strong>has successfully cleared the assessment with</strong>
                                </td>
                                <td valign="bottom" style="width: 55%; border-bottom: 1px solid #000;">
                                    <strong><?php echo $trainee_percentage; ?></strong>
                                </td>
                                <td style="font-size: 12px;">
                                    <span style="font-family: freeserif;">प्रतिशत/श्रेणी के साथ उत्तीर्ण किया |</span> <br><strong>%/grade.</strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top: 10px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="width: 40%;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="width: 25%; font-size: 10px;">
                                                <span style="font-family: freeserif;">जारी करने की स्थान</span><br><strong>Place of Issue:</strong>
                                            </td>
                                            <td valign="bottom" style="width: 35%; border-bottom: 1px solid #000;">
                                                <strong style="font-size: 10px;">Kolkata</strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                                <td rowspan="3" align="center" style="vertical-align:top;">
                                    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/ub.png'; ?>" style="width: 115px;">
                                </td>
                                <td align="center" style="font-size: 12px; width: 40%;" rowspan="3">
                                    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>" style="width: 105px;">
                                    <br>
                                    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/signofcao.jpg'; ?>" style="width: 150px;">
                                    <hr width="70%">
                                    <strong>Saequa Monazza</strong><br>
                                    <strong>Chief Administrative Officer (CAO)</strong><br>
                                    WBSCTVESD
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="width: 25%; font-size: 10px;">
                                                <span style="font-family: freeserif;">जारी करने की तिथि</span><br><strong>Date of Issue:</strong>
                                            </td>
                                            <td valign="bottom" style="width: 35%; border-bottom: 1px solid #000;">
                                                <strong style="font-size: 10px;">
                                                    <?php echo date("d<\s\up>S</\s\up> M, Y", strtotime($traineeDetails['batch_marks_status_updated_date'])); ?>
                                                </strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 10px;">
                                    <img src="<?php echo $traineeQrCode; ?>" style="width: 50px;">
                                    <br><span style="font-family: freeserif;">ई-सत्यापन लिंक</span> <br> e-Verification Link
                                    <br> *Applicable as per emblem usage guidelines <br>**As applicable <br>
                                    <strong>1.</strong> This Certificate is for Short Term Training of less then a year<br>
                                    <strong>2.</strong> Training has been conducted under Utkarsh Bangla scheme/RPL (optional) <br>
                                    <strong>3.</strong> Grading system reference (optional) <br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>