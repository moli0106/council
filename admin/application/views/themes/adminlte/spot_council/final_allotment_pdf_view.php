<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PDF Details</title>
    <style type="text/css">
    table {
        border-collapse: collapse;
        width: 100%;
    }

    tr {
        border-bottom: 1px solid #ccc;
    }

    th {
        text-align: left;
    }

    .border-table td {
        border-bottom: 1px solid black;
    }
    </style>



</head>


<body>
    <div>
        <table width="100%" style="border: 1px solid;" cellspacing="0" cellpadding="0">

            <tr>
                <td valign="middle" align="left" width="20%" style="padding:10px;">
                    <img width="70" height="70"
                        src="<?php echo base_url('admin/themes/adminlte/custom/council_logo.png'); ?>">
                    <!-- <img width="90" height="90" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>"> -->
                </td>
                <td align="left" style="font-family:arial; font-size:16px;line-height:0px;">
                    <strong>WEST BENGAL STATE COUNCIL OF TECHNICAL & VOCATIONAL EDUCATION
                        & SKILL DEVELOPMENT</strong>


                    <p valign="top" align="center"
                        style="font-family:arial; font-size:10px;line-height:25px;padding-bottom:0px; border-bottom:0px solid #000;">
                        {Erstwhile West Bengal State Council of Technical Education} <br> (A Statutory Body under
                        Government of West Bengal Act XXVI of 2013),<br> Karigari Bhavan, 4th Floor, Plot No. B/7,
                        Action Area-III, Newtown, Rajarhat, Kolkata–700160</p>
                    <p style="font-family:arial; font-size:13px;padding-bottom:10px;"><strong>FINAL ALLOTMENT LETTER –
                            COUNSELING <?php echo $user_details['course_name']; ?></strong></p>
                </td>


            </tr>
    </div>
    </div>
    </table>
    <div style="border: 1px solid;">
        <table class="border-table" width="100%" border="1px" cellspacing="0"
            style="font-size: 13px;border-bottom: 1px solid #ccc !important;">
            <tr>
                <td colspan="2">
                    <p style="color: #1A237E;font-size: 14px;"><strong> Final Allotment Letter No:
                            <?php echo "00".$user_details['student_college_mapid_pk']; ?></strong></p>
                </td>


                <td>
                    <p style="color: #1A237E;font-size: 14px;"><strong> Dated:
                            <?php echo date('d-m-y',strtotime(date('m/d/Y h:i:s a', time()))); ?></strong></p>
                </td>
            </tr>
            <tr>
            <tr>
                <td>Application Form No:</td>
                <td><?php echo $user_details['application_form_no']; ?></td>
                <td rowspan="7" align="middle">
                    <center>
                        <img class="img-responsive"
                            style="max-height:100px; max-width: 145px;border:1px solid;margin: 2px;padding: 4px"
                            src="data:image/jpeg;charset=utf-8;base64,<?php echo $user_details['picture'] ?>"
                            alt=""><br>
                    </center>
                    <img style="max-height:50px; max-width: 82px; border:1px solid;margin: 2px;padding: 2px"
                        src="data:image/jpeg;charset=utf-8;base64,<?php echo $user_details['sign'] ?>" alt="">
                </td>
            </tr>
            <tr>
                <td>Name of the Candidate :</td>
                <td><?php echo $user_details['candidate_name']; ?></td>
            </tr>
            <tr>
                <td>Date of Birth: </td>
                <td><?php echo date('d-m-Y',strtotime($user_details['date_of_birth']));  ?></td>
            </tr>
            <tr>
                <td>Guardian's Name:</td>
                <td><?php echo $user_details['guardian_name']; ?></td>
            </tr>
            <tr>
                <td>Mobile Number:</td>
                <td><?php echo $user_details['mobile_number']; ?></td>
            </tr>
            <tr>
                <td>Category:</td>
                <td><?php echo $user_details['caste_name']; ?></td>
            </tr>
            <tr>
                <td>Physically Challenged:</td>
                <td><?php echo $user_details['handicapped']; ?></td>
            </tr>
        </table>
    </div>
    <div id="example3">
        <table width="100%" align="center" border="1" cellspacing="0" cellpadding="4px" style="font-size: 14px;">
            <thead>
                <tr>
                    <th>General Rank</th>
                    <th>SC Rank</th>
                    <th>ST Rank</th>
                    <th>PC Rank </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center"><?php echo $user_details['general_rank']; ?></td>
                    <td align="center"><?php echo $user_details['sc_rank']; ?></td>
                    <td align="center"><?php echo $user_details['st_rank']; ?></td>
                    <td align="center"><?php echo $user_details['pc_rank']; ?></td>
                </tr>
            </tbody>
        </table><br>
        <div>
            <section style="font-size: 12px;">Candidate, whose details are furnished above is hereby selected for
                admission to the 1st year class of 2 years’ Diploma Course in
                Pharmacy for the session 2022-2023 in accordance with his/her rank and given
                choices in order of preference either afresh or on upgradation of previous allotment.</section>
        </div>
        <br>



        <table width="100%" align="center" border="1" cellspacing="0" cellpadding="4px" style="font-size: 12px;">
            <thead>
                <tr>
                    <th colspan="2" align="center">FINAL ALLOTMENT DETAILS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left" width="40%">INSTITUTE NAME :</td>
                    <td align="left" width="60%"><?php echo $user_details['institute_name']; ?></td>
                </tr>
                <tr>
                    <td align="left" width="40%">BRANCH NAME :</td>
                    <td align="left" width="60%"><?php echo $user_details['course_name']; ?></td>
                </tr>
                <tr>
                    <td align="left" width="40%">SEAT ALLOTTED THROUGH :</td>
                    <td align="left" width="60%"></td>
                </tr>
            </tbody>
        </table>

        <br>
        <div>
            <section style="font-size: 12px;">He/She is directed to report to the Principal of the allotted Institute
                with the following documents for verification and admission.<strong><i> The candidate must report to and
                        take admission in the concerned Institute within --.--.---- or before the revised date to be
                        notified later, failing which this allotment will stand cancelled
                        automatically.</i></strong><br><br>
                <section style="font-size: 12px;">
                    <ol>
                        <li> Two copies of this Final Allotment Letter.</li>
                        <li>One copy of recent passport size photograph.</li>
                        <li> Admit Card of Madhyamik or equivalent examination or Birth Registration Certificate.</li>
                        <li> Mark sheet and/or Certificate of Higher Secondary / equivalent examination in original.
                        </li>
                        <li>Pharmacy Entrance Admit Card.</li>
                        <li> SC/ST Certificate in original (required if allotted through SC/ST quota only) issued by
                            competent authority of the Government of West Bengal.</li>
                        <li> Physically Challenged (PC) Certificate in original (required if allotted through PC quota
                            only) issued by competent authority.</li>
                        <li> A Medical Fitness Certificate obtained from a Registered Medical Practitioner / Medical
                            Officer stating therein that the candidate has no
                            colour blindness, he/she is physically and mentally fit to pursue technical course. The
                            certificate should possess Signature, Stamp and
                            Registration Number of the Registered Medical Practitioner / Medical Officer.</li>
                        <li> Filled-in Anti Ragging Affidavit in the prescribed format. In Annexure-I, the student has
                            to sign in two places under 'Signature of
                            Deponent' and in Annexure-II, the parent/guardian has to sign in two places under 'Signature
                            of Deponent'. The signature of "Oath
                            Commissioner" should remain blank in both the annexures. These two affidavits are to be
                            submitted in A4 size paper.</li>
                        <li> The photo copy of all the documents(1 set).</li>
                        <li> Admission Fees, as applicable to Government & Government Sponsored / Private Institutions.
                        </li>
                        <li>Document related to serial no 8 and 9 to be submitted by the students with in 1 month from
                            the date of admission.</li>
                    </ol>
                </section><br>

        </div>
        <div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size: 14px;">
                <tr>
                    <td align="left"> Date:</td>

                    <td align="right"> (Signature of the candidate)</td>
                </tr>
            </table>
        </div>
    </div>
    </div>


    </div>
    </div>

</body>

</html>