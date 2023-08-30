<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Certificate for PBSSD Short Term Course</title>

    <style type="text/css">
        body {
            margin-top: 0px;
            margin-left: 0px;
            font-family: arial;
            font-size: 13px;
            width: 100%;
            height: 100%;
        }

        page {
            display: block;
            margin: 0 auto;
            padding: 0px;
        }

        page[size="A4"][layout="landscape"] {
            width: 11in;
            height: 8in;
        }

        @page {
            width: 11in;
            height: 8in;
            margin: 0cm;
            margin: 10mm 16mm;
        }

        @media all {
            .page-break {
                display: none;
            }
        }

        @media print {

            body,
            page {
                margin: 0;
                padding: 0;
            }

            .page-break {
                display: block;
                page-break-before: always;
                padding-top: 0.3cm;
            }
        }

        @media print {

            header,
            footer {
                display: none !important;
            }
        }

        .main-table {
            padding: 0;
            margin: 0 auto;
            border: 9px solid #ddb200;
        }
    </style>
</head>

<body>
    <page size="A4" layout="portrait">
        <table align="center" width="100%" cellspacing="10" cellpadding="10" class="main-table">
            <tbody>
                <tr>
                    <td style="border:4px solid #000; padding-left:30px;">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="40%" valign="top" style="font-family:arial; font-size:10px;">
                                    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/ncvet-logo.png' ?>">
                                </td>
                                <td width="20%" align="center">
                                    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/gov-icon.png'; ?>" width="50">
                                </td>
                                <td width="35%">
                                    <table width="100%">
                                        <tr>
                                            <td width="80%" valign="top" style="font-family:arial; font-size:25px;">
                                                <span style="font-family: freeserif;">रोल/पंजीकरण संख्या</span>
                                                <br>Certificate No. : <strong><?php echo $traineeDetails['certificate_no']; ?></strong>
                                            </td>

                                            <td width="20%" align="right" rowspan="2" valign="top" style="font-family:arial; font-size:10px;">
                                                <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>" width="100">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top:20px;">
                            <tr>
                                <td width="70%" align="center" valign="middle">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td rowspan="2" style="width: 450px;"></td>
                                            <td align="center">
                                                <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/name.png'; ?>" style="width:100%; padding-top:10px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" align="center" style="font-family:arial; font-size:25px;line-height:25px;padding-top:5px;">
                                                <span style="font-family: freeserif;">एनसीवीईटी द्वारा मान्यता प्राप्त</span><br> <strong>(Recognised by NCVET)</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                                <td width="20%" align="center" style="padding:0 15px">
                                    <table width="80%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="126" height="220" align="center" valign="middle">
                                                <?php if ($traineeDetails['trainee_image']) { ?>
                                                    <img src="data:image/jpg;base64,<?php echo $traineeDetails['trainee_image']; ?>" style="width:200px;">
                                                <?php } else { ?>
                                                    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/blankImg.jpeg'; ?>" style="width:200px;">
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td valign="top" align="center" style="font-family:arial; font-size:27px;line-height:25px; text-transform:uppercase; color:#c8292e; padding:10px 0 10px 0;">
                                    <span style="font-family: freeserif;">प्रमाणपत्र</span>
                                    <br>
                                    <strong>Certificate</strong>
                                </td>
                            </tr>
                        </table>

                        <table width="100%" border="0" cellpadding="10" cellspacing="0">
                            <tr>
                                <td width="100%" style="padding-bottom:10px;">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="bottom" width="450" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">य्रमाणित किया जाता है कि श्री/सुश्री/एमएक्स</span> <br>
                                                This is to certify that Mr./Ms./Mx**
                                            </td>
                                            <td valign="bottom" width="1950" style="font-family:arial; font-weight: bold; font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['trainee_full_name']; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td width="100%" style="padding-bottom:10px;">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="bottom" width="300" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">सुपुत्र/सुपुत्री/प्रतिपालित**</span> <br> Son/Daughter/Ward of**
                                            </td>
                                            <td valign="bottom" width="600" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['trainee_guardian_name']; ?>
                                            </td>
                                            <td valign="bottom" width="550" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">आधार/रोल/पंजीकरण/अनुक्रमांक संख्या</span> <br>
                                                Aadhaar No./Roll No./Reg. No./Enrolment No**
                                            </td>
                                            <td valign="bottom" width="950" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['user_trainee_registration_no']; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td width="100%" style="padding-bottom:10px;">
                                    <table width="1282" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="bottom" width="330" style="font-family:arial; font-size:28px; line-height:25px;">
                                                <span style="font-family: freeserif;">
                                                    <span lang="hi">ने अहर्ता/जॉब रोल</span>
                                                </span> <br> for job role/qualification
                                            </td>
                                            <td valign="bottom" width="2070" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['course_name']; ?>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>

                            <tr>
                                <td width="100%" style="padding-bottom:10px;">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="bottom" width="150" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">अवधि</span> <br> of Duration
                                            </td>
                                            <td valign="bottom" width="750" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['course_duration']; ?> HRS
                                            </td>
                                            <td valign="bottom" width="550" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">राष्ट्रीय कौशल योग्यता संरचना स्तर</span> <br>
                                                National Skills Qualifications Framework Level
                                            </td>
                                            <td valign="bottom" width="950" align="left" style="font-family:arial; font-weight: bold; font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['course_level']; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td width="100%" style="padding-bottom:10px;">
                                    <table width="1283" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="bottom" width="180" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">प्रशिक्षण केंद्र</span> <br>Training Centre
                                            </td>
                                            <td valign="bottom" width="900" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['council_tc_name']; ?>
                                            </td>
                                            <td valign="bottom" width="100" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">जिला</span> <br> District
                                            </td>
                                            <td valign="bottom" width="400" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['tc_district_name']; ?>
                                            </td>
                                            <td valign="bottom" width="80" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">राज्य</span> <br> State
                                            </td>
                                            <td valign="bottom" width="750" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['tc_state_name']; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td width="100%" style="padding-bottom:10px;">
                                    <table width="1282" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="bottom" width="550" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">का आकलन सफलतापूर्वक</span> <br> has successfully cleared the assessment with

                                            </td>
                                            <td valign="bottom" width="120" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo $trainee_percentage; ?>
                                            </td>
                                            <td valign="bottom" width="400" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">प्रतिशत/श्रेणी के साथ उत्तीर्ण किया</span> <br>%/grade.

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                        </table>

                        <table width="100%" border="0" cellpadding="10" cellspacing="0" style="padding-top:10px;">
                            <tr>
                                <td width="100%" style="padding-bottom:5px;">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="bottom" width="220" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">जारी करने की स्थान</span> <br> Place of Issue
                                            </td>
                                            <td valign="bottom" width="300" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                Kolkata
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td width="100%">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td valign="bottom" width="210" style="font-family:arial; font-size:25px; line-height:25px;">
                                                <span style="font-family: freeserif;">जारी करने की तिथि</span> <br> Date of Issue
                                            </td>
                                            <td valign="bottom" width="300" align="left" style="font-family:arial; font-weight: bold;font-size:25px;border-bottom:2px dotted #000;">
                                                <?php echo date("d<\s\up>S</\s\up> M, Y", strtotime($traineeDetails['batch_marks_status_updated_date'])); ?>
                                            </td>

                                            <!-- <td valign="bottom" width="180" style="font-family:arial; font-size:20px; line-height:20px; padding-left: 20px;">
                                                <span style="font-family: freeserif;">काउन्सिल कोड</span> <br> Council Code
                                            </td>
                                            <td valign="bottom" width="300" align="left" style="font-family:arial; font-weight: bold;font-size:20px;border-bottom:2px dotted #000;">
                                                <?php echo $traineeDetails['certificate_council_code']; ?>
                                            </td> -->
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top:120px;">
                            <tr>
                                <td width="33.33%" valign="bottom">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>

                                            <td>
                                                <img src="<?php echo $traineeQrCode; ?>" style="width:140px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-family:arial; font-size:20px; line-height:20px;">
                                                <span style="font-family: freeserif;">ई-सत्यापन लिंक</span> <br> e-Verification Link
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                                <!-- <td width="30%" align="center" valign="bottom">&nbsp;</td> -->
                                <td width="33.33%" align="center" valign="top">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td align="center"><img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/ub.png'; ?>" style="padding-bottom:30px;" width="300"></td>

                                        </tr>
                                    </table>
                                </td>

                                <td width="33.33%" align="center" valign="bottom">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <!-- <tr>
                                            <td align="center"><img src="<?php echo base_url('admin/themes/adminlte/assets/image/certificate/logo.png'); ?>" style="padding-bottom:30px;" width="70"></td>
                                        </tr> -->
                                        <tr>
                                            <td align="center" style="font-family:arial; font-size:25px; line-height:25px; padding-top:30px;">
                                                <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/signofcao.jpg'; ?>" width="300 px">
                                                <hr width="70%">
                                                <strong>Chief Administrative Officer (CAO)</strong><br>
                                                WBSCTVESD
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="font-family:arial; font-size:20px; line-height:20px; padding-top:2px;">*Applicable as per emblem usage guidelines <br>**As applicable <br>
                                    <strong>1.</strong> This Certificate is for Short Term Training of less then a year<br>
                                    <strong>2.</strong> Grading system reference (optional) <br>
                                    <strong>3.</strong> Training has been conducted under Utkarsh Bangla scheme/RPL (optional) <br>
                                    <!-- <strong>4.</strong> Disclaimer: State Code and Awarding Bordy Code will be mentioned in the certificate Sl No, Once the same is received from NCVET -->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </page>
</body>

</html>