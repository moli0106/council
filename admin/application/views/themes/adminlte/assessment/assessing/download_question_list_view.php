<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Question Paper</title>
    <style type="text/css">
        body {
            margin-top: 0px;
            margin-left: 0px;
            font-family: arial;
            font-size: 13px;
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            padding: 0px;
        }

        page[size="A4"][layout="portrait"] {
            width: 8in;
            height: 11in;
        }

        @page {
            height: 11in;
            width: 8in;
            margin: 5mm;
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
            padding: 14px;
            margin: auto auto auto 14px;
            width: 750px;
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <page size="A4" layout="portrait">
        <div align="center" width="100%" cellspacing="10" cellpadding="10" class="main-table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="middle" align="center" width="20%" style="padding:10px;">
                        <!-- <img width="90" height="90" src="<?php echo base_url('admin/themes/adminlte/custom/council_logo.png'); ?>"> -->
                        <img width="90" height="90" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>">
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
                        Karigari Bhawan <br> B/7, Action Area – III, New Town, Rajarhat, Kolkata – 160</td>
                </tr>
            </table>

            <table width="100%">
                <tr>
                    <td height="10">&nbsp;</td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="181" style="font-family:arial; font-size:15px; padding:5px 0;">
                        <strong>Vertical</strong>
                    </td>
                    <td width="25" align="center" valign="middle">:</td>
                    <td width="526" align="left" valign="top" style="font-family:arial; font-size:13px;padding:3px 0;">
                        <?php echo $batch_details['vertical_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td width="181" style="font-family:arial; font-size:15px; padding:5px 0;">
                        <strong>Assessment Scheme</strong>
                    </td>
                    <td width="25" align="center" valign="middle">:</td>
                    <td width="526" align="left" valign="top" style="font-family:arial; font-size:13px;padding:3px 0;">
                        <?php echo $batch_details['assessment_scheme_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td width="181" style="font-family:arial; font-size:15px; padding:5px 0;">
                        <strong>Batch Code</strong>
                    </td>
                    <td width="25" align="center" valign="middle">:</td>
                    <td width="526" align="left" valign="top" style="font-family:arial; font-size:13px;padding:3px 0;">
                        <?php echo $batch_details['user_batch_id']; ?>
                    </td>
                </tr>
                <tr>
                    <td width="181" style="font-family:arial; font-size:15px; padding:5px 0;">
                        <strong>School/Training Center</strong>
                    </td>
                    <td width="25" align="center" valign="middle">:</td>
                    <td width="526" align="left" valign="top" style="font-family:arial; font-size:13px;padding:3px 0;">
                        <?php echo $batch_details['user_tc_name']; ?>
                    </td>
                </tr>
                <tr>
                    <td width="181" style="font-family:arial; font-size:15px; padding:5px 0;">
                        <strong>Sector</strong>
                    </td>
                    <td width="25" align="center" valign="middle">:</td>
                    <td width="526" align="left" valign="top" style="font-family:arial; font-size:13px;padding:3px 0;">
                        <?php echo $batch_details['sector_name']; ?> [<strong><?php echo $batch_details['sector_code']; ?></strong>]
                    </td>
                </tr>
                <tr>
                    <td width="181" style="font-family:arial; font-size:15px; padding:5px 0;">
                        <strong>Course</strong>
                    </td>
                    <td width="25" align="center" valign="middle">:</td>
                    <td width="526" align="left" valign="top" style="font-family:arial; font-size:13px;padding:3px 0;">
                        <?php echo $batch_details['course_name']; ?> [<strong><?php echo $batch_details['course_code']; ?></strong>]
                    </td>
                </tr>
                <tr>
                    <td width="181" style="font-family:arial; font-size:15px; padding:5px 0;">
                        <strong>Date of Assessment</strong>
                    </td>
                    <td width="25" align="center" valign="middle">:</td>
                    <td width="526" align="left" valign="top" style="font-family:arial; font-size:13px;padding:3px 0;">
                        <?php
                        if ($batch_details['proposed_assessment_date'] != NULL) {
                            echo date('d-m-Y', strtotime($batch_details['proposed_assessment_date']));
                        } else {
                            echo '--';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td width="181" style="font-family:arial; font-size:15px; padding:5px 0;">
                        <strong>Name of Trainee</strong>
                    </td>
                    <td width="25" align="center" valign="middle">:</td>
                    <td width="526" align="left" valign="top" style="font-family:arial; font-size:13px;padding:3px 0;"></td>
                </tr>
                <tr>
                    <td width="181" style="font-family:arial; font-size:15px; padding:5px 0;">
                        <strong>Roll/Reg. Number</strong>
                    </td>
                    <td width="25" align="center" valign="middle">:</td>
                    <td width="526" align="left" valign="top" style="font-family:arial; font-size:13px;padding:3px 0;"></td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td width="50%" align="left" valign="middle" style="font-family:arial; font-size:18px; padding:5px 0;">
                            <?php if ($batch_details['assessment_scheme_id_fk'] == 3) { ?>
                                <strong>Time: 30 Min.</strong>
                            <?php } else { ?>
                                <strong>Time: 1 Hrs.</strong>
                            <?php } ?>
                        </td>
                        <td width="50%" align="right" valign="middle" style="font-family:arial; font-size:18px; padding:5px 0;">
                            <strong>
                                Total Marks:
                                <?php if ($batch_details['assessment_scheme_id_fk'] == 3) { ?>
                                    10
                                <?php } else { ?>
                                    <?php echo $total_marks; ?>
                                <?php } ?>
                            </strong>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="left" valign="middle" style="font-family:arial; font-size:15px; padding-bottom:15px;border-bottom:2px solid #000;">
                        <strong>Instructions:</strong>
                        <?php if ($batch_details['assessment_scheme_id_fk'] == 3) { ?>
                            Answer any Ten Question
                        <?php } else { ?>
                            All questions are compulsory
                        <?php } ?>
                    </td>
                </tr>
            </table>

            <table width="100%">
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0">
                <?php $count = 0; ?>
                <?php foreach ($nos_list as $key1 => $nos) { ?>
                    <tr align="center">
                        <td><strong><?php echo $nos['nos_name'] . ' / ' . $nos['nos_code']; ?></strong></td>
                    </tr>
                    <tr>
                        <td height="5">&nbsp;</td>
                    </tr>
                    <?php foreach ($nos['question_list'] as $key2 => $question) { ?>
                        <tr>
                            <td align="left" valign="middle" style="font-family:nikosh; font-size:15px; padding-bottom:15px;">
                                <strong style="float: left;">
                                    Q<?php echo ++$count; ?>.
                                </strong>
                                <span>
                                    <?php if (!empty($question['eng_questions'][0]['question'])) {
                                        echo $question['eng_questions'][0]['question'];
                                    } ?>

                                    <?php if (!empty($question['eng_questions'][0]['question_pic'])) {
                                        echo '<br><br>';
                                        echo '<img class="img-responsive" src="data:image/jpeg;base64,' . pg_unescape_bytea($question['eng_questions'][0]['question_pic']) . '" width="200">';
                                    } ?>
                                </span>
                                <span style="float: right;">(<?php echo $nos['no_of_marks_each_question_carries']; ?>)</span>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding-left: 50px;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <?php if (!empty($question['eng_questions'][0]['option1_pic'])) { ?>
                                        <tr>
                                            <td width="27" style="border:1px solid #000;">&nbsp;</td>
                                            <td>
                                                <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question['eng_questions'][0]['option1_pic']); ?>" width="100">
                                            </td>
                                            <td width="27" style="border:1px solid #000;">&nbsp;</td>
                                            <td>
                                                <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question['eng_questions'][0]['option2_pic']); ?>" width="100">
                                            </td>
                                            <td width="27" style="border:1px solid #000;">&nbsp;</td>
                                            <td>
                                                <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question['eng_questions'][0]['option3_pic']); ?>" width="100">
                                            </td>
                                            <td width="27" style="border:1px solid #000;">&nbsp;</td>
                                            <td>
                                                <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question['eng_questions'][0]['option4_pic']); ?>" width="100">
                                            </td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td width="27" style="border:1px solid #000; height:18px; width:20px;">
                                                &nbsp;</td>
                                            <td width="13">&nbsp;</td>
                                            <td width="690" style="font-family:nikosh; font-size:15px;">
                                                <?php if (!empty($question['eng_questions'][0]['option1'])) {
                                                    echo $question['eng_questions'][0]['option1'];
                                                } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="27" style="border:1px solid #000; height:18px; width:20px;">
                                                &nbsp;</td>
                                            <td width="13">&nbsp;</td>
                                            <td width="690" style="font-family:nikosh; font-size:15px;">
                                                <?php if (!empty($question['eng_questions'][0]['option2'])) {
                                                    echo $question['eng_questions'][0]['option2'];
                                                } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="27" style="border:1px solid #000; height:18px; width:20px;">
                                                &nbsp;</td>
                                            <td width="13">&nbsp;</td>
                                            <td width="690" style="font-family:nikosh; font-size:15px;">
                                                <?php if (!empty($question['eng_questions'][0]['option3'])) {
                                                    echo $question['eng_questions'][0]['option3'];
                                                } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="27" style="border:1px solid #000; height:18px; width:20px;">
                                                &nbsp;</td>
                                            <td width="13">&nbsp;</td>
                                            <td width="690" style="font-family:nikosh; font-size:15px;">
                                                <?php if (!empty($question['eng_questions'][0]['option4'])) {
                                                    echo $question['eng_questions'][0]['option4'];
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>

                        <?php if (!empty($question['beng_questions'])) { ?>
                            <tr>
                                <td align="left" valign="middle" style="font-family:nikosh; font-size:15px; padding-bottom:15px;">
                                    <strong style="float: left;">
                                        Q<?php echo $count; ?>.
                                    </strong>
                                    <span>

                                        <?php
                                        if (!empty($question['beng_questions'][0]['question'])) {
                                            // echo $question['beng_questions'][0]['question'];
                                            echo '<span style="font-family: freeserif;">' . $question['beng_questions'][0]['question'] . '</span>';
                                        }
                                        if (!empty($question['question_pic'])) {
                                            echo '<img class="img-responsive" src="data:image/jpeg;base64,' . pg_unescape_bytea($question['beng_questions'][0]['question_pic']) . '">';
                                        }
                                        ?>

                                        <span style="float: right;">(<?php echo $nos['no_of_marks_each_question_carries']; ?>)</span>
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-left: 50px;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="27" style="border:1px solid #000; height:18px; width:20px;">
                                                &nbsp;</td>
                                            <td width="13">&nbsp;</td>
                                            <td width="690" style="font-family:nikosh; font-size:15px;">
                                                <?php if (!empty($question['eng_questions'][0]['option1'])) {
                                                    echo $question['eng_questions'][0]['option1'];
                                                } ?>

                                                <?php if (!empty($question['eng_questions'][0]['option1_pic'])) { ?>
                                                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question['eng_questions'][0]['option1_pic']); ?>" width="100">
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="27" style="border:1px solid #000; height:18px; width:20px;">
                                                &nbsp;</td>
                                            <td width="13">&nbsp;</td>
                                            <td width="690" style="font-family:nikosh; font-size:15px;">
                                                <?php if (!empty($question['eng_questions'][0]['option2'])) {
                                                    echo $question['eng_questions'][0]['option2'];
                                                } ?>

                                                <?php if (!empty($question['eng_questions'][0]['option2_pic'])) { ?>
                                                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question['eng_questions'][0]['option2_pic']); ?>" width="100">
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="27" style="border:1px solid #000; height:18px; width:20px;">
                                                &nbsp;</td>
                                            <td width="13">&nbsp;</td>
                                            <td width="690" style="font-family:nikosh; font-size:15px;">
                                                <?php if (!empty($question['eng_questions'][0]['option3'])) {
                                                    echo $question['eng_questions'][0]['option3'];
                                                } ?>

                                                <?php if (!empty($question['eng_questions'][0]['option3_pic'])) { ?>
                                                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question['eng_questions'][0]['option3_pic']); ?>" width="100">
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="5">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="27" style="border:1px solid #000; height:18px; width:20px;">
                                                &nbsp;</td>
                                            <td width="13">&nbsp;</td>
                                            <td width="690" style="font-family:nikosh; font-size:15px;">
                                                <?php if (!empty($question['eng_questions'][0]['option4'])) {
                                                    echo $question['eng_questions'][0]['option4'];
                                                } ?>

                                                <?php if (!empty($question['eng_questions'][0]['option4_pic'])) { ?>
                                                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($question['eng_questions'][0]['option4_pic']); ?>" width="100">
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>

                    <?php } ?>
                <?php } ?>
            </table>
            <table width="100%">
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </page>
</body>

</html>