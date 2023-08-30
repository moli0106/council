<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <title>WBSCTVESD Marksheet</title>

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

    page[size="A4"][layout="portrait"] {
      width: 8in;
      height: 12in;
    }

    @page {
      height: 12in;
      margin: 0cm;
      width: 8in;
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
      width: 750px;
      border: 15px solid #162761;
    }
  </style>
</head>

<body>
  <?php
  $count = $total_marks_obtained = $total_marks_for_core_nos = $total_marks_for_non_core_nos = 0;
  ?>
  <?php for ($i = 0; $i < $total_page; $i++) { ?>

    <page size="A4" layout="portrait">
      <table align="center" width="100%" cellspacing="10" cellpadding="10" class="main-table">
        <tbody>
          <tr>
            <td style="border:4px solid #162761; padding:10px;">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center">
                    <table border="0" cellpadding="0" cellspacing="0">
                      <tr>

                        <td valign="middle" style="padding-right:20px;">
                          <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/ncvet-logo.png' ?>" width="100">
                        </td>
                        <td valign="middle" style="padding-left:20px; border-left:2px solid #000;">
                          <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>" width="85">

                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <table width="100%">
                <tr>
                  <td align="center" style="font-family:arial; font-size:16px;line-height:23px; text-transform:uppercase; color:#067cc0; padding:10px 0; font-weight:bold;">West Bengal State Council of Technical &amp; Vocational Education &amp; Skill Development</td>
                </tr>
              </table>

              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center" style="font-family:arial; font-size:25px;line-height:25px; text-transform:uppercase; color:#162761;"><strong>marksheet</strong></td>
                </tr>
              </table>

              <table width="100%">
                <tr>
                  <td height="10">&nbsp;</td>
                </tr>
              </table>

              <?php if ($count < 10) { ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="font-family:arial; font-size:15px;line-height:25px;">Name</td>
                    <td style="font-family:arial; font-size:15px;line-height:25px;">: <?php echo strtoupper($traineeDetails['trainee_full_name']); ?></td>
                    <td align="right" style="font-family:arial; font-size:15px;line-height:25px;">
                      <?php
                      //echo date("d<\s\up>S</\s\up> M, Y", strtotime($traineeDetails['batch_marks_status_updated_date'])); 
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">QP Name</td>
                    <td colspan="2" style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">: <?php echo $traineeDetails['course_name']; ?></td>
                  </tr>
                  <tr>
                    <td style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">QP Code</td>
                    <td colspan="2" style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">
                      : <?php echo $traineeDetails['course_code']; ?> (<?php echo $nqr_code; ?>)
                    </td>
                  </tr>
                  <tr>
                    <td style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">NSQF Level</td>
                    <td colspan="2" style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">: <?php echo $traineeDetails['course_level']; ?></td>
                  </tr>
                  <tr>
                    <td style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">Sector</td>
                    <td colspan="2" style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">: <?php echo $traineeDetails['sector_name']; ?></td>
                  </tr>
                  <tr>
                    <td style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">Type (Reg. No.)</td>
                    <td colspan="2" style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">
                      : Candidate
                      (<?php echo $traineeDetails['user_trainee_registration_no']; ?>)
                    </td>
                  </tr>
                  <tr>
                    <td style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">Certificate (Council) Code</td>
                    <td colspan="2" style="font-family:arial; font-size:15px;line-height:25px;padding-top:3px;">
                      : <?php
                        if ($traineeDetails['certificate_no']) {
                          echo $traineeDetails['certificate_no'];
                          echo '(' . $traineeDetails['certificate_council_code'] . ')';
                        } else {
                          echo 'N/A';
                        }
                        ?>

                    </td>
                  </tr>
                </table>

                <table width="100%">
                  <tr>
                    <td height="30">&nbsp;</td>
                  </tr>
                </table>
              <?php } ?>

              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top" width="20%" style="padding-right:5px">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:2px solid #162761;">
                      <tr>
                        <td align="center" valign="middle" height="50" style="font-family:arial; font-size:12px; line-height:20px;background:#162761; color:#fff; text-transform:uppercase;">NOS Code</td>
                      </tr>
                      <?php $temp_count = 0; ?>
                      <?php foreach ($traineeNosDetails as $key => $nosDetails) { ?>

                        <tr>
                          <td style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">
                            <?php
                            $tmp_nos_code = str_replace('&nbsp;', '', $nosDetails['nos_code']);
                            if (!empty($tmp_nos_code)) {
                              echo ++$count . '. ' . $nosDetails['nos_code'];
                            } else {
                              echo '&nbsp;';
                            }
                            ?>
                          </td>
                        </tr>

                        <?php
                        ++$temp_count;
                        if ($i == 0) {
                          if ($temp_count == 12) break;
                        } elseif ($i == ($total_page - 1)) {
                          if ($temp_count == 16) break;
                        } else {
                          if ($temp_count == 15) break;
                        }
                        ?>
                      <?php } ?>
                    </table>
                  </td>

                  <td valign="top" width="40%" style="padding-right:5px">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:2px solid #162761;">
                      <tr>
                        <td align="center" valign="middle" height="50" style="font-family:arial; font-size:12px; line-height:20px;background:#162761; color:#fff;text-transform:uppercase;">NOS Name</td>
                      </tr>
                      <?php $temp_count = 0; ?>
                      <?php foreach ($traineeNosDetails as $key => $nosDetails) { ?>

                        <!-- <tr>
                          <td style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">
                            <?php
                            if ($nosDetails['nos_name'] != '&nbsp;') {
                              echo substr($nosDetails['nos_name'], 0, 25) . '...';
                              //echo $nosDetails['nos_name'];
                            } else {
                              echo $nosDetails['nos_name'];
                            }
                            ?>
                          </td>
                        </tr> -->
                        <tr>
                          <td style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">
                            <?php
                            // echo $nosDetails['nos_name'];
                            if ($nosDetails['nos_name'] != '&nbsp;') {
                              $string  = preg_replace("/\([^)]+\)/", "", $nosDetails['nos_name']);

                              $removeChar     = ["IN ", "THE ", "AND ", "&", "ON ", "FOR ", "OF ", "A ", "AN ", "AT ", "TO "];
                              $removeCharWith = ["", "", "", "", "", "", "", ""];

                              $string = str_replace($removeChar, $removeCharWith, $string);

                              $words   = preg_split("/[\s,\/_-]+/", $string);
                              $acronym = "";

                              foreach ($words as $w) {
                                $acronym .= $w[0];
                              }

                              echo $acronym;
                            } else {
                              echo $nosDetails['nos_name'];
                            }
                            ?>
                          </td>
                        </tr>

                        <?php
                        ++$temp_count;
                        if ($i == 0) {
                          if ($temp_count == 12) break;
                        } elseif ($i == ($total_page - 1)) {
                          if ($temp_count == 16) break;
                        } else {
                          if ($temp_count == 15) break;
                        }
                        ?>
                      <?php } ?>
                    </table>
                  </td>

                  <td valign="top" width="20%" style="padding-right:5px">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:2px solid #162761;">
                      <tr>
                        <td align="center" valign="middle" height="50" style="font-family:arial; font-size:12px; line-height:20px;background:#162761; color:#fff;text-transform:uppercase;">NOS Type</td>
                      </tr>
                      <?php $temp_count = 0; ?>
                      <?php foreach ($traineeNosDetails as $key => $nosDetails) { ?>

                        <tr>
                          <td style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">
                            <?php echo $nosDetails['nos_type']; ?>
                          </td>
                        </tr>

                        <?php
                        ++$temp_count;
                        if ($i == 0) {
                          if ($temp_count == 12) break;
                        } elseif ($i == ($total_page - 1)) {
                          if ($temp_count == 16) break;
                        } else {
                          if ($temp_count == 15) break;
                        }
                        ?>
                      <?php } ?>
                    </table>
                  </td>

                  <td valign="top" width="10%" style="padding-right:5px">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:2px solid #162761;">
                      <tr>
                        <td align="center" valign="middle" height="50" style="font-family:arial; font-size:12px; line-height:20px;background:#162761; color:#fff;text-transform:uppercase;">maximum marks</td>
                      </tr>
                      <?php $temp_count = 0; ?>
                      <?php foreach ($traineeNosDetails as $key => $nosDetails) { ?>

                        <tr>
                          <td style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">
                            <?php
                            if (($nosDetails['nos_theory_marks'] == '&nbsp;')) {

                              echo '&nbsp;';
                            } else {

                              $max_marks = $nosDetails['nos_theory_marks'] + $nosDetails['nos_practical_marks'] + $nosDetails['nos_viva_marks'];

                              if ($nosDetails['nos_id_pk'] == 1) {
                                $total_marks_for_core_nos += $max_marks;
                              } else {
                                $total_marks_for_non_core_nos += $max_marks;
                              }

                              echo $max_marks;
                            }
                            ?>
                          </td>
                        </tr>

                        <?php
                        ++$temp_count;
                        if ($i == 0) {
                          if ($temp_count == 12) break;
                        } elseif ($i == ($total_page - 1)) {
                          if ($temp_count == 16) break;
                        } else {
                          if ($temp_count == 15) break;
                        }
                        ?>
                      <?php } ?>
                    </table>
                  </td>

                  <td valign="top" width="10%">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:2px solid #162761;">
                      <tr>
                        <td align="center" valign="middle" height="50" style="font-family:arial; font-size:12px; line-height:20px;background:#162761; color:#fff;text-transform:uppercase;">marks obtained</td>
                      </tr>
                      <?php $temp_count = 0; ?>
                      <?php foreach ($traineeNosDetails as $key => $nosDetails) { ?>

                        <tr>
                          <td style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">
                            <?php echo $nosDetails['total_marks']; ?>
                          </td>
                        </tr>

                        <?php
                        ++$temp_count;
                        $total_marks_obtained += $nosDetails['total_marks'];

                        if ($i == 0) {
                          if ($temp_count == 12) {
                            unset($traineeNosDetails[$key]);
                            break;
                          } else {
                            unset($traineeNosDetails[$key]);
                          }
                        } elseif ($i == ($total_page - 1)) {
                          if ($temp_count == 16) {
                            unset($traineeNosDetails[$key]);
                            break;
                          } else {
                            unset($traineeNosDetails[$key]);
                          }
                        } else {
                          if ($temp_count == 15) break;
                          unset($traineeNosDetails[$key]);
                        }
                        ?>
                      <?php } ?>
                    </table>
                  </td>

                </tr>
              </table>

              <table width="100%">
                <tr>
                  <td height="10">&nbsp;</td>
                </tr>
              </table>

              <?php if ($i == ($total_page - 1)) { ?>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td valign="top" style="padding-right:10px;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:2px solid #162761;">
                        <tr>
                          <td width="70%" align="center" valign="middle" style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">CORE NOSs <br> TOTAL MARKS</td>
                          <td width="30%" align="center" valign="middle" style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;border-left:2px solid #162761;"><strong><?php echo $total_marks_for_core_nos; ?></strong></td>
                        </tr>
                      </table>
                    </td>

                    <td valign="top" style="padding-right:10px;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:2px solid #162761;">
                        <tr>
                          <td width="70%" align="center" valign="middle" style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">NON CORE NOSs <br> TOTAL MARKS</td>
                          <td width="30%" align="center" valign="middle" style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;border-left:2px solid #162761;"><strong><?php echo $total_marks_for_non_core_nos; ?></strong></td>
                        </tr>
                      </table>
                    </td>

                    <td valign="top" style="padding-right:10px;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:2px solid #162761;">
                        <tr>
                          <td width="70%" align="center" valign="middle" style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">OVERALL <br> SCORE</td>
                          <td width="30%" align="center" valign="middle" style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;border-left:2px solid #162761;"><strong><?php echo $total_marks_obtained; ?></strong></td>
                        </tr>
                      </table>
                      <!-- <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td style="font-family:arial; font-size:11px; line-height:20px; padding-top:5px;">(80% of Core + 70% of Non Core)</td>
                        </tr>
                      </table> -->
                    </td>

                    <td valign="top">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td align="center" style="font-family:arial; font-size:13px; line-height:20px; padding:20px 5px;">
                            <strong>
                              <?php echo ($traineeDetails['exam_result'] == 1) ? 'PASS' : 'FAIL'; ?>
                            </strong>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              <?php } ?>

              <table width="100%">
                <tr>
                  <td height="60">&nbsp;</td>
                </tr>
              </table>

              <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top:20px;">
                <tr>
                  <td width="50%" valign="top">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center">&nbsp;
                          <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/signkroy.png'; ?>" width="150 px">
                        </td>
                      </tr>
                      <tr>
                        <td align="center" style="font-family:arial; font-size:13px; line-height:20px; padding-top:5px;border-top:2px solid #000;"><strong>Administrative Officer (Registration)</strong><br> WBSCTVESD</td>
                      </tr>
                      <tr>
                        <td style="font-family:arial; font-size:10px; line-height:18px;">*Details of NoS Name overleaf</td>
                      </tr>
                    </table>
                  </td>
                  <td width="50%" align="right" valign="top">
                    <!-- <img src="<?php echo base_url('admin/themes/adminlte/assets/image/certificate/qr-code.png'); ?>" width="100"> -->
                    <img src="<?php echo $traineeQrCode; ?>" style="width:80px;" />
                  </td>

                </tr>
              </table>

            </td>
          </tr>
        <tbody>
      </table>
    </page>


    <table width="100%">
      <tr>
        <!-- <td height="20">&nbsp;</td> -->
      </tr>
    </table>

  <?php } ?>

  <page size="A4" layout="portrait">
    <table align="center" width="100%" cellspacing="10" cellpadding="10" class="main-table">
      <tbody>
        <tr>
          <td style="border:4px solid #162761; padding:10px;">
            <!--<table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>

                      <td valign="middle" style="padding-right:20px;">
                        <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/ncvet-logo.png' ?>" width="100">
                      </td>
                      <td valign="middle" style="padding-left:20px; border-left:2px solid #000;">
                        <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>" width="85">

                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            <table width="100%">
              <tr>
                <td align="center" style="font-family:arial; font-size:16px;line-height:23px; text-transform:uppercase; color:#067cc0; padding:10px 0; font-weight:bold;">West Bengal State Council of Technical &amp; Vocational Education &amp; Skill Development</td>
              </tr>
            </table>-->

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top" width="100%" style="padding-right:5px; height:1100px;">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:2px solid #162761;">
                    <tr>
                      <td align="center" valign="middle" height="50" style="font-family:arial; font-size:12px; line-height:20px;background:#162761; color:#fff; text-transform:uppercase;">NOS Details</td>
                      <?php $count = 0; ?>
                      <?php foreach ($traineeNosDetailsCopy as $key => $nosDetails) { ?>
                    <tr>
                      <td style="font-family:arial; font-size:13px; line-height:20px; padding:10px 5px;">
                        <?php
                        $string  = preg_replace("/\([^)]+\)/", "", $nosDetails['nos_name']);

                        $removeChar     = ["IN ", "THE ", "AND ", "&", "ON ", "FOR ", "OF ", "A ", "AN ", "AT ", "TO "];
                        $removeCharWith = ['', '', '', '', '', '', '', '', ''];

                        $string = str_replace($removeChar, $removeCharWith, $string);

                        $words   = preg_split("/[\s,\/_-]+/", $string);
                        $acronym = "";

                        foreach ($words as $w) {
                          $acronym .= $w[0];
                        }

                        echo ++$count . '. <strong>' . $acronym . '</strong>: ' . $nosDetails['nos_name'];
                        ?>
                      </td>
                    </tr>
                  <?php } ?>

                  </table>
                  <table width="100%" style="font-family:arial; font-size:20px; line-height:150px;">
                    <tr>
                      <td align="right">
                        <strong><u>WBSCTVESD</u></strong>
                      </td>
                    </tr>
                  </table>


                </td>
              </tr>
            </table>

          </td>
        </tr>
      <tbody>
    </table>
  </page>
</body>

</html>